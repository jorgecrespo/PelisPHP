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
include("header.php");
?>
<h2>Alta de peliculas</h2>
<form enctype="multipart/form-data" action="sqlaltapelicula.php" method="POST">
<div class="form-group" style="width:600px; padding:20px">
    <label for="apnombre">Nombre</label>
    <input type="text" class="form-control" id ="apnombre"name="nombre">
    <br>
    <label for="apsinopsis">Sinopsis</label>
    <textarea name="sinopsis"  class="form-control" id="apsinopsis"></textarea>
    <br>
    <label for="apanio">Año</label>
    <input type="number" id="apanio" class="form-control" name="estreno">
    <br>
<?php
    require_once("funciones.php");
   selectaltapeli($conexion);
    ?>
    <label for="apnombre" id="apimagen" >Imagen</label>
     <input type="file" accept="image/*" id="apimagen" class="form-control" name="imagen"><br>
          <input type="submit" value="Guardar" class="btn btn-success">

   </div>
 
  

</form>
<?php
include("footer.php");
?>
    <script src="../js/jquery.min.js"></script>
    
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>