<?php
namespace App\Models;

//No es necesario use App\Models\DBAbstractModel ya que está en el mismo espacio de nombres
class Contactos extends DBAbstractModel {
	/*CONSTRUCCIÓN DEL MODELO SINGLETON*/
	private static $instancia;
	public static function getInstancia()
	{
	if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;	
	}
	public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }
		
	# Crear un nuevo usuario comprobando por código que no exista.
	public function set($sh_data=array()) 
	{

		//Para brobarlo en postman hay que añadir en: body, raw, {"nombre":"quino", etc}
		foreach ($sh_data as $campo=>$valor) {
			$$campo = $valor;
        }
		$this->query = "INSERT INTO contactos(nombre,telefono,email)
						VALUES(:nombre, :telefono,:email)";
		$this->parametros['nombre']= $nombre;
		$this->parametros['telefono']= $telefono;
		$this->parametros['email']= $email;
		$this->getResultsFromQuery();
		//$this->execute_single_query();
		$this->mensaje = 'SH añadido';
		
	}
	
	/**
	* Método para traer un superheroe de la base de datos por clave primaria.
	* Carga los resultado en el array definido en la clase abstracta.
	*
	* @param int id. Identificador de la entidad.
	* @return datos.
	*/
	public function get($id='') 
	{
		if($id != '') {
			$this->query = "
				SELECT *
				FROM contactos
				WHERE id = :id";
		//Cargamos los parámetros.
		$this->parametros['id']= $id;
	
		//Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		}
		if(count($this->rows) == 1) {
			foreach ($this->rows[0] as $propiedad=>$valor) {
				$this->$propiedad = $valor;
			}
			$this->mensaje = 'sh encontrado';
		}
		else {
			$this->mensaje = 'sh no encontrado';
		}
		return $this->rows[0]??null;
	}
/**
	* Método para traer un libro de la base de datos por clave primaria.
	* Carga los resultado en el array definido en la clase abstracta.
	*
	* @param int id. Identificador de la entidad.
	* @return datos.
	*/
	public function getAll() 
	{
		$this->query = "SELECT * FROM contactos";
	
		//Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		return $this->rows;
	}

	/**
	* Método para traer un libro de la base de datos por clave primaria.
	* Carga los resultado en el array definido en la clase abstracta.
	*
	* @param int id. Identificador de la entidad.
	* @return datos.
	*/
	public function getSuperheroesByFilter($filter) 
	{
		$this->query = "SELECT * FROM contactos where nombre like :filtro";
		$this->parametros['filtro']= '%'.$filter.'%';
	
		//Ejecutamos consulta que devuelve registros.
		
	
		//Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
		return $this->rows;
	}



# Edición desde array
public function edit($id='', $user_data=array()) 
{
   /*
	* Pasamos id ya que es el que viene en la ruta y 
	*/	
   /*
   Campo updated_at es posible modificarlo creando un objeto datetime en php y enviando la fecha y hora en el parámetro
   o también utilizando la funcion mysql now en la propia consulta. 
   Es mejor con la función now, pero aquí lo hacemos creando el objeto para manejar fechas, horas.  
 
   */
 
	$fecha = new \DateTime();

	foreach ($user_data as $campo=>$valor) {
        $$campo = $valor;
    }
	
    $this->query = "
		UPDATE contactos
		SET nombre=:nombre,
		telefono=:telefono,
		email=:email,
		updated_at=:fecha
		WHERE id = :id
		";

	/*Opción de modificar updated_at con now de mysql
		$this->query = "
		UPDATE superheroes
		SET nombre=:nombre,
		velocidad=:velocidad,
		updated_at=now()
		WHERE id = :id
		";*/
   

	$this->parametros['id']=$id;
    $this->parametros['nombre']=$nombre;
    $this->parametros['email']=$email;
	$this->parametros['telefono']=$telefono;

	$this->parametros['fecha']= date('Y-m-d H:i:s',$fecha->getTimestamp());
    $this->getResultsFromQuery();
    $this->mensaje = 'sh modificado';
}




# Eliminar un usuario
public function del($id='') 
{
    $this->query = "DELETE FROM contactos
                    WHERE id = :id";
    $this->parametros['id']=$id;
    $this->getResultsFromQuery();
    $this->mensaje = 'Contacto eliminado';
}





# Método constructor
function __construct() {
    // Singleton no recomienda parámetros ya que 
	// podría dificultar la lectura de las instancias.
	
	
}

}
?>