<?php

require_once("Config/config.php");
//inicia una sesión
//session_start();
$pagina = "main"; //pagina principal

//código de prueba NO PRESTAR ATENCION---------------------
//session_start();
//$_SESSION["username"] = "test";
//session_destroy();
//---------------------------------------------------------

//si el GET tiene un valor, cambia de página
if (!empty($_GET['pagina']))
{ $pagina = $_GET['pagina']; }

//importa el controlador de la página
if (is_file("Controller/".$pagina.".php"))
{ require_once("Controller/".$pagina.".php"); }
else
{ echo "page not found"; }

?>