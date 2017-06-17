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
require_once("header.php");

echo "<h2>Alta de usuarios</h2>";

if (isset($_GET['alerta'])){
    echo "<h3>".$_GET['alerta']."</h3>";
}

?>
<form action="sqlaltausuario.php" method="POST" onsubmit="return validarsingup();">
    <div class="form-group" style="width:600px; padding:20px">
        <label for="aunombre">Nombre</label>
    <input type="text" id ="aunombre" class="form-control" name="nombre" ><br>
    <label for="auapellido">Apellido</label>
    <input id="auapellido" name="apellido" class="form-control" ></input><br>
    <label for="auusuario">Nombre de usuario</label>
    <input type="text" id="auusuario" name="username" class="form-control" ><br>
    <label for="auemail">Email</label>
    <input type="email" id="auemail" name="mail" class="form-control" ><br>
    <label for="auclave">Clave</label>
    <input type="password" id="auclave" name="pass" class="form-control"><br>
    <label for="auclave2">Clave</label>
    <input type="password" id="auclave2" name="pass2" class="form-control"><br>
  
        
    <br>
       <input type="submit" value="Aceptar" class="btn btn-success">
        <a href="../index.php" class="btn btn-danger">Cancelar</a>
</div>
</form>
    <script src="../js/jquery.min.js"></script>
    
    <script src="../js/bootstrap.min.js"></script>
<script>


 function validarsingup(){

   
   
    var nombre, apellido, user, pass, pass2, mail;



    user = document.getElementById("auusuario").value;
    pass = document.getElementById("auclave").value;
    pass2 = document.getElementById("auclave2").value;
    nombre = document.getElementById("aunombre").value;
    apellido = document.getElementById("auapellido").value;
    mail = document.getElementById("auemail").value;


    var alfanumerico = /^[\w]+$/;
    //var tipopass = ^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?([0-9]|\W)).{6,})\S$;
 var tipopass = /^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?([0-9]|\W)).{6,})\S$/;

    if (user === "" || nombre === ""||pass === "" || pass2 === ""||mail === ""||apellido===""){
        alert("Debe completar todos los campos.");
        return false;}  
        else if (pass!==pass2){
            alert("Las contraseñas no coinciden");
            return false;
        }
        else if (user.length<6 || pass.length<6){
        alert("Tanto el usuario como la contraseña deben tener 6 o mas caracteres.");
        return false;
    } else if (!alfanumerico.test(nombre)){
        alert("El nombre solo admite caracteres alfanumericos.");
        return false;
    } else if (!alfanumerico.test(apellido)){
        alert("El apellido solo admite caracteres alfanumericos.");
        return false;
    }
     else if (!alfanumerico.test(user)){
        alert("El nombre de usuario solo admite caracteres alfanumericos.");
        return false;
    } else if (!tipopass.test(pass)){
        alert("el pass no es suficientemente seguro.");
        return false;
    }
 }
 
</script>

</body>
</html>