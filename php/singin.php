<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>PelisPHP</title>
 <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/pelis.css" rel="stylesheet">

  
  
   <script >

var parametro = getParameterByName('alerta');
if (parametro.length>0){
    alert(parametro);
}

   function validarlogin(){

   
   
    var user, pass;

    user = document.getElementById("loginuser").value;
    pass = document.getElementById("loginpass").value;
    var alfanumerico = /^[\w]+$/;
    var tipopass = ^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?([0-9]|\W)).{6,})\S$;

    if (user === "" || pass === ""){
        alert("Debe completar los dos campos para inciar sesion.");
        return false;
    } 
   

};
   
   </script> 
</head>
<body>


<h2>Iniciar sesion</h2>
<form action="controler.php" method="GET" onsubmit="return validarlogin();">
    <div class="form-group" style="width:600px; padding:20px">
        <label for="loginuser">Nombre</label>
   <input type="text" id="loginuser" class="form-control" name="nombre">
    <label for="loginpass">Contraseña</label>

     <input type="password" id="loginpass" class="form-control" name="password"><br>

<?php
if (isset($_GET['alerta'])){
    echo "<h3>".$_GET['alerta']."</h3>";
}

?>
    <br>
     <input type="submit" value="Ingresar" class="btn btn-success">
 <a href="../index.php" class="btn btn-danger">Cancelar</a>

    </div>
</form>
 
    <script src="../js/jquery.min.js"></script>
    
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>