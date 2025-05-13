<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function testCell(){
        return view ('cells/adblock');
    }
    
    private function index(): string
    {
        // echo view('welcome_message');
        // return view('demo/daw/welcome_message'); // /app/views/demo/daw/welcome_message.php
        
        // echo "no se on l'he cagat";
        // die;

        // funcions de dbuging -> d() o dd()

        // $var='josep';

        // dd($var,$this);
        // dd($var);
        // d($this);

        return view('welcome_message'); // /app/views/welcome_message.php
    }

    public function elmeusuperestil($color)
    {

        // set content-type to css
        $this->response->setContentType('text/css');

        // $this->response->setBody("body{background-color: #$color;}");
        // return $this->response;
        
        // echo "body{background-color: #$color;}";
        // return $this->response;

        // return "body{background-color: #$color;}";

        return view('estils/full_estil_dinamic', ['color' => $color, 'size' => '55px']);
    }
}
