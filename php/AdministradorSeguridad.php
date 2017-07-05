<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 




 class AdministradorSeguridad { 

		private $idUsuario=0;
		private $nombreUsuario='';
		private $esAdmin;
     
	function ingresar($nombreUsuario, $clave) { 
        
		// validar datos (que no sea null)
		
require_once('variablesconexion.php');
$conexion = mysqli_connect($server_c, $user_c, $password_c, $db_c) or die("Error al conectar a la base de datos ->" . mysqli_error($conexion));
mysqli_set_charset($conexion, "utf8");

	
		
		$consulta = "SELECT * FROM usuarios where nombreusuario = '$nombreUsuario'";
     //$conexion = conectar();




    $userDB = mysqli_query($conexion, $consulta);
		
		$fila = $userDB->fetch_assoc();

		if (!isset($fila['nombreusuario'])||($fila['nombreusuario']==null)){
	
			// lanzo exception si hay error
			
			throw new ErrorException("El usuario no existe.", 0);
		} else {
var_dump($userDB);
		}
	
	//	$fila = $userDB->fetch_assoc();
		if ($fila['password'] != $clave) {
			// lanzo exception si hay error
			throw new ErrorException("Clave incorrecta.", 0);
			// "clave ->".$clave, 0, $severidad, $fichero, $línea
		}

	
	
		$this->nombreUsuario = $fila["nombreusuario"];
		$_SESSION['usuario'] = $this->nombreUsuario;
		
		$this->idUsuario = $fila["id"];
		$_SESSION['usuarioid']=$this->idUsuario;
	
		
		$this->esAdmin = $fila["administrador"];
		$_SESSION['admin']=$this->esAdmin;
	
	
	
    } 
	
    function esAdministrador() { 
        
		return ($this->esAdmin==1);
    }

	function usuarioLogeado(){
		
		return ($this->idUsuario!=0); 
	 
} 
function nombreUsuarioLogeado(){
	
		return ($this->nombreUsuario); 
} 

	function setUsuario($id, $nombre, $admin){
		$this->idUsuario = $id;
		$this->nombreUsuario = $nombre;
		$this->esAdmin = $admin;
	}

	
}
?> 
