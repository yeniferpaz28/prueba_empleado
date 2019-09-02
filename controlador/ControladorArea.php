<?php
require_once("../conexion/Conexion.php");

class ControladorArea{
	// presentarAREAS
	public function ListarArea(){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		$sql = "SELECT * FROM areas";

		$resultado = mysqli_query($objetoConexion->con,$sql);

		return $resultado;

	}
}

?>