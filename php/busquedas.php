<?php
include_once("funciones.php");
include("php/AdministradorSeguridad.php");


//objeto ADMINISTRADOR
$administrador = new AdministradorSeguridad();
if(isset($_SESSION['usuario'])){  
       $administrador->setUsuario($_SESSION['usuarioid'],$_SESSION['usuario'], $_SESSION['admin']);
}
var_dump($administrador);

echo '
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-left">
        <li><a href="index.php?criterio=""&orden=2">Todas</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Géneros<span class="caret"></span></a>
          <ul class="dropdown-menu">';
listargeneros($conexion);

        echo'
          </ul>
        </li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Año<span class="caret"></span></a>
          <ul class="dropdown-menu">';
        
        listaranios($conexion);
        echo '
          </ul>
        </li>
      </ul>
      
      <form class="navbar-form navbar-left" action="index.php" method="get">
        <div class="form-group">
       
          <input type="text" class="form-control"  name="criterio" placeholder="Buscar">
      

        </div>
         
    
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </form>
      <ul class="nav navbar-nav navbar-right"">';
//si no hay usuario registrado mostrar botones Iniciar Sesion y Registrarse, sino mostrar boton de cerrar sesion, y si es admin mostrar boton de Backend
if (!$administrador->usuarioLogeado()){

     echo'  <li class="active"><a href="php/altausuario.php">Registrarse <span class="sr-only">(current)</span></a></li>
        <li><a href="php/singin.php">Iniciar Sesión</a></li>';
} else {
    if ($administrador->esAdministrador()){
        echo '<li class="active"><a href="php/backend.php">Backend<span class="sr-only">(current)</span></a></li>';
    }

    echo'<li><a href="php/cerrarsesion.php">Cerrar Sesión</a></li>';
}


     
    echo'    
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>';
?>
