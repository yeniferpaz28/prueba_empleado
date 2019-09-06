<?php
require_once("../includes/header.php");
require_once("../modelo/ModeloRol.php");
require_once("../modelo/ModeloArea.php");
require_once("../modelo/ModeloEmpleado.php");

if(isset($_GET['id'])){
	$id= intval($_GET['id']);
}

$objetoEmpleado = new ModeloEmpleado();
// $objetoArea = new ModeloArea();
// $areas = $objetoArea->ListarAreas();
// $datosArea = mysqli_fetch_array($);
$datosEmpleado = $objetoEmpleado->PresentarDetalles($id);

?>
<div class="container-fluid">
<div class="form-row" id="row1">
		<div class="col-sm-4">
			<h1>Visualizar empleado</h1>
		</div>		
	</div>
	<style type="text/css">
		.pdetalle{
			background-color: #F9F9F9;
			width: 400px;
			height: 30px;
			padding: 10px 30px 30px 10px;
		}
	</style>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre Completo</label>
    <div class="col-sm-10">
      <p class="pdetalle" readonly><?php echo $datosEmpleado->nombre;?></p>
    </div>
  </div>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Correo electrónico</label>
    <div class="col-sm-10">
      <p class="pdetalle" readonly><?php echo $datosEmpleado->email;?></p>
    </div>
  </div>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Sexo</label>
    <div class="col-sm-10">
      <p class="pdetalle"><?php if($datosEmpleado->sexo == 'F') echo 'Femenino'; else if($datosEmpleado->sexo == 'M') echo 'Masculino';?></p>
    </div>
  </div>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Area</label>
    <div class="col-sm-10">
      <p class="pdetalle"><?php echo $datosEmpleado->nombre_area;?></p>
    </div>
  </div>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Descripcion</label>
    <div class="col-sm-10">
    <p class="pdetalle"><?php echo $datosEmpleado->descripcion;?></p>
    </div>
  </div>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Boletin</label>
    <div class="col-sm-10">
    <p class="pdetalle"><?php if($datosEmpleado->boletin == 1) echo 'Sí'; else if($datosEmpleado->boletin == 0) echo 'No';?></p>
    </div>
  </div>
   <?php 
    $nuevo = 0;
    $objetoRol = new ModeloRol();
    $listaRoles = $objetoRol->PresentarDetallesRoles($id);
    while($roles = mysqli_fetch_array($listaRoles)){
      $nuevo += 1;
      $nombre_rol = $roles[1];
      
  ?>
  <div class="form-group row">
    <?php if($nuevo<=1){ ?>
  <label for="descripciones" class="col-sm-2 col-form-label pt-0" required>Roles *</label>
    <div class="col-sm-10">
      <?php }else{ ?>
        <div class="col-sm-10 offset-sm-2">
        <?php }?>
      		<div class="form-check">
      			<p class="pdetalle"><?php echo $nombre_rol;?></p>
     		 </div>
   		</div>    
  	</div>
  <?php } ?>
  <div class="form-group row">
      <div class="col-sm-10">
      	<a href="ActualizarEmpleado.php?id=<?php echo $id;?>" class="btn btn-primary">Modificar</a>
        <a href="EliminarEmpleado.php?id=<?php echo $id;?>" class="btn btn-primary">Eliminar</a>
      </div>
    </div>
</div>

<?php require_once("../includes/footer.php");?>

