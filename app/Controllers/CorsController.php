<?php

namespace App\Controllers;

class CorsController extends BaseController
{
    public function preflight()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        return $this->response->setStatusCode(200);
    }
}
