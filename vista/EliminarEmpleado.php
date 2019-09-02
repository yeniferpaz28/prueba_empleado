<?php
require_once("../modelo/ModeloEmpleado.php");

if(isset($_GET['id'])){
	$id = intval($_GET['id']);
	
	$objetoEmpleado = new ModeloEmpleado();
	$empleado = $objetoEmpleado->EliminarEmpleados($id);

	if($empleado){
		header("location: ListarEmpleado.php?mensaje1");
	}else{
		header("location: ListarEmpleado.php?mensaje2");
	}

}

?>