<?php
require_once("funciones.php");

$usuario=$_POST['nombre'];
$password=$_POST['password'];
    
login($conexion, $usuario, $password);


?>