<?php

// helper('daw');
// Crida des d'un controller/view/model => demo('Hola món');

if (!function_exists('demo'))
{
    function demo($data = null) {
        return "Helper demo. " . $data??'Hola món';
    }
}