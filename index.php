<?php 
// session_start();


//PARA OCULTAR WARNINGS Y NOTICES
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>PelisPHP</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/pelis.css" rel="stylesheet">
  
</head>
<body id="bodyindex">
  
<?php    
    

require_once("php/header.php");

    


    
   include("php/busquedas.php");
      


  
    
include("php/listapeliculas.php");
    

    
include("php/footer.php")

?>
    
     <script src="js/jquery.min.js"></script>
    
    <script src="js/bootstrap.min.js"></script>
</body>
</html>