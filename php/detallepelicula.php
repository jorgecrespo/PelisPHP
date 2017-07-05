
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
if (isset($_SESSION['usuarioid'])){

$administrador->setUsuario($_SESSION['usuarioid'],$_SESSION['usuario'],$_SESSION['admin']);
} else {
    $administrador->setUsuario(0,'',0);
}
 

require_once("header.php");
require_once("funciones.php");

if ($administrador->usuarioLogeado() and !$administrador->esAdministrador()){
    detalleconcomentarios($conexion,$_GET['idpelicula'] ,$_SESSION['usuarioid']);
} else {
    detalleconcomentarios($conexion,$_GET['idpelicula'] ,null);

    
};
include("footer.php")
?>
    <script src="../js/jquery.min.js"></script>
        <script src="../js/funciones.js"></script>
    
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
