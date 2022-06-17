<?php
echo "Prueba: Recuperamos todos los contactos";

$url = 'http://development.local/api_basicacontactos/servidor/server.php/contactos';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url ); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); /**Respuesta como cadena*/
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($curl, CURLOPT_HTTPGET,true);
$data = json_decode(curl_exec($curl),true);
curl_close($curl);

foreach ($data as $contacto) {
    echo "<br/>Contacto<br/>";
    foreach($contacto as $clave=>$valor) {
       echo $clave." = ". $valor."<br/>";
    }
}

echo "Prueba: Recuperamos el contacto 3";

$url = 'http://development.local/api_basicacontactos/servidor/server.php/contactos/3';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url ); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); /**Respuesta como cadena*/
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($curl, CURLOPT_HTTPGET,true);
$data = json_decode(curl_exec($curl),true);
curl_close($curl);
foreach ($data as $contacto) {
    echo "<br/>Contacto<br/>";
    foreach($contacto as $clave=>$valor) {
       echo $clave." = ". $valor."<br/>";
    }
}

