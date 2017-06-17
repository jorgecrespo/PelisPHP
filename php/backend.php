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

<div style="padding:10px;">
    <?php
    session_start();

    require_once("header.php");

    
if(!isset($_SESSION['admin'])){
   header("location:../index.php");
 
 }

require_once("funciones.php");

echo '<div class="page-header">
  <h1>Administracion de peliculas <small>Solo para usuarios autorizados.</small></h1>
</div>';
tablabackend($conexion);

    echo '<a href="altapelicula.php" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Pelicula</a>';
    
    ?>
    </div>
     <script src="../js/jquery.min.js"></script>
    
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>