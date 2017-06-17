<?php

	include("AdministradorSeguridad.php");
	login();
	// desde tu método donde llamas al boton ingresar/login
	function login () {
	
		// instancias la clase
		$administrador = new AdministradorSeguridad;
	
		try {
			// llamas al metodo de la clase y le pasas los valores del formulario
			$usuario = $administrador->ingresar($_GET["nombre"], $_GET["password"]);
			header('Location:../index.php');
		/*	
			// aca el login funciono bien, podes saber si es admnistrador, u obtener los roles
			
			$usuario->roles; // preguntar si la lista de roles tiene el rol en particular que busco
			
			// o directamente si es admnistrador hacer tal cosa
			if ($usuario->esAdministrador()) {
				// ocultar botones de edicion, etc

		*/
			
			
		} catch (Exception $e) {
			// si hay una exception, mostrar el mensaje en la pantalla o algun alert o similar
			echo 'Error al ingresar: ',  $e->getMessage(), "\n";
			$er = $e->getMessage();
			header('Location:../php/singin.php?alerta='.$er);
		}
	}


?>
