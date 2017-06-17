<?php
require_once("funciones.php");
require_once("conexion.php");

$nombre = $_POST['nombre'];
$sinopsis = $_POST['sinopsis'];
$estreno = $_POST['estreno'];
$genero = $_POST['genero'];


// archivo temporal (ruta y nombre)
 
$tmp_name = $_FILES["imagen"]["tmp_name"];
 
// Obtenemos los datos de la imagen tamaño, tipo y nombre
 
$tamano = $_FILES["imagen"]['size'];
 
$tipoimagen = $_FILES["imagen"]['type'];
 
$nombreimagen = $_FILES["imagen"]["name"];
 
//ruta completa
 
$archivo_temporal = $_FILES['imagen']['tmp_name'];
 
//leer el archivo(imagen) temporal en binario
 
$fp = fopen($archivo_temporal, 'r+b');
 
$data = fread($fp, filesize($archivo_temporal));
 
ob_end_clean();
 
ob_start();
 

$data = mysqli_real_escape_string($conexion, $data);
 
fclose($fp);



sqlaltapelicula($conexion, $nombre, $sinopsis, $estreno, $genero, $data, $tipoimagen);

?>