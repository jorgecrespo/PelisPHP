<?php
include_once("funciones.php");
echo '
<div style="position: fixed;overflow: auto; width: 25%;height: 100%;list-style-type: none;
    margin: 0;
    padding: 0;
    width: 25%;">
    
<div>
<form action="index.php" method="get">
Buscar <input type="text" name="criterio"><input type="submit" value="Buscar"></div>
</form>';    
listaranios($conexion);
listargeneros($conexion);
  echo '<a href="index.php?criterio=""&orden=2">Todas</a><div>
   
    </div>';
    
echo'</div>';
?>
