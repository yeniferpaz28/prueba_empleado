<?php
require_once("../controlador/ControladorEmpleado.php");

class ModeloEmpleado{
	// propiedades
	public $id;
	public $nombre;
	public $email;
	public $sexo;
	public $area_id;
	public $boletin;
	public $descripcion;

	// guardar empleado

	public function GuardarEmpleados($_nombre,$_email,$_sexo,$Area_id,$_boletin,$_descripcion){
		$objetoEmpleado = new ControladorEmpleado();
		$this->nombre = $_nombre;
		$this->email = $_email;
		$this->sexo = $_sexo;
		$this->area_id = $Area_id;
		$this->boletin = $_boletin;
		$this->descripcion = $_descripcion;

		$empleados = $objetoEmpleado->GuardarEmpleado($this);

		return $empleados;

	}
	// presntar empleado
	public function ListarEmpleados(){
		$objetoEmpleado = new ControladorEmpleado();
		$empleado = $objetoEmpleado->ListarEmpleado();

		return $empleado;
	}
	// presentar empleado actualizar
	public function PresentarEmpleadosActualizar($id){
		$objetoEmpleado = new ControladorEmpleado();
		$empleado = $objetoEmpleado->PresentarEmpleadoActualizar($id);

		return $empleado;
	}
	// actualizar empleado
	public function ActualizarEmpleados($_id,$_nombre,$_email,$_sexo,$_area_id,$_boletin,$_descripcion){
		$objetoEmpleado = new ControladorEmpleado();

		$this->id = $_id;
		$this->nombre = $_nombre;
		$this->email = $_email;
		$this->sexo = $_sexo;
		$this->area_id = $_area_id;
		$this->boletin = $_boletin;
		$this->descripcion = $_descripcion;

		$empleado = $objetoEmpleado->ActualizarEmpleado($this);

		return $empleado;

	}
	// eliminar empleado
	public function EliminarEmpleados($id){
		$objetoEmpleado = new ControladorEmpleado();

		$empleado = $objetoEmpleado->EliminarEmpleado($id);

		return $empleado;
	}
	public function MaximoId(){
		$objetoEmpleado = new ControladorEmpleado();

		$empleado = $objetoEmpleado->MaximoId();

		return $empleado;
	}
	public function PresentarDetalles($id){
		$objetoEmpleado = new ControladorEmpleado();
		$empleado = $objetoEmpleado->PresentarDetalles($id);

		return $empleado;


	}

}

?>