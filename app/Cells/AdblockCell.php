<?php

namespace App\Cells;

class AdblockCell
{
   public function show($params): string
   {
      return '<div style="width:400px;height:200px;background-color:red">' .
                 'Var type: ' . $params["type"] . '<br>' . 'Var msg: ' . $params["message"] . '<br>' .
                 '</div>';
    }
}