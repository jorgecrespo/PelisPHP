

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>PelisPHP</title>
 <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/pelis.css" rel="stylesheet">

  
  
  
<body>


<?php
require_once("header.php");
$idpelicula = $_GET['idpelicula'];
echo 'Su comentario se dio de alta en forma exitosa. Haga clic <a href="detallepelicula.php?idpelicula='.$idpelicula.'"> aqui </a> para volver a la pagina anterior.';
include("footer.php")
?>
    <script src="../js/jquery.min.js"></script>
    
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>

