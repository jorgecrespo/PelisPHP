<?php
require_once("funciones.php");

$idpelicula = $_GET['idpelicula'];
sqlbajapelicula($conexion, $idpelicula);
echo"operacion finalizada.";

echo '<a href="backend.php">Volver al Backend</a>';



?>