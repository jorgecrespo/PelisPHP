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
  session_start();


include("AdministradorSeguridad.php");
$administrador = new AdministradorSeguridad();
$administrador->setUsuario($_SESSION['usuarioid'],$_SESSION['usuario'],$_SESSION['admin']);

if(!$administrador->esAdministrador()){
   header("location:../index.php");
 
 }
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
     <!--<input type="file" accept="image/*" id="apimagen" class="form-control" name="imagen"><br> -->
         <input type='file' id="apimagen" accept="image/*" class="form-control" name="imagen"> <br>
    <img id="preViewImg" src="#" alt="imagen" class="img-thumbnail">
<br><br><br><br>
          <input type="submit" value="Guardar" class="btn btn-success">
    
    
<script>



function readURL(input) {
 if (input.files && input.files[0]) {
     var reader = new FileReader();
     reader.onload = function (e) {
        $('#preViewImg').attr('src', e.target.result);
     }
 
    reader.readAsDataURL(input.files[0]);
 }
}
 
$(document).on('change','#apimagen',function(){
    readURL(this);
});
 
</script>






    <?php

   echo '</div>
 
  

</form>';

include("footer.php");
?>
    <script src="../js/jquery.min.js"></script>
    
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>