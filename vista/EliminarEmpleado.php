<?php
session_start();
require_once("../modelo/ModeloEmpleado.php");
require_once("../modelo/ModeloRol.php");
$objetoEmpleado = new ModeloEmpleado();
if(isset($_GET['id'])){
	$id = intval($_GET['id']);
	$maxId = $objetoEmpleado->MaximoId();
	$mId = $maxId->id_empleado;
	if(!is_numeric($_GET['id']) || $_GET['id']<=0 || $mId < $_GET['id']){
		
		header("location: ListarEmpleado.php");
	}
else if(isset($_GET['btnDelete'])){
	
	$empleado = $objetoEmpleado->EliminarEmpleados($id);
	$objetoRol = new ModeloRol();
	$rol = $objetoRol->EliminarRoles($id);

	if($empleado && $rol){
		$_SESSION['message'] = 'Datos eliminados correctamente';
		$_SESSION['message_type']='success';
		header("location: ListarEmpleado.php");

	}else{
		$_SESSION['message'] = 'Error al eliminar datos';
		$_SESSION['message_type']='danger';
		header("location: ListarEmpleado.php");
	}

}
}
?>
<?php require_once("../includes/header.php"); ?>

<form>
<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Empleado</h5>
      </div>
      <div class="modal-body">
              <input type="hidden" name="id" id="id" value="<?php $id = intval($_GET['id']);
              echo $id;?>">
        <p>¿Esta seguro de eliminar empleado?</p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btnDelete" id="btnDelete">Eliminar</button>
        <a href="ListarEmpleado.php" class="btn btn-default" data-dismiss="modal" id="cancelar">Cancelar</a>
      </div>
    </div>
  </div>
</div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
    $( document ).ready(function() {
        $("#myModal").show();
    });
</script>
<?php  require_once("../includes/footer.php");?>