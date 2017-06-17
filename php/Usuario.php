<?php

// clase definida en algun archivo, por ejemplo Usuario.php
class Usuario {
	var  $nombreUsuario = "";
	var  $rol = 0;
	var $id = 0;
	
	
	public function getRol(){		
		return $this->rol;
	}

	public function getUsuario(){
	return $this->nombreUsuario;
	}
	

	public function getId(){
		return $this->id;
	}

	public function setUsuario($nombreUsuario){
	$this->nombreUsuario = $nombreUsuario;	
	}


	public function setRol($rol){
	$this->rol = $rol;
	}

	public function  setId($id){
		$this->id = $id;
	}

}

?>
