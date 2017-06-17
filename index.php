<?php 
// session_start();
include("php/AdministradorSeguridad.php");

	//comentario nuevo
	
		$administrador = new AdministradorSeguridad();

//PARA OCULTAR WARNINGS Y NOTICES
error_reporting(E_ERROR | E_WARNING | E_PARSE); 

if(isset($_SESSION['usuario'])){  
       $administrador->setUsuario($_SESSION['usuarioid'],$_SESSION['usuario'], $_SESSION['admin']);
}

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
    
//   include("php/header.php");
 if (isset($_SESSION['usuario'])){
    echo "Usuario: ".$_SESSION['usuario']."<br> Usuario ID: ".$_SESSION['usuarioid']."<br>";
    echo "<a href='php/cerrarsesion.php'>Cerrar sesion</a>";
    if($administrador->esAdministrador()){
echo '<a href="php/backend.php">Backendd</a>';
} else {
  echo"el usuario no es administrador.";
}
} else {
        //    echo "Variables de sesion sin definir.<br>";
        echo '<a href="php/altausuario.php">Registrarse</a>
<a href="php/singin.php">Iniciar Sesion</a>
';

        
}



    

echo '<div>';
    
   include("php/busquedas.php");
      
echo'</div>';

  
    
include("php/listapeliculas.php");
    
echo '</div>';
    


?>
    
     <script src="js/jquery.min.js"></script>
    
    <script src="js/bootstrap.min.js"></script>
</body>
</html>