<?php


session_start();
$_SESSION = array();
session_destroy();

echo"Ud. ha cerrado la sesion.<br>Sera redirigido al Index en un momento.";

sleep(3);

header('Location: ../index.php')

?>