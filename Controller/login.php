<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Si ya hay sesión activa, redirige a main
if (isset($_SESSION["usuario"])) {
    header("Location: ?pagina=main");
    exit;
}

// Importa los modelos necesarios para el login
require_once("Model/userManagement.php");
require_once("Model/connection.php");

// Si se pulsó el submit del formulario de login
if (isset($_POST["login"])) {
    // Carga un usuario de la BD y se guarda en la instancia antes creada
    $usuario = Usuario::cargarUsuario("users", $_POST["cedula"], $_POST["contra"]);
    
    // Si el usuario cargó con éxito, crea una sesión
    if ($usuario != null) {
        $_SESSION["usuario"] = $usuario;
        header("Location: ?pagina=main");
        exit;
    } else {
        $error = "Usuario no encontrado";
    }
}

// Importa la vista de la página
$pagina = "login";
if (is_file("View/".$pagina.".php")) {
    require_once("View/".$pagina.".php");
} else {
    echo "page not found";
}
?>