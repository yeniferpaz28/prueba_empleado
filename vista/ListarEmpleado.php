<?php
session_start();
require_once("../includes/header.php");
require_once("../modelo/ModeloEmpleado.php");

// mensaje 
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
?>
<div class="container-fluid">
	<div class="form-row" id="row1">
		<div class="col-sm-4">
			<h1>Lista de empleados</h1>
		</div>
		<div class="col-sm-2 offset-sm-6">
			<a href="GuardarEmpleado.php" class="btn btn-primary">Nuevo Usuario</a>		
		</div>
	</div>
<table class="table table-hover">
  <thead class="table table-primary">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Sexo</th>
      <th scope="col">Área</th>
      <th scope="col">Boletín</th>
      <th scope="col">Detalles</th>
      <th scope="col">Modificar</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>    
	<?php
	$objetoEmpleados = new ModeloEmpleado();

    $presentarEmpleado = $objetoEmpleados->ListarEmpleados();
    while($filas = mysqli_fetch_object($presentarEmpleado)){
      $id = $filas->id_empleado;
      $nombre = $filas->nombre;
      $email = $filas->email;
      $sexo = $filas->sexo;
      $boletin = $filas->boletin;
      $descripcion = $filas->descripcion;
      $area_id = $filas->area_id;
      $area_nombre = $filas->area_nombre; 
	?>
    <tr>
      <td><?php echo $nombre;?></td>
      <td><?php echo $email;?></td>
      <td><?php echo $sexo;?></td>
      <td><?php echo $area_nombre;?></td>
      <td><?php echo $boletin;?></td>
      <td><a href="DetallesEmpleado.php?id=<?php echo $id?>"><i class="fas fa-clipboard-list"></i></a></td>
      <td><a href="ActualizarEmpleado.php?id=<?php echo $id?>"><i class="fas fa-edit"></i></a></td>
      <td><a href="EliminarEmpleado.php?id=<?php echo $id?>"><i class="fas fa-trash-alt"></i></a></td>         
    </tr>
    <?php
		}
    ?>
  </tbody>
</table>
</div>
<?php
require_once("../includes/footer.php");
?>