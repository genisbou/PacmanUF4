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
$routes->options('api/login', 'CorsController::preflight');


// Users
$routes->post('api/create_user', 'UserController::register');
$routes->post('api/login', 'UserController::login');
$routes->get('api/logged',  'UserController::logged',  ['filter' => 'jwt']);
$routes->put('api/update_user/(:segment)', 'UserController::update');
$routes->post('api/logout', 'UserController::logout');

// Config game
$routes->post('api/config_game', 'UserController::configGame'); // Nova config
$routes->put('api/update_config_game', 'UserController::updateConfigGame');

// Partides
$routes->get('api/partides', 'PartidesController::index'); // Llista partides
$routes->get('api/get_user_last_games',  'PartidesController::get_user_last_games');
$routes->get('api/get_top_users',   'PartidesController::get_top_users');
$routes->get('api/get_user_stats', 'PartidesController::getUserStats');
$routes->post('api/add_game', 'PartidesController::create'); //  nova partida
$routes->post('api/partides', 'PartidesController::create'); // Desa nova partida


$routes->get('api/partides/(:segment)', 'PartidesController::show/$1'); // Mostra una partida
$routes->get('api/partides/(:segment)/edit', 'PartidesController::edit/$1'); // Formulari editar
$routes->put('api/partides/(:segment)', 'PartidesController::update/$1'); // Desa canvis
$routes->patch('api/partides/(:segment)', 'PartidesController::update/$1'); // Alternativa a put
$routes->delete('api/partides/(:segment)', 'PartidesController::delete/$1'); // Elimina



// http://localhost/pagina/chupiguay -> PagesController::view('chupiguay')

// Aquesta configuració faria que mai s'entri a privada/algo, ja que any ja inclouria privada
// $routes->get('pagina/(:any)',"PagesController::view/$1"); 
// $routes->get('pagina/privada/(:segment)',"PagesController::view/$1"); 


// $routes->get('pagina/(:segment)/(:segment)-(:segment)-(:segment)/(:segment)',"PagesController::view/$1/$2/$3/$4/$5"); 
// $routes->get('pagina/(:segment)/(:num)-(:alpha)-(:num)/(:segment)',"PagesController::view/$3/$2/$1/$5/$4"); 