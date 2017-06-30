<?php


function conectar(){
require_once('variablesconexion.php');
$conexion = mysqli_connect($server_c, $user_c, $password_c, $db_c) or die("Error al conectar a la base de datos ->" . mysqli_error($conexion));
mysqli_set_charset($conexion, "utf8");
return $conexion;
}


?>