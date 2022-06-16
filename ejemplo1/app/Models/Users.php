<?php
namespace App\Models;

//No es necesario use App\Models\DBAbstractModel ya que está en el mismo espacio de nombres
class Users extends DBAbstractModel {
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
		
	public function login($usuario,$password) 
	{
		$this->query = "
				SELECT *
				FROM usuarios
				WHERE usuario = :usuario and
				      password = :password";
		//Cargamos los parámetros.
		$this->parametros['usuario']= $usuario;
		$this->parametros['password']= $password;
	
		//Ejecutamos consulta que devuelve registros.
		$this->getResultsFromQuery();
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
	public function get($id='') {}
	public function set() {}
	public function edit() {}
	public function del() {}
}
?>