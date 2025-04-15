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

//importa el modelo de la página
if (is_file("Model/".$pagina.".php"))
{ require_once("Model/".$pagina.".php"); }

//importa los modelos necesarios para el register
require_once("Model/userManagement.php");

//instancia un objeto usuario
$usuario = new Usuario();

if (isset($_POST["register"]))
{
    //crea un array para almacenar los datos del usuario
    $datosUsuario = array();

    //guarda todos los datos del formulario en el array
    $datosUsuario["cedula"]      = $_POST["cedula"];
    $datosUsuario["nombre"]      = $_POST["nombre"];
    $datosUsuario["apellido"]    = $_POST["apellido"];
    $datosUsuario["correo"]      = $_POST["correo"];
    //$datosUsuario["contra"]      = $_POST["contra"]; //pa solucionar
    $datosUsuario["FNacimiento"] = $_POST["FNacimiento"];
    $datosUsuario["genero"]      = $_POST["genero"];

    $datosUsuario["id"]          = null; //para solucionar

    //establece los datos del usuario en la instancia usuario
    $usuario->setDatosUsuario(...$datosUsuario);

    //registra el usuario en la BD
    Usuario::registrarUsuario($usuario, "users", $_POST["contra"]);
}

?>