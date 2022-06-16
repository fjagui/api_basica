<?php 
 /**
  * Crea objeto PDO de conexión a la BD
  *
  * @return pdo
  */
 function openConnection()
 {
    #Cadena de conexión 
    $dsn = 'mysql:host=' . DBHOST . ';'
           . 'dbname=' . DBNAME . ';' 
           . 'port='  . DBPORT;
     try {
       $conn = new \PDO($dsn, DBUSER, DBPASS,
                            array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
       return $conn;
     } 
     catch (\PDOException $e) {
       printf("Conexión fallida: %s\n", $e->getMessage());
       exit();
   }
 }
 /**
  * Recupera todos los contactos
  * 
  * @param [PDO] $db
  * @return array
  */
 function getAllContactos($db)
 {
        $query = "SELECT * FROM contactos";
	      $sql = $db->prepare($query);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $res = $sql->fetchAll() ;
        return $res;
 }