<?php
/*Requiere fichero de inicio;*/

/*Uso de clases necesarias.*/

// Cabeceras necesarias
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


//Parseo de la url
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$requestMethod = $_SERVER["REQUEST_METHOD"];

//Si existe, recuperamos id del contacto de la url.
$userId = null;
if (isset($uri[2])) {
    $userId = (int) $uri[2];
}


// Todos los endpoints empiezan por /contactos
// everything else results in a 404 Not Found
if ($uri[1] !== 'contactos') {
    header("HTTP/1.1 404 Not Found");
    exit();
}





// pass the request method and user ID to the PersonController and process the HTTP request:
$controller = new ContactosController($requestMethod, $userId);
$controller->processRequest();