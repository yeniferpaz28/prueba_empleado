<?php
require_once("../includes/header.php");
require_once("../modelo/ModeloEmpleado.php");
require_once("../modelo/ModeloArea.php");

$vBoletin = 0;
if(isset($_POST['boletin'])){
	if($_POST['boletin']=='on'){
		$vBoletin = 1;
	}else{
		$vBoletin = 0;
	}
}
if (isset($_POST['btnGuardar'])) {
	$objetoEmpleado = new ModeloEmpleado();
	if(isset($_POST) && !empty($_POST)){
		$nombre = ($_POST['nombre']);
		$email = ($_POST['email']);
		$sexo = ($_POST['sexo']);
		$descripcion = ($_POST['descripcion']);
		$area_id = ($_POST['area_id']);
		$boletin = $vBoletin;

		$empleado = $objetoEmpleado->GuardarEmpleados($nombre,$email,$sexo,$area_id,$boletin,$descripcion);

		if($empleado){
			echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
		 	Datos guardados exitosamente
		 	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		    	<span aria-hidden='true'>&times;</span>
		  	</button>
		</div>";
		}else{
			echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
		 	Error al guardar
		 	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		    	<span aria-hidden='true'>&times;</span>
		  	</button>
		</div>";
		}
	}
}
?>
<form method="post">
	<div class="container-fluid">
	<div class="form-row" id="row1">
		<div class="col-sm-4">
			<h1>Guardar empleado</h1>
		</div>		
	</div>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre Completo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo del empleado" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Correo electronico</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" id="email" placeholder="Correo electronico" required>
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Sexo</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sexo" id="sexoMasculino" value="M" checked>
          <label class="form-check-label" for="sexoMasculino">
            Masculino
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sexo" id="sexoFemenino" value="F">
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
            echo '<option value = "'.$areas[id].'">'.$areas[nombre].'</option>\n';
          }      
      ?>
    </select>
    </div>    
  </div>
  <div class="form-group row">
    <label for="descripciones" class="col-sm-2 col-form-label" required>Descripcion</label>
    <div class="col-sm-10">
    	<textarea class="form-control" id="descripcion" rows="3" name="descripcion"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="boletin" name="boletin">
        <label class="form-check-label" for="boletin">
          Deseo recibir boletin informativo
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary" name="btnGuardar" id="btnGuardar">Guardar</button>
      <a href="ListarEmpleado.php" class="btn btn-primary">Volver</a>
    </div>
  </div>
</form>
<?php
require_once("../includes/footer.php");
?>