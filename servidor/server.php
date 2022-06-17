<?php
/**
 * Api básica.
 * Definición de end points.
 * Método       Ruta
 * GET          /contactos              Obtener todos los contactos.
 * GET          /contactos/{id}         Obtener contacto por id
 * POST         /contactos              Añadir contacto
 * PUT          /contaco/{id}           Modificar contacto
 * DELETE       /contacto/{id}          Borrar
 */


# Archivos requeridos
require "config.php";
require "funciones.php";

# Establecemos conexión con la bd
$db = openConnection();


# Cabeceras

header("Access-Control-Allow-Origin: *"); //Orígenes permitidos para acceso desde ip distinta.
header("Content-Type: application/json; charset=UTF-8"); //Tipo documento
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"); //Métodos permitidos.
header("Access-Control-Max-Age: 3600"); //Duración en cache
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); //Autorización

# Variable para la respuesta.
$response['status_code_header'] = 'HTTP/1.1 404 Not Found';
$response['body'] = null;

# Gestión de la petición http

#Recuperamos el método utilizado.
$requestMethod = $_SERVER["REQUEST_METHOD"];

//Parseamos la dirección de entrada
$request= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request=str_replace(DIRBASE,'',$_SERVER['REQUEST_URI']);
$uri = explode( '/', $request );

//Si existe recuperamos el id del usuario.
$userId = null;
if (isset($uri[1])) {
    $userId = (int) $uri[1];

}

#Respuesta a los end_point.
switch ($requestMethod) {
    case 'GET':
        if ($userId) {
            $result  = getContacto($db, $userId);
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = json_encode($result);
        } else {
            $result = getAllContactos($db);
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = json_encode($result);
        };
        break;
    case 'POST':
       // $response = createContactosFromRequest();
        break;
    case 'PUT':
       // $response = updateContactosFromRequest($userId);
        break;
    case 'DELETE':
       // $response = $this->deleteContactos($this->userId);
        break;
    default:
        
        break;
}

#Escribimos la salida.
header($response['status_code_header']);
if ($response['body']) {
    echo $response['body'];
}



