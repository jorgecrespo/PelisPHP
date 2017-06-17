<?php
require_once("funciones.php");
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$username = $_POST['username'];
$password = $_POST['pass'];
$mail = $_POST['mail'];

/*
function validar($nombre, $apellido, $username, $password, $mail){

$alfanumerico = /^[\w]+$/;
    //var tipopass = ^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?([0-9]|\W)).{6,})\S$;
 $tipopass = /^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?([0-9]|\W)).{6,})\S$/;

    if ($username === "" || $nombre === ""||$password === ""||$mail === ""||$apellido===""){
        alert("Debe completar todos los campos.");
        return false;}  
        else if ($username.length<6 || $password.length<6){
        alert("Tanto el usuario como la contraseña deben tener 6 o mas caracteres.");
        return false;
    } else if (!alfanumerico.test($nombre)){
        alert("El nombre solo admite caracteres alfanumericos.");
        return false;
    } else if (!alfanumerico.test($apellido)){
        alert("El apellido solo admite caracteres alfanumericos.");
        return false;
    }
     else if (!alfanumerico.test($username)){
        alert("El nombre de usuario solo admite caracteres alfanumericos.");
        return false;
    } else if (!tipopass.test($password)){
        alert("el pass no es suficientemente seguro.");
        return false;
    }
 }

var_dump($username);

if (existeusuario($conexion,$username)){
    //$mensaje= "Nombre de usuario existente";
    header('Location:../php/altausuario.php?alerta=Nombre de usuario existente');
} else {
*/
sqlaltausuario($conexion, $nombre, $apellido, $username, $password, $mail);


?>