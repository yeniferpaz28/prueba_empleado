<?php
require_once('../conexion/Conexion.php');

class ControladorArchivosPlanos {

	// traer los datos si coinciden con el telefono
	public function ValidarBlackLists($telefono){
	// public function ValidarBlackLists(){
		$objConexion = new Conexion();
		$objConexion->conectarDB();

		$sql = "SELECT fullname, phone FROM black_list WHERE phone = '$telefono'";
		// $sql = "SELECT fullname, phone FROM black_list";
		$resultado = mysqli_query($objConexion->con, $sql);

		$resultadoObjeto = mysqli_fetch_object($resultado);

		return $resultadoObjeto;
	}

}
?>

