<?php
require_once("../controlador/ControladorArea.php");

class ModeloArea{
	// propiedades
	public $id;
	public $nombre;
	// presentar area
	public function ListarAreas(){
		$nuevaArea = new ControladorArea();
		$areas = $nuevaArea->ListarArea();

		return $areas;


	}
}

?>