<?php
require_once("../conexion/Conexion.php");

class ControladorRol{
	// presentar roles
	public function PresentarRol(){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		$sql = "SELECT roles.id AS id_rol, roles.nombre AS nombre_rol FROM roles";

		$resultado = mysqli_query($objetoConexion->con,$sql);
		return $resultado;
	}
	// guardar empleado
	public function GuardarRol($rol){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		$sql = "INSERT INTO empleado_rol(rol_id,empleado_id) VALUES('$rol->id_rol','$rol->id_empleado')"; 

		$rol = mysqli_query($objetoConexion->con,$sql);
		return $rol;

	}
	// actualizarempleado
	// presentarempleado actualizar
	// eliminarempleado
	public function EliminarRol($id_empleado){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		$sql = "DELETE FROM empleado_rol WHERE empleado_id = '$id_empleado'";
		$resultado =mysqli_query($objetoConexion->con,$sql);

		return $resultado;
	}
	public function PresentarRolActualizar($id_empleado,$id_rol){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		// $sql = "SELECT empleado_id, rol_id FROM empleado_rol WHERE empleado_id = $id";
		$sql = "SELECT empleado_id, rol_id FROM empleado_rol WHERE empleado_id = $id_empleado && rol_id = $id_rol";
		
		$roles = mysqli_query($objetoConexion->con,$sql);

		return $roles;

	}
	public function ActualizarRol($roles){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		$sql = "SELECT empleado_id, rol_id FROM empleado_rol WHERE empleado_id = $id_empleado && rol_id = $id_rol";

		$resultado1 = mysql_query($objetoConexion->con,$sql);
		if(!empty($resultado1)){
			$sql = "DELETE FROM empleado_rol WHERE empleado_id = $id_empleado && rol_id = $id_rol";
		}else{
			$sql = "INSERT INTO empleado_rol(rol_id,empleado_id) VALUES('$roles->id','$roles->seleccion')";
		}
		$resultados = mysql_query($objetoConexion->con,$sql);
		return $resultados;
		// $sql = "UPDATE empleado_rol SET empleado_id ='$roles->id_empleado', rol_id = '$roles->id_rol' WHERE rol_id = '$roles->id_empleado'";

	}
	public function PresentarDetallesRol($id){
		$objetoConexion = new Conexion();
		$objetoConexion->conectarDB();

		$sql = "SELECT roles.id, roles.nombre,empleado_rol.empleado_id,empleado_rol.rol_id FROM empleado_rol
				INNER JOIN roles
				WHERE roles.id= empleado_rol.rol_id && empleado_rol.empleado_id = $id";
		
		$roles = mysqli_query($objetoConexion->con,$sql);

		return $roles;
	}
}
?>