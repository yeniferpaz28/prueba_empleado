<?php
require_once("../controlador/ControladorRol.php");

class ModeloRol{
	public $id;
	public $nombre;
	public $id_empleado;
	public $id_rol;

	// presentar usuario
	public function PresentarRoles(){
		$objetoControlador = new ControladorRol();
		$roles = $objetoControlador->PresentarRol();

		return $roles;
	}
	// guardar rol
	public function GuardarRoles($id_rol,$id_empleado){
		$objetoControlador = new ControladorRol();
		$this->id_rol = $id_rol;
		$this->id_empleado = $id_empleado;

		$roles = $objetoControlador->GuardarRol($this);

		return $roles;
	}
	public function ActualizarRoles($id_rol,$id_empleado){
		$objetoControlador = new ControladorRol();
		$this->id_rol = $id_rol;
		$this->id_empleado = $id_empleado;

		$roles = $objetoControlador->ActualizarRol($this);

		return $roles;
	}
	// eliminar rol
	public function EliminarRoles($id_empleado){
		$objetoControlador = new ControladorRol();
		
		$roles = $objetoControlador->EliminarRol($id_empleado);

		return $roles;

	}
	public function PresentarRolesActualizar($id_empleado,$id_rol){
		$objetoControlador = new ControladorRol();

		$roles = $objetoControlador->PresentarRolActualizar($id_empleado,$id_rol);

		return $roles;
	}
	public function PresentarDetallesRoles($id){
		$objetoControlador = new ControladorRol();
		$roles = $objetoControlador->PresentarDetallesRol($id);

		return $roles;
	}
}
?>
