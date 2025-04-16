<?php
//obtiene primero la clase modelo
//luego verificamos el estatus de la sesion
//esto de acá es para evitar bugs
require_once("Model/userManagement.php");
if (session_status() == PHP_SESSION_NONE)
{ session_start(); }
//--------------------------------------------

//verifica si hay una sesión activa
//si es el caso te dirige al perfil
//si no, te dirige a la página principal
if (!isset($_SESSION["usuario"]))
{ $pagina = "main"; }

//importa la vista de la página
if (is_file("View/".$pagina.".php"))
{ require_once("View/".$pagina.".php"); }
else
{ echo "page not found"; }

?>