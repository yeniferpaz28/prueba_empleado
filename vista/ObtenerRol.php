<?php
include_once("../modelo/ModeloRol.php");

	if(isset($_POST['arrayCheck']) && isset($_POST['valorId'])){
     	
     	$id_empleado = ($_POST['valorId']);
     
     	$objetoRol = new ModeloRol();  

    	if (!empty($_POST['arrayCheck'])){
    		foreach ($_POST['arrayCheck'] as $id_rol) {

    		$rol = $objetoRol->ActualizarRoles($id_rol,$id_empleado);

   			}
   		}
    }
    // echo "<p>".$seleccion."</p>"
    if($rol){
       	echo "datos eliminados";
    }else{
    echo "error al eliminar";
    }     
?>

           