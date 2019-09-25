<?php
 if (isset($_POST['reporte']) && $_POST['phone'] && $_POST['message']){
        // genera_reporte();
        header('Content-Type:text/csv; charset-latin1');
        header('Content-Disposition: attachment; filename="nuevo_data.csv"');
        // salida del archivo
        $salida=fopen('php://output', 'w');
        // encabezado
        fputcsv($salida, array('phone','messages'),';');
         $nuevoResultado = $_POST['phone'];
         $nuevoArreglo = $_POST['message'];
         $array = array_combine($nuevoResultado,$nuevoArreglo);

        $contadorN=0;
        foreach ($array as $filas => $value) {
            $contadorN++;
             fputcsv($salida, array($filas, $value),';');
        }
    }
?>