<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>PelisPHP</title>
 <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/pelis.css" rel="stylesheet">

</head>
<body>


<?php

require_once("header.php");

require_once("funciones.php");

$idpelicula = $_GET['idpelicula'];
sqlbajapelicula($conexion, $idpelicula);


echo '<a href="backend.php">Volver al Backend</a>';

include_once("footer.php");

?>

  <script src="../js/jquery.min.js"></script>
    
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>