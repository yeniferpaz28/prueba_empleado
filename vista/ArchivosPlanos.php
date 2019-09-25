<?php
require_once("../includes/header.php");
require_once("../modelo/ModeloArchivosPlanos.php");
$objetoArPlanos = new ModeloArchivosPlanos();
if(isset($_POST['submit'])){
 //Aquí es donde seleccionamos nuestro csv
    $fname = $_FILES['sel_file']['name'];
    $chk_ext = explode(".",$fname);
    if(strtolower(end($chk_ext)) == "csv"){
    //si es correcto, entonces damos permisos de lectura para subir
        $filename = $_FILES['sel_file']['tmp_name'];
        $handle = fopen($filename, "r");

        $i=0;
        while (($data = fgetcsv($handle, 0,";")) !== FALSE){
            if($i>0){
            		if(!preg_match("/^[3][0-9]{9}$/", $data[0])){
             		$array1[] = $data[0];
             	} // comparar los datos con la lista negra
     			else if(preg_match("/^[3][0-9]{9}$/", $data[0])){
     				$telefono = $data[0];
     				$compararTelefono = $objetoArPlanos->ValidarBlackList($telefono);
	         		if (!empty($compararTelefono)) {
	         			$array2[] = $compararTelefono;
	         		}
	         		else{
	         		$array[] = $data;

	         		}
         		}
            }
            $i++;
        }
   	}
}
?>
	<title>Cargar archivo</title>
	<div class="container-fluid" id="container">
		<form method='post' enctype="multipart/form-data" >
			<div class="form-row" id="row">
				<div class="col-sm-4">
					<h1>Cargar archivo</h1>
				</div>
			</div>
			<div class="form-group">
				<label for="nombre" class="col-sm-2 col-form-label" id="labelImportar">Importar Archivo</label>
				<div class="col"><input type='file' name='sel_file' size='20' id="examinar"></div>
				<div class="col"><?php if(isset($fname) && !empty($fname)){echo 'Archivo cargado: '.$fname.' <br>';}?></div>
				<div class="col"><input type='submit' name='submit' value='Validar archivo' class="btn btn-primary" id="submit">
					<a href="ListarEmpleado.php" class="btn btn-primary" id="volver">Volver</a></div>
				</div>
		</form>
		<?php if(isset($array2)){ ?>
		<table class="table table-bordered table-sm">
			<thead class="table-info" >
				<tr>
					<th colspan="3" id="thTitulo">Listado de elementos en lista negra</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="col">No.</th>
					<th scope="col">Nombre</th>
					<th scope="col">Teléfono</th>
				</tr>
				<?php $contador=0;
					foreach ($array2 as $nuevoValor) {
						$contador++; ?>
				<tr>
					<td><?php echo $contador; ?></td>
					<td><?php echo $nuevoValor->fullname; ?></td>
					<td><?php echo $nuevoValor->phone; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } if(isset($array1)){ ?>
		<table class="table table-bordered table-sm">
			<thead class="table-info">
			<tr><th colspan="2" id="thTl">Listado de teléfonos que no pasaron validación</th></tr>
			</thead>
			<tbody>
				<tr>
					<th>No.</th>
					<th>Teléfono</th>
				</tr>
				<?php $contadores=0;
					 foreach ($array1 as $newArray) {
						$contadores++; ?>
				<tr>
					<td><?php echo $contadores; ?></td>
					<td>
						<?php echo $newArray; ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<form method="post" action="GenerarArchivo.php">
		<?php foreach ($array as $key => $value) { ?>
		<input type="hidden" name="phone[]" value="<?php echo $value[0];?>">
		<input type="hidden" name="message[]" value="<?php echo $value[1];?>">
		<?php } ?>
		<div class="divDescargar">
			<label>Puede descargar el nuevo listado</label>
			<input class="inputDescargar" type="submit" name="reporte" value="aquí">
		</div>
	</form>

<?php }
require_once("../includes/footer.php");
?>