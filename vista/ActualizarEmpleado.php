<?php
require_once("../includes/header.php");
require_once("../modelo/ModeloEmpleado.php");
require_once("../modelo/ModeloArea.php");

// validar valor del boletin
$vBoletin = 0;
if(isset($_POST['boletin'])){
	if($_POST['boletin']=='on'){
		$vBoletin = 1;
	}else{
		$vBoletin = 0;
	}
}
$objetoEmpleado = new ModeloEmpleado();
// verificar si exite id
if(isset($_GET['id'])){
	$id = intval($_GET['id']);


	$maxId = $objetoEmpleado->MaximoId();
	$mId = $maxId->id_empleado;
	if(!is_numeric($_GET['id']) || $_GET['id']<=0 || $mId < $_GET['id']){
		
		header("location: ListarEmpleado.php");
	}else{
		
	}
}else{
	header("location: ListarEmpleado.php");
}


if (isset($_POST['btnActualizar'])) {
		if(isset($_POST) && !empty($_POST)){
		$id = intval($_GET['id']);
		$nombre = ($_POST['nombre']);
		$email = ($_POST['email']);
		$sexo = ($_POST['sexo']);
		$descripcion = ($_POST['descripcion']);
		$area_id = ($_POST['area_id']);
		$boletin = $vBoletin;
		
		$empleado = $objetoEmpleado->ActualizarEmpleados($id,$nombre,$email,$sexo,$area_id,$boletin,$descripcion);

		if($empleado){
			echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
		 	Datos actualizados exitosamente
		 	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		    	<span aria-hidden='true'>&times;</span>
		  	</button>
		</div>";
		}else{
			echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
		 	Error al actualizar
		 	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		    	<span aria-hidden='true'>&times;</span>
		  	</button>
		</div>";
		}
	}
}
$presentarEmpleados = $objetoEmpleado->PresentarEmpleadosActualizar($id);
?>
<form method="post">
	<div class="container-fluid">
	<div class="form-row" id="row1">
		<div class="col-sm-4">
			<h1>Actualizar empleados</h1>
		</div>		
	</div>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre Completo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo del empleado" value="<?php echo $presentarEmpleados->nombre;?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Correo electronico</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" id="email" placeholder="Correo electronico" value="<?php echo $presentarEmpleados->email;?>" required>
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Sexo</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sexo" id="sexoMasculino" value="M" <?php if($presentarEmpleados->sexo == 'M') echo 'checked'?>>
          <label class="form-check-label" for="sexoMasculino">
            Masculino
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sexo" id="sexoFemenino" value="F" <?php if($presentarEmpleados->sexo == 'F') echo 'checked'?>>
          <label class="form-check-label" for="sexoFemenino">
            Femenino
          </label>
        </div>        
      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <label for="area" class="col-sm-2 col-form-label">Area</label>
    <div class="col-sm-10">
    	<select class="form-control" id="area_id" name="area_id" required>
      <!-- <option value="">:..</option> -->
      <?php
            $objetoArea = new ModeloArea();
          $listaAreas = $objetoArea->ListarAreas();
          while($areas = mysqli_fetch_array($listaAreas)){
          	$seleccionar=($presentarEmpleados->area_id == $areas[id])? "selected" : "";
            echo '<option '.$seleccionar.' value = "'.$areas[id].'">'.$areas[nombre].'</option>\n';
          }      
      ?>
    </select>
    </div>    
  </div>
  <div class="form-group row">
    <label for="descripciones" class="col-sm-2 col-form-label">Descripcion</label>
    <div class="col-sm-10">
    	<textarea class="form-control" id="descripcion" rows="3" name="descripcion" required><?php echo $presentarEmpleados->descripcion;?></textarea>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="boletin" name="boletin" <?php if($presentarEmpleados->boletin == 1) echo 'checked'; ?>>
        <label class="form-check-label" for="boletin">
          Deseo recibir boletin informativo
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary" name="btnActualizar" id="btnActualizar">Actualizar</button>
      <a href="ListarEmpleado.php" class="btn btn-primary">Volver</a>
    </div>
  </div>
  </div>

</form>
<?php
require_once("../includes/footer.php");
?>