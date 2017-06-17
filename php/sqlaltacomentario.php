<?php
require_once("funciones.php");
$comentario = $_POST['accomentario'];
$puntaje = $_POST['puntaje'];
$idusuario = $_POST['idusuario'];
$idpelicula = $_POST['idpelicula'];
$fecha = date("Y-m-d H:i:s");
sqlaltacomentario($conexion, $comentario, $puntaje, $idusuario, $idpelicula, $fecha);

?>