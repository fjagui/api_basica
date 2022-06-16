<?php
/*
require "../bootstrap.php";
use App\Models\Contactos;

$contacto = new Contactos();
var_dump($contacto);
*/
$path='/^\/contactos(\/[0-9])?$/';
preg_match($path, '/contactos', $matches);
var_dump($matches);