<?php
// clase
class Conexion{
	public $con;
	private $host = 'localhost';
	private $user = 'jenifer';
	private $pass = '12345678';
	private $db = 'prueba_nexura';


	function __construct(){
		$this->conectarDB();
	}
	// CONECTAR
	public function conectarDB(){
		$this->con  = mysqli_connect($this->host,$this->user,$this->pass,$this->db);
		// error
		if(mysqli_connect_error()){
			die("Error al conectar a base de datos".mysqli_connect_error().mysqli_connect_errnor());
		}
	}
}
?>