<?php
require_once("../controlador/ControladorArchivosPlanos.php");

class ModeloArchivosPlanos{
	public function ValidarBlackList($telefono){
	// public function ValidarBlackList(){
		$objeControladorAp = new ControladorArchivosPlanos();
		$resultado = $objeControladorAp->ValidarBlackLists($telefono);
		// $resultado = $objeControladorAp->ValidarBlackLists();

		return $resultado;
	}
}
?>