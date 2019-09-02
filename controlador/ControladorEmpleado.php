<?php
// archivo conexion
require_once("../conexion/Conexion.php");

class ControladorEmpleado extends Conexion{

	// guardar
	public function GuardarEmpleado($empleado){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		$sql = "INSERT INTO empleados(nombre,email,sexo,area_id,boletin,descripcion) VALUES('$empleado->nombre','$empleado->email','$empleado->sexo','$empleado->area_id','$empleado->boletin','$empleado->descripcion')";

		$resultado = mysqli_query($objetoConexion->con,$sql);
		return $resultado;
	}
	//presentarEmpleados
	public function ListarEmpleado(){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		$sql = "SELECT empleados.id AS id_empleado, empleados.nombre,email,sexo,descripcion, ".
				"CASE WHEN sexo = 'F' THEN 'Femenino' " .
				"WHEN sexo = 'M' THEN 'Masculino' END AS sexo, " .
				"areas.id AS area_id, areas.nombre AS area_nombre, " .
				"CASE WHEN  boletin = 1 THEN 'Si' " .
				"WHEN boletin = 0 THEN 'No' END AS boletin " .
				"FROM empleados " .
				"INNER JOIN areas ON areas.id = empleados.area_id ";
		$resultado = mysqli_query($objetoConexion->con,$sql);
		return $resultado;
	}
	// presentar empleado actualizar
	public function PresentarEmpleadoActualizar($id){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		$sql = "SELECT * FROM empleados WHERE id = $id";

		$resultado = mysqli_query($objetoConexion->con,$sql);

		$resultadoObjeto = mysqli_fetch_object($resultado);

		return $resultadoObjeto;

	}
	// actualizar empleado
	public function ActualizarEmpleado($empleado){
		$objetoConexion = new  Conexion();
		$objetoConexion->conectarDB();

		$sql = "UPDATE empleados SET nombre = '$empleado->nombre',	
									 email = '$empleado->email',
									 sexo = '$empleado->sexo',
									 area_id = '$empleado->area_id',
									 boletin = '$empleado->boletin',
									 descripcion = '$empleado->descripcion'

				 WHERE id = '$empleado->id'";
		$resultado = mysqli_query($objetoConexion->con,$sql);
		return $resultado;

	}
	// eliminar empleado
	public function EliminarEmpleado($id){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		$sql = "DELETE FROM empleados WHERE id = '$id'";
		$resultado =mysqli_query($objetoConexion->con,$sql);

		return $resultado;
	}
	// buscar maximo id
	public function MaximoId(){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		$sql= "SELECT id AS id_empleado FROM empleados WHERE id=( SELECT max(id) FROM empleados )";
		$resultado =mysqli_query($objetoConexion->con,$sql);
		$resultadoMaximo = mysqli_fetch_object($resultado);

		return $resultadoMaximo;
	}

}
?>