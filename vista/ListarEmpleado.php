<?php
require_once("../includes/header.php");
require_once("../modelo/ModeloEmpleado.php");

// mensaje de eliminar
if(isset($_GET['mensaje1'])){
	echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
		 	El empleado ha sido eliminado exitosamente
		 	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		    	<span aria-hidden='true'>&times;</span>
		  	</button>
		</div>";

}else if(isset($_GET['mensaje1'])){
	echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
		  	Error al eliminar empleado
		  	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		    	<span aria-hidden='true'>&times;</span>
		  	</button>
		</div>";
}
// listar datos

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
      <th scope="col">Area</th>
      <th scope="col">Boletin</th>
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