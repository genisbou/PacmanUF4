<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class AdblockcontrolledCell extends Cell
{
   // mostrar view sense cap mes funcio
    // protected string $view = "adblockcontrolled"; //nom de l'arxiu vista
   
    // mostraria la view passant-li parametres
    // public function render():string
    // {
    //     return $this->view('adblockcontrolled', ['extra' => 'data']);
    // }

    // tindriem parametres externs al CELL i es passarien a la cell
    protected string $view = "adblockcontrolled";     //nom de l'arxiu vista
    public string $type;
    public string $message;

    public function mount(?string $type, ?string $message)
    {
        $this->type = $type;
        $this->message = $message;
    }
}
