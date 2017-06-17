<?php
//session_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("conexion.php");

$conexion = conectar();

function puntajepromedio($conexion, $idpelicula){
    $consulta = "SELECT calificacion FROM comentarios where peliculas_id = $idpelicula";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado){
        $n=0;
        $total = 0;
        while ($fila = mysqli_fetch_array ($resultado)) {
            $n++;
            $total +=$fila['calificacion'];
        }
        if ($n!=0){
        $promedio =$total/$n; 
        } else {$promedio=0;}
    }
    return $promedio;
}

function sqlaltacomentario($conexion, $comentario, $puntaje, $idusuario, $idpelicula, $fecha){
        $consulta = "INSERT INTO `comentarios` (`id`, `usuarios_id`, `peliculas_id`, `comentario`, `calificacion`, `fecha`) VALUES (NULL, '$idusuario', '$idpelicula', '$comentario', '$puntaje', '$fecha');";
    
    $resultado = mysqli_query($conexion, $consulta);
    mysqli_close($conexion);
    header('Location: ../php/altacomentariok.php?idpelicula='.$idpelicula);
}


function login($conexion, $usuario, $password){
    echo "usuario: ".$usuario." - Pass: ".$password."<br>";
      $consulta = "SELECT * FROM usuarios WHERE nombreusuario = '$usuario'";
    $resultado = mysqli_query($conexion, $consulta);
    
    if ($resultado){
     
        while ($fila = mysqli_fetch_array ($resultado)) {
            if ($fila['password'] != $password){
                echo "contraseña incorrecta";
            } else{
                $_SESSION['usuario']=$usuario;
                $_SESSION['usuarioid']=$fila['id'];
                if (!$fila['administrador']== 0){
                    $_SESSION['admin']=1;
                    }
                echo "Se definieron las variables de sesion usuario: ".$_SESSION['usuario']." y usuarioid: ".$_SESSION['usuarioid'];
               
                header('Location: ../index.php');
                    
            }}
    }else {
        echo "Usuario inexistente.";
    }
}






function listarpeliculas($conexion){
    
    //paginacion
    $cantporpagina = 5;
    if (isset($_GET['pagina'])){
        $pagina = $_GET['pagina'];
        $inicio = ($pagina - 1) * $cantporpagina; 
    } else {
        $inicio = 0;
        $pagina = 1;
    }
   
    //criterios de presentacion '~' determina el año , '-' determina el genero, '%' busqueda por texto, '' todas las peliculas.
    if (isset($_GET['criterio'])){
  
        $criterio = $_GET['criterio'];       
       
        switch ($criterio[0]){
            case '~': 
                $anio = substr($criterio, 1);
             
                $criteriotxt = " where peliculas.anio = ".$anio;
              
                break;
            case '':
                $criteriotxt = "";                
                break;
            case '-':
                $genero = substr($criterio, 1);
                $criteriotxt = " where peliculas.generos_id = ".$genero;
              
                break;
            default:
                $criteriotxt = " where peliculas.nombre like '%" . $criterio . "%'";
            
        }
    } else {
        $criterio ='';
         $criteriotxt = "";     
    }
  

if (isset($_GET['orden'])){$orden = $_GET['orden'];} else {$orden = 1;}
   
      switch ($orden){
            case '2': 
               $campo = " ORDER BY peliculas.nombre DESC";
              
                break;
            case '3':
                $campo = " ORDER BY peliculas.anio ASC";               
                break;
            case '4':
               $campo = " ORDER BY peliculas.anio DESC";
              
                break;
            default:
                $campo = " ORDER BY peliculas.nombre ASC";
      }


        
    $consulta = "SELECT peliculas.id, peliculas.nombre, peliculas.sinopsis, peliculas.anio, generos.genero FROM peliculas inner join generos on peliculas.generos_id = generos.id ";

    if (isset($criteriotxt)){
        $consulta .=$criteriotxt;
    }
    $consulta .=$campo;
  
  
    $resultado = mysqli_query($conexion, $consulta);
    
    if ($resultado)
    {
        $numero_de_registros = mysqli_num_rows($resultado);
       
        $cantidad_de_paginas = ceil($numero_de_registros / $cantporpagina);
        echo "<br><br>";


 echo '<div style="margin-left:25%;padding:1px 16px;height:1000px;">';  
 
 echo 'Ordenar por  <a href="index.php?criterio='.$criterio.'&orden=3"><span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span></a> Año <a href="index.php?criterio='.$criterio.'&orden=4"><span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></a> o por <a href="index.php?criterio='.$criterio.'&orden=1"><span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span></a> Nombre <a href="index.php?criterio='.$criterio.'&orden=2"><span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></a>';
 

echo '<br>';
        
        
       /* 
        echo "Numero de registros encontrados ".$numero_de_registros.".<br>";
        echo "Se muestran paginas de ".$cantporpagina." por pagina.<br>";
        echo "Ahora mostrando pagina ".$pagina." de ".$cantidad_de_paginas." paginas.<br>";
        */
        echo "<ul> "; 
        
        $consulta_parcial = $consulta ." limit ".$inicio.",".$cantporpagina;
        $resultado_parcial = mysqli_query($conexion, $consulta_parcial);
        
        
        while ($fila = mysqli_fetch_array ($resultado_parcial)) {
            echo '<li><div style="padding:10px; display:table;">';
            $idpeli = $fila['id'];
            echo '<div style=""><a href="php/detallepelicula.php?idpelicula='.$fila['id'].'"><h3>' .$fila['nombre']."</a><small> (".$fila['anio'].')</small></h3></div>';
            //div imagen
            echo '<div style="padding:10px; width:35%; float:left; "><a href="php/detallepelicula.php?idpelicula='.$fila['id'].'"><div><img src="php/mostrarimagen.php?idpelicula='.$fila['id'].'" class="img-thumbnail" style="height:400px; display:block; margin:auto;" ></div></a></div>';
            //div datos
            echo '<div style=" float: right; width:65%; padding:10px;"><h4>'.$fila['genero'].'</h4>';
  
           $puntajepx = puntajepromedio($conexion, $idpeli) * 140 / 5;
         
         
           echo '<h4>Puntaje: </h4>';
           if ($puntajepx>0){
            
           echo '<div style="width:'.$puntajepx.'px;overflow: hidden; display: inline-block;"><img src="img/estrellas.png" style="width:140px;height:30px;"></div>';
           } else {
               echo "Sin calificar";
           }
            echo "<h4>Sinopsis: </h4>".$fila['sinopsis'];
            echo '</div></div><br>';
                
            
                
            echo '</li>';
            }
        echo "</ul>";
     


        if ($cantidad_de_paginas > 1){
                echo '<nav aria-label="Page navigation">
  <ul class="pagination pagination-lg">';
    for ($i=1;$i<=$cantidad_de_paginas;$i++){
      
       if ($pagina == $i)
         
          echo '<li class="active"><a href="#">'.$pagina . '<span class="sr-only">(current)</span></a> </li>';
       else
       {
         //considerar un 
         if (!isset($criterio)){$criterio = '';};
          echo "<li><a href='index.php?pagina=" . $i . "&criterio=".$criterio."&orden=".$orden."'>" . $i . "</a> </li>";
       }
     
    }
      echo '   </ul>
</nav>';
} 
            mysqli_free_result($resultado);
            mysqli_close($conexion);
        
    }
      
    
}







function sqlaltausuario($conexion, $nombre, $apellido, $username, $password, $mail){
/*
    $consultax = "SELECT * from usuarios where nombreusuario=$username";
   $resultadox = mysqli_query($conexion, $consultax);
    
    $cantidad = mysqli_num_rows($resultadox);
var_dump($cantidad);

if ($cantidad==null){ 
 
    header('Location:../php/altausuario.php?alerta=Nombre de usuario existente');
 
}
 else { */
  //si el usuario no existe previamente
      $consulta = "INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `nombreusuario`, `password`, `administrador`, `email`) VALUES (NULL, '$nombre', '$apellido', '$username', '$password', '', '$mail')";
    
    $resultado = mysqli_query($conexion, $consulta);
    mysqli_close($conexion);

    echo '<p>Usuario dado de alta. Haga click <a href="singin.php">aqui</a> para iniciar su sesion.</p>';
 // }


}

function sqlaltapelicula($conexion, $nombre, $sinopsis, $estreno, $genero, $imagen, $tipoimagen){

    $consulta = "INSERT INTO peliculas (id, nombre, sinopsis, anio,generos_id, contenidoimagen, tipoimagen) VALUES (NULL, '$nombre', '$sinopsis', '$estreno', '$genero', '$imagen', '$tipoimagen')";
    echo $consulta;
    $resultado = mysqli_query($conexion, $consulta);
 //   echo $resultado;
    mysqli_close($conexion);
    
   header('Location: ../index.php');
}

function sqlupdatepelicula($conexion, $idpelicula, $nombre, $sinopsis, $estreno, $genero, $imagen, $tipoimagen){

    $consulta = "UPDATE peliculas SET nombre = '$nombre', sinopsis = '$sinopsis', anio = '$estreno',generos_id = '$genero',contenidoimagen = '$imagen',tipoimagen = '$tipoimagen' WHERE id = $idpelicula";
    
// echo $consulta;  
    $resultado = mysqli_query($conexion, $consulta);
    mysqli_close($conexion);
    
    header('Location: backend.php');
     
}  

function sqlupdatepeliculasinimagen($conexion, $idpelicula, $nombre, $sinopsis, $estreno, $genero){

    $consulta = "UPDATE peliculas SET nombre = '$nombre', sinopsis = '$sinopsis', anio = '$estreno',generos_id = '$genero' WHERE id = $idpelicula";
    
 //echo $consulta;  
    $resultado = mysqli_query($conexion, $consulta);
    mysqli_close($conexion);
    
   header('Location: backend.php');
    
}




function detalleconcomentarios($conexion, $idpelicula, $idusuario){
  
    
    $consulta = "SELECT peliculas.id, peliculas.nombre, peliculas.sinopsis, peliculas.anio, generos.genero FROM peliculas inner join generos on peliculas.generos_id = generos.id WHERE peliculas.id = $idpelicula";
    //  
    $resultado = mysqli_query($conexion, $consulta);
    
    if ($resultado)
    {
      //  echo "Cantidad de peliculas en la base de datos:" . mysqli_num_rows($resultado);
        echo "<div > ";
        while ($fila = mysqli_fetch_array ($resultado)) {
            echo "<div style='width:800px; margin:50px;'>";
            $idpeli = $fila['id'];
            echo '<div><h3>' .$fila['nombre']." - <small>".$fila['anio'].'</small></h3>';
            echo '<div><img src="mostrarimagen.php?idpelicula='.$fila['id'].'"  class="img-thumbnail" style="width:300px;"></div>';
            echo "<div>".$fila['genero']."<br>";
            echo "Puntaje: ".puntajepromedio($conexion, $idpelicula)."</div>";
            echo "Sinopsis: <br>".$fila['sinopsis'];
            echo '</div><br>';
                
                echo '<br>   ';
                
        //    echo '</li>';
            }
       // echo "</div>";
            mysqli_free_result($resultado);
        
        // si hay usuario -> formulario para ingresar nuevo comentario.
        if (isset($_SESSION['usuario'])){
            echo "<form action='sqlaltacomentario.php' method='post'>";
            echo ' <div class="form-group" style="width:600px; padding:20px">';
            echo ' <label for="aunombre" id="accomentario">Comentario</label><textarea name="comentario" id="accomentario" class="form-control"></textarea><br>';
            echo '<label for="aunombre" id="acpuntaje">Puntaje</label> <select name="puntaje" id="acpuntaje" class="form-control"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>';
            echo "<input type='hidden' name='idusuario' value=".$idusuario.">";
            echo "<input type='hidden' name='idpelicula' value=".$idpelicula.">";
            echo "<input type='submit' value='Comentar' class='btn btn-success'>";
            echo "</div></form>";
        } else {
            echo "<p>Para realizar comentarios debe iniciar sesion.</p>";
        }

        $consulta2 = "SELECT comentarios.fecha as 'fecha', comentarios.comentario as 'comentario', comentarios.calificacion as 'calificacion', usuarios.nombre, usuarios.apellido FROM comentarios inner join usuarios on comentarios.usuarios_id = usuarios.id WHERE peliculas_id = $idpelicula ORDER BY comentarios.fecha DESC";
    $resultado2 = mysqli_query($conexion, $consulta2);
        if ($resultado2){
            
            echo "<ul>";
         while ($fila2 = mysqli_fetch_array ($resultado2)) {
             echo "<li><div class='panel panel-primary'><div class='panel-heading'>".$fila2['fecha']." <strong>".$fila2['nombre']." ".$fila2['apellido']."</strong> puntuó => ".$fila2['calificacion']."</div><br><div class='panel-body'>".$fila2['comentario']."</li>";
         }
            echo "</ul>";
        } else {
            echo "</div>";

        }
             mysqli_free_result($resultado2);
            mysqli_close($conexion);
        
    }
};

function listaranios($conexion){
        $consulta = "SELECT DISTINCT anio FROM peliculas ORDER By anio";
      
    $resultado = mysqli_query($conexion, $consulta);
    
    echo '<div>Año: <ul>';
        while ($fila = mysqli_fetch_array ($resultado)) {
            echo '<a href="index.php?criterio=~'.$fila['anio'].'&orden=2"><li>'.$fila['anio'].'</li></a>';
            
}
    echo '</ul></div>'; 
}

function listargeneros($conexion){
        $consulta = "SELECT DISTINCT generos.id, genero FROM generos RIGHT JOIN peliculas ON generos.id = peliculas.generos_id";
      
    $resultado = mysqli_query($conexion, $consulta);
    
    echo '<div>Genero: <ul>';
        while ($fila = mysqli_fetch_array ($resultado)) {
            echo '<a href="index.php?criterio=-'.$fila['id'].'&orden=2"><li>'.$fila['genero'].'</li></a>';
            
}
    echo '</ul></div>';
}

function tablabackend($conexion){
       $consulta = "SELECT * FROM peliculas";
      
    $resultado = mysqli_query($conexion, $consulta);
    
    echo '<table class="table table-striped"><tr><th>ID</th><th>Nombre</th><th>Sinopsis</th><th>Año</th><th>Genero</th>';/* <th>Imagen</th> */
    echo '<th>Tipo I.</th><th>Operacion</th></tr>';
        while ($fila = mysqli_fetch_array ($resultado)) {
            echo '<tr><td>'.$fila['id'].'</td>
            <td><b>'.$fila['nombre'].'</b><br><img src="mostrarimagen.php?idpelicula='.$fila['id'].'" class="img-thumbnail" style ="width:100px; height:100px;"></td><td>'.$fila['sinopsis'].'</td><td>'.$fila['anio'].'</td><td>';
            
            $genero = $fila['generos_id'];
             $consulta2 = "SELECT genero from generos where id = $genero";  
    $resultado2 = mysqli_query($conexion, $consulta2);            
    while ($fila2 = mysqli_fetch_array ($resultado2)) {
    
    echo $fila2['genero'];
    }   

            
            echo '</td>';/*<td><img src="mostrarimagen.php?idpelicula='.$fila['id'].'" class="img-thumbnail" style ="width:100px; height:100px;"></td>*/
            echo '<td>'.$fila['tipoimagen'].'</td><td><a href="updatepelicula.php?peliculaid='.$fila['id'].'" class="btn btn-warning btn-sm btn-block">Modificar</a> <a href="bajapelicula.php?idpelicula='.$fila['id'].'" class="btn btn-danger btn-sm btn-block">Eliminar</a></td></tr>';
        }
    echo '</table>';
}



function sqlbajapelicula($conexion, $idpelicula){
      
    $consulta = "DELETE FROM comentarios WHERE peliculas_id = ".$idpelicula.";";
    
      
    if (!$conexion){
       die("Connection failed: " . mysqli_connect_error()) ;
    }

   if (mysqli_query($conexion, $consulta)){
       echo"comentarios borrados exitosamente";
   } else {
       echo"error al borrar comentarios ->". mysqli_error($conexion);
   };
    
     $consulta2 = "DELETE FROM peliculas where id = ".$idpelicula.";";
    
      

   if (mysqli_query($conexion, $consulta2)){
       echo"pelicula borrada exitosamente";
   } else {
       echo"error al borrar pelicula ->". mysqli_error($conexion);
   };
  
    
}

function updatepeli($conexion,$idpelicula){
    
if (isset($_GET['peliculaid'])){
    $idpelicula = $_GET['peliculaid'];
  
    
      $consulta = "SELECT peliculas.id, peliculas.nombre as nombre, peliculas.sinopsis as sinopsis, peliculas.anio as anio, peliculas.tipoimagen as tipoimagen, peliculas.generos_id as genero FROM peliculas inner join generos on peliculas.generos_id = generos.id  WHERE peliculas.id = $idpelicula";  
  
    $resultado = mysqli_query($conexion, $consulta);
    if ($fila = mysqli_fetch_array ($resultado)) {
    
echo '<h2>Modificar pelicula</h2>
<form enctype="multipart/form-data" action="sqlupdatepelicula.php" method="POST">
<div class="form-group" style="width:900px; padding:20px;">
   <input type="hidden" name="idpelicula" value="'.$idpelicula.'">
    <label for="upnombre">Nombre</label>
    <input type="text" class="form-control" id="upnombre" name="nombre" value="'.$fila['nombre'].' "><br>
    <label for="upsinopsis">Sinopsis</label> <textarea name="sinopsis" id="upsinopsis" class="form-control" rows="6">'.$fila['sinopsis'].'</textarea><br>
    <label for="upanio">Año</label><input type="number" name="estreno" class="form-control" id="upanio" value="'.$fila['anio'].'"><br>
    <label for="upgenero">Género</label> <select name="genero" id="upgenero" class="form-control">';
    $consulta2 = "SELECT id, genero from generos";  
    $resultado = mysqli_query($conexion, $consulta2);            
    while ($fila2 = mysqli_fetch_array ($resultado)) {
    
    echo '<option value="'.$fila2['id'].'"';        
    if ($fila['genero'] == $fila2['id']) { echo ' selected ';};         
    echo'>'.$fila2['genero'].'</option>';
    }
        
    echo '</select><br>
     <label for="upimagen" ">Imagen</label> <img class="img-thumbnail"   src="mostrarimagen.php?idpelicula='.$fila['id'].'" id="upimagen"><input class="form-control" type="file" name="imagen"><br>
   <input type="hidden" name="tipoimagen" value="'.$fila['tipoimagen'].'">
    
       <input type="submit" class="btn btn-success" value="Actualizar">
       <a href="backend.php" class="btn btn-primary">Cancelar</a>
       </div>


</form>
';
    }
}
}

function selectaltapeli($conexion){
     echo '<label for="apgenero">Género</label> <select name="genero" id="apgenero" class="form-control" >';
    $consulta2 = "SELECT id, genero from generos";  
    $resultado = mysqli_query($conexion, $consulta2);            
    while ($fila2 = mysqli_fetch_array ($resultado)) {
    
    echo '<option value="'.$fila2['id'].'"';        
      
    echo'>'.$fila2['genero'].'</option>';
    }
        
    echo '</select><br>';
}

function existeusuario($conexion, $usuario){

     $consulta = "SELECT * from usuarios where nombreusuario=$usuario";  
    $resultado = mysqli_query($conexion, $consulta);            
  
$filas =  mysqli_fetch_array($resultado);

$cantidad= count($filas);

if (!$cantidad=0)
{      
      
        return false;
    }else {
        return true;
    }
}

?>
