<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * 
 *  http://domini.tld/ => baseurl
 *                   /RUTA/AL/RECURS => associar a un controller i una funcio
 *                   /path/to/file.ext
 * 
 *   $routes->METHOD('ruta','controller::funcio')
 *   $routes->METHOD('ruta','controller') => per defecte la funcio a cridar es index
 */

$routes->get('/', 'Home::index');

$routes->get('/cell', 'Home::testCell');

$routes->get('daw/demo','Home::index');
$routes->get('layout','PagesController::view_layout');

// 'elmeusuperestil/00ffff.css') 
$routes->get('elmeusuperestil/(:segment).css','Home::elmeusuperestil/$1');

$routes->get('news', 'NewsController::index');

$routes->get('news/page', 'NewsController::list_pager');

$routes->get('news/create', 'NewsController::create');
$routes->post('news/create', 'NewsController::create_post');

// $routes->match(['get','post'], 'news/create', 'NewsController::create_global');

$routes->get('news/(:segment)', 'NewsController::view/$1');

// $routes->get('pagina/inici',"PagesController::inici");
// $routes->get('pagina/about',"PagesController::about");
// $routes->get('pagina/contacta',"PagesController::contacta");
// $routes->get('pagina/mapa',"PagesController::mapa");

// $routes->get('pagina/(:num)',"PagesController::view/$1"); 
// segment =>   qualsevol combinacio de lletres/numeros sense la / de url
// /path_to_algu
// any => /path_to_algu > $1 = path_to_algu
// any => /ath/to/algu  > $1 = ath/to/algu
$routes->get('pagina/(:segment)',"PagesController::view/$1"); 
// http://localhost/pagina/chupiguay -> PagesController::view('chupiguay')

// Aquesta configuració faria que mai s'entri a privada/algo, ja que any ja inclouria privada
// $routes->get('pagina/(:any)',"PagesController::view/$1"); 
// $routes->get('pagina/privada/(:segment)',"PagesController::view/$1"); 


// $routes->get('pagina/(:segment)/(:segment)-(:segment)-(:segment)/(:segment)',"PagesController::view/$1/$2/$3/$4/$5"); 
// $routes->get('pagina/(:segment)/(:num)-(:alpha)-(:num)/(:segment)',"PagesController::view/$3/$2/$1/$5/$4"); 