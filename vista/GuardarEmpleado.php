<?php
session_start();
require_once("../includes/header.php");
require_once("../modelo/ModeloEmpleado.php");
require_once("../modelo/ModeloArea.php");
require_once("../modelo/ModeloRol.php");

$vBoletin = 0;
if(isset($_POST['boletin'])){
	if($_POST['boletin']=='on'){
		$vBoletin = 1;
	}else{
		$vBoletin = 0;
	}
}
if (isset($_POST['btnGuardar'])) {
	
	if(isset($_POST) && !empty($_POST)){
		$nombre = ($_POST['nombre']);
		$email = ($_POST['email']);
		
		$descripcion = ($_POST['descripcion']);
		$area_id = ($_POST['area_id']);
		$boletin = $vBoletin;
    // $id_rol = ($_POST['id_rol']);
    // validar
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if(trim($nombre)==''){
      $_SESSION['message_error'] = 'Debe agregar un nombre';
      $_SESSION['message_type_error']='danger';
    }    
    // Luego validamos el email
    else if(trim($email)==''){
      $_SESSION['message_error'] = 'Debe agregar un correo';
      $_SESSION['message_type_error']='danger';

    } 
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
        // echo("$email es una dirección de email válida");
      $_SESSION['message_error'] = 'No es una dirección válida de correo';
      $_SESSION['message_type_error']='danger';
    }
    else if(empty(($_POST['sexo']))){
      // error $sexo;      
      $_SESSION['message_error'] = 'Debe seleccionar un sexo';
      $_SESSION['message_type_error']='danger';

    }
    else if(trim($area_id)==''){
      $_SESSION['message_error'] = 'Debe seleccionar una área';
      $_SESSION['message_type_error']='danger';
    }
    else if(trim($descripcion)==''){
      $_SESSION['message_error'] = 'Debe agregar una descripción';
      $_SESSION['message_type_error']='danger';
    } 
    else if(empty($_POST['id_rol'])){
      $_SESSION['message_error'] = 'Debe seleccionar al menos un rol';
      $_SESSION['message_type_error']='danger';
    }
   else{
  $sexo = ($_POST['sexo']);
    $objetoEmpleado = new ModeloEmpleado();
		$empleado = $objetoEmpleado->GuardarEmpleados($nombre,$email,$sexo,$area_id,$boletin,$descripcion);

    $objetoRol = new ModeloRol();
         
    if (!empty($_POST['id_rol'])){
      foreach ($_POST['id_rol'] as $seleccion) {
        // echo "<p>".$seleccion."</p>";
        $rol = $objetoRol->GuardarRoles($seleccion,$empleado);
      }
    } 
           // $rol = $objetoRol->GuardarRoles($id_rol,$empleado);
		if($empleado && $rol){
      $_SESSION['message'] = 'Datos guardados correctamente';
      $_SESSION['message_type']='success';
      header("location: ListarEmpleado.php");

    }else{
      $_SESSION['message'] = 'Error al guardar datos';
      $_SESSION['message_type']='danger';
      header("location: ListarEmpleado.php");
    }
	}
}
}
if(isset($_SESSION['message_error'])){
// despues de la parte del alert, la sesion hace que se traiga el dato de cual era el tipo de color que se queria
    ?>
    <div class="alert alert-<?=$_SESSION['message_type_error']?> alert-dismissible fade show" role="alert">
      <!-- para pintar el mensaje se hace lo siguiente -->
      <?= $_SESSION['message_error']?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
// <!-- aqui limpiara los datos que esten en sesion, para que no se quede el mensaje en el index, todo el tiempo -->
  session_unset();
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
    <label for="nombre" class="col-sm-2 col-form-label">Nombre Completo *</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo del empleado" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Correo electrónico *</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="email" id="email" placeholder="Correo electrónico" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Sexo *</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sexo" id="sexoMasculino" value="M" <?php if(isset($_POST['sexo'])  =='M') echo 'checked';?>>
          <label class="form-check-label" for="sexoMasculino">
            Masculino
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="sexo" id="sexoFemenino" value="F" <?php if(isset($_POST['sexo'])  =='F') echo 'checked';?>>
          <label class="form-check-label" for="sexoFemenino">
            Femenino
          </label>
        </div>        
      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <label for="area" class="col-sm-2 col-form-label">Área *</label>
    <div class="col-sm-10">
    	<select class="form-control" id="area_id" name="area_id">
      <option value="">:..</option>
      <?php
      if(isset($_POST['area_id'])){
        $selecArea = $_POST['nombre'];
      } 
            $objetoArea = new ModeloArea();
          $listaAreas = $objetoArea->ListarAreas();
          while($areas = mysqli_fetch_array($listaAreas)){
            echo '<option '.$selecArea.' value = "'.$areas[id].'">'.$areas[nombre].'</option>\n';
          }      
      ?>
    </select>
    </div>    
  </div>
  <div class="form-group row">
    <label for="descripciones" class="col-sm-2 col-form-label" required>Descripción *</label>
    <div class="col-sm-10">
    	<textarea class="form-control" id="descripcion" rows="3" name="descripcion"><?php if(isset($_POST['descripcion'])) echo $_POST['descripcion'];?></textarea>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="boletin" name="boletin" <?php if(isset($_POST['boletin'])  =='on') echo 'checked';?>>
        <label class="form-check-label" for="boletin">
          Deseo recibir boletín informativo
        </label>
      </div>
    </div>
  </div>
  <!-- rol -->
    <?php 
    $nuevo = 0;
    $objetoRol = new ModeloRol();
    $listaRoles = $objetoRol->PresentarRoles();
    while($roles = mysqli_fetch_array($listaRoles)){
      $nuevo += 1;

      $id_rol = $roles[0];
      $nombre_rol = $roles[1];
      
  ?>
  <div class="form-group row">
      <?php if($nuevo == 1){ ?>
      <label for="id_rol" class="col-sm-2 col-form-label pt-0" required>Roles *</label>
    <div class="col-sm-10">
      <?php }else{ ?>
        <div class="col-sm-10 offset-sm-2">
        <?php }?>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="<?php echo 'id_rol_'.$nuevo;?>" name="id_rol[]" value="<?php echo $id_rol;?>" <?php if(isset($_POST['id_rol']) == $id_rol) echo 'checked';?>>
        <label class="form-check-label" for="<?php echo 'id_rol_'.$nuevo;?>">
          <?php echo $nombre_rol;
           // $a = 
            // echo $nuevo;
          ?>
        </label>
      </div>
    </div>    
  </div>
  <?php } 
  ?>
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