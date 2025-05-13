<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PagesController extends BaseController
{
    private function index()
    {
        //
    }

    // http://localhost/pagina/chupiguay -> PagesController::view('chupiguay')
    public function view_v1($page = 'home')
    {
        
        // return view('pages/' . $page);
        
        // view (NOM_VISTA,ARRAY_DADES_A_PASSAR)
        
        // $data['title'] = "La meva primera pagina"; // dins la vista sera $title
        $data['title'] = ucfirst($page); // dins la vista sera $title
        $data['empresa'] = "DAW Technologies"; // dins la vista sera $empresa
        return view('pages/' . $page, $data);
    }

    public function view($page = 'home')
    {
        // ROOTPATH
        // APPPATH = ROOTPATH/app
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pagina ' . $page . ' no trobada');
        }
    
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['empresa'] = "DAW Technologies"; // dins la vista sera $empresa

        echo view('templates/header', $data);
        echo view('pages/' . $page, $data);
        echo view('templates/footer', $data);
    }

    public function view_layout(){
        $data['title'] = "La meva primera pagina"; // dins la vista sera $title
        $data['empresa'] = "DAW Technologies"; // dins la vista sera $empresa
        return view('pages_layout/demolayout', $data);
    }
}
