<?php
ob_start();

require_once("Model/historial.php");
require_once("Model/userManagement.php");

//Verificar si la sesión está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//importa la vista de la página
if (is_file("View/".$pagina.".php")) {
    require_once("View/".$pagina.".php");
} else {
    echo "Error: View file not found."; // Mensaje de error
    exit; // Detener la ejecución si la vista no existe
}

$historial = new Historial();

// Ahora, procesa el formulario SI FUE ENVIADO
if(isset($_POST["guardar"])) {

    unset($_POST["guardar"]);
    $usuario = $_SESSION["usuario"];
    
    $datosJson = json_encode($_POST);

    //crea un array para almacenar los datos del usuario
    $datosHistorial = array();

    //guarda todos los datos del formulario en el array
    $datosHistorial["ID"] = null;
    $datosHistorial["datos"] = $datosJson;
    $datosHistorial["idPaciente"] = null;
    $datosHistorial["idPsicologo"] = $usuario->getId();

    //establece los datos del historial en la instancia historial
    $historial->setDatosHistorial(...$datosHistorial);

    //registra el historial en la BD
    Historial::registrarHistorial($historial);

    //recarga la pagina para que se actualice
    header('Location: '. $_SERVER['REQUEST_URI']);
    exit;
}

if(isset($_POST["eliminar"])) {

    unset($_POST["eliminar"]);

    //registra el historial en la BD
    Historial::eliminarHistorial($_POST["idPacienteEliminar"]);

    //recarga la pagina para que se actualice
    header('Location: '. $_SERVER['REQUEST_URI']);
    exit;
}

ob_end_flush();
?>
