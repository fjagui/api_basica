<?php
$url = 'http://development.local/dwes/unidades/unidad7/asir_apirest/servidor/server.php/contactos';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url ); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); /**Respuesta como cadena*/
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($curl, CURLOPT_HTTPGET,true);

$data = curl_exec($curl); 

curl_close($curl);

var_dump(json_decode($data));

