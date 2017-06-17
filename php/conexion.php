<?php

function conectar(){
$conexion = mysqli_connect('localhost', 'root', '', 'peliculas') or die("Error al conectar a la base de datos ->" . mysqli_error($conexion));
mysqli_set_charset($conexion, "utf8");
return $conexion;
}


?>