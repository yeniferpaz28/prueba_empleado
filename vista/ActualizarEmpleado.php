<?php
session_start();
require_once("../includes/header.php");
require_once("../modelo/ModeloEmpleado.php");
require_once("../modelo/ModeloArea.php");
require_once("../modelo/ModeloRol.php");

if(isset($_GET['checkEnOn'])){
  $p = ($_GET['checkEnOn']);
  echo "hola jeni";
}
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
$objetoRol = new ModeloRol();
// verificar si exite id
if(isset($_GET['id'])){
	$id = intval($_GET['id']);
	$maxId = $objetoEmpleado->MaximoId();
	$mId = $maxId->id_empleado;
	if(!is_numeric($_GET['id']) || $_GET['id']<=0 || $mId < $_GET['id']){
		
		header("location: ListarEmpleado.php");
	}
}else{
  header("location: ListarEmpleado.php");
}
// actualizar empleado
if (isset($_POST['btnActualizar'])) {
		if(isset($_POST) && !empty($_POST)){
		$id = intval($_GET['id']);
		$nombre = ($_POST['nombre']);
		$email = ($_POST['email']);
		$sexo = ($_POST['sexo']);
		$descripcion = ($_POST['descripcion']);
		$area_id = ($_POST['area_id']);
		$boletin = $vBoletin;

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if(trim($nombre)==''){
      $_SESSION['message'] = 'Debe agregar un nombre';
      $_SESSION['message_type']='danger';
    }    
    // Luego validamos el email
    else if(trim($email)==''){
      $_SESSION['message'] = 'Debe agregar un correo';
      $_SESSION['message_type']='danger';

    } 
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
        // echo("$email es una dirección de email válida");
      $_SESSION['message'] = 'No es una dirección válida de correo';
      $_SESSION['message_type']='danger';
    }
    else if(empty(($_POST['sexo']))){
      // error $sexo;      
      $_SESSION['message'] = 'Debe seleccionar un sexo';
      $_SESSION['message_type']='danger';

    }
    else if(trim($area_id)==''){
      $_SESSION['message'] = 'Debe seleccionar una área';
      $_SESSION['message_type']='danger';
    }
    else if(trim($descripcion)==''){
      $_SESSION['message'] = 'Debe agregar una descripción';
      $_SESSION['message_type']='danger';
    } 
    else if(empty($_POST['id_rol'])){
      $_SESSION['message'] = 'Debe seleccionar al menos un rol';
      $_SESSION['message_type']='danger';
    }else{
		
		$empleado = $objetoEmpleado->ActualizarEmpleados($id,$nombre,$email,$sexo,$area_id,$boletin,$descripcion);

    if (!empty($_POST['id_rol'])){
      foreach ($_POST['id_rol'] as $seleccion) {
        // echo "<p>".$seleccion."</p>";
        $rol = $objetoRol->ActualizarRoles($seleccion,$id);
      }
    }

// mensaje si se actualizo
    // if($empleado && $rol){
		if($empleado){
			 $_SESSION['message'] = 'Datos guardados correctamente';
      $_SESSION['message_type']='success';
      // header("location: ActualizarEmpleado.php");      

    }else{
      $_SESSION['message'] = 'Error al guardar datos';
      $_SESSION['message_type']='danger';
      // header("location: ActualizarEmpleado.php"); 
	}

 if(isset($_SESSION['message'])){
// despues de la parte del alert, la sesion hace que se traiga el dato de cual era el tipo de color que se queria
    ?>
    <div class="alert alert-<?=$_SESSION['message_type']?> alert-dismissible fade show" role="alert">
      <!-- para pintar el mensaje se hace lo siguiente -->
      <?= $_SESSION['message']?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
// <!-- aqui limpiara los datos que esten en sesion, para que no se quede el mensaje en el index, todo el tiempo -->
  session_unset();
}
}
}
}
$presentarEmpleados = $objetoEmpleado->PresentarEmpleadosActualizar($id);
?>         
</script>
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
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo del empleado" value="<?php echo $presentarEmpleados->nombre;?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Correo electronico</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="email" id="email" placeholder="Correo electronico" value="<?php echo $presentarEmpleados->email;?>">
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
    	<select class="form-control" id="area_id" name="area_id">
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
    	<textarea class="form-control" id="descripcion" rows="3" name="descripcion"><?php echo $presentarEmpleados->descripcion;?></textarea>
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
  <!-- rol -->
       <?php
        $i = 0;
        $listaRoles = $objetoRol->PresentarRoles();
        while ($roles = mysqli_fetch_object($listaRoles)) {
          $i++;
          $nombre_rol = $roles->nombre_rol;
          $id_rol = $roles->id_rol;
       ?>
    <div class="form-group row">
      <?php if($i<=1){ ?>
      <label for="descripciones" class="col-sm-2 col-form-label pt-0" required>Roles *</label>
      <div class="col-sm-10">
        <?php }else{ ?>
        <div class="col-sm-10 offset-sm-2">
          <?php } ?>
        <div class="form-check">
          <?php $presentarRoles = $objetoRol->PresentarRolesActualizar($id,$id_rol);
          if($filas = mysqli_fetch_object($presentarRoles)){ ?>
          <input class="form-check-input" type="checkbox" id="id_rol" name="id_rol[]" value="<?php echo $id_rol;?>" checked >
        <?php }else{ ?>
          <input class="form-check-input" type="checkbox" id="id_rol" name="id_rol[]" value="<?php echo $id_rol;?>" >
        <?php }?>
          <label class="form-check-label" for="id_rol">
          <?php echo $nombre_rol; ?>
          </label>
        </div>  
      </div>
    </div>
  <?php }?>
    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary" name="btnActualizar" id="btnActualizar">Actualizar</button>
        <a href="ListarEmpleado.php" class="btn btn-primary">Volver</a>
      </div>
    </div>
  </div>
</form>
<?php require_once("../includes/footer.php"); ?>


