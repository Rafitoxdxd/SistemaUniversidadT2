<?php

//verifica si hay una sesión activa
//si es el caso, no tiene sentido meterse en el login
//por lo que redirige a la página principal
if (isset($_SESSION["usuario"]))
{ $pagina = "main"; }

//importa la vista de la página
if (is_file("View/".$pagina.".php"))
{ require_once("View/".$pagina.".php"); }
else
{ echo "page not found"; }

//importa los modelos necesarios para el login
require_once("Model/userManagement.php");
require_once("Model/connection.php");

//instancia un objeto usuario
$usuario = new Usuario();

//si se pulsó el submit del formulario de login
if (isset($_POST["login"]))
{
    //carga un usuario de la BD y se guarda en la instancia antes creada
    $usuario = Usuario::cargarUsuario("users", $_POST["cedula"], $_POST["contra"]);
    
    //si el usuario cargó con exito, crea una sesión
    //de lo contrario, no hace nada
    if ($usuario != null)
    {
        //verifica el estado de la sesión
        if (session_status() == PHP_SESSION_NONE)
        { session_start(); } //inicia sesión

        //guarda la instancia usuario en la variable Superglobal $_SESSION["usuario"]
        $_SESSION["usuario"] = $usuario;

        //redirige a la página principal
        header("Location: ?pagina=main");
        exit;
    }
    else
    {
        echo "Usuario no encontrado";
    }
}

?>