<?php 
session_start();
 




 class AdministradorSeguridad { 

		private $idUsuario=0;
		private $nombreUsuario;
		private $esAdmin;
     
	function ingresar($nombreUsuario, $clave) { 
        
		// validar datos (que no sea null)
		

$conexion = mysqli_connect('localhost', 'root', '', 'peliculas') or die("Error al conectar a la base de datos ->" . mysqli_error($conexion));
mysqli_set_charset($conexion, "utf8");

	
		
		$consulta = "SELECT * FROM usuarios where nombreusuario = '$nombreUsuario'";
     //$conexion = conectar();




    $userDB = mysqli_query($conexion, $consulta);
		
	
		// controlar autenticacion
		if ($userDB == null) {
			// lanzo exception si hay error
			throw new ErrorException("El usuario no existe.", 0);
		}
		//"clave ->".$clave, 0, $severidad, $fichero, $línea 
		//ver que son los parametros de la excepcion
		$fila = $userDB->fetch_assoc();
		if ($fila['password'] != $clave) {
			// lanzo exception si hay error
			throw new ErrorException("Clave incorrecta", 0);
			// "clave ->".$clave, 0, $severidad, $fichero, $línea
		}

	//	$usuario = new Usuario;
		$this->nombreUsuario = $fila["nombreusuario"];
		$_SESSION['usuario'] = $this->nombreUsuario;
		
		$this->idUsuario = $fila["id"];
		$_SESSION['usuarioid']=$this->idUsuario;
	
		
		$this->esAdmin = $fila["administrador"];
		$_SESSION['admin']=$this->esAdmin;
	
		// retornas el usuario, con los roles
	
    } 
	
    function esAdministrador() { 
        
		return ($this->esAdmin);
    }

	function usuarioLogeado(){
		
		return ($this->idUsuario); 
} 

	function setUsuario($id, $nombre, $admin){
		$this->idUsuario = $id;
		$this->nombreUsuario = $nombre;
		$this->esAdmin = $admin;
	}

	
}
?> 
