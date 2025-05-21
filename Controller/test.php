<?php
// Controller/test_functions.php (Anteriormente Controller/test.php)

// Es importante que el modelo se incluya AQUÍ para que las funciones lo puedan usar.
require_once BASE_PATH . 'Model/test.php';
require_once BASE_PATH . 'Controller/test.php';
include BASE_PATH . 'View/test.php'; // ¡Asegúrate que esta ruta y nombre sean correctos!

// Las funciones del controlador
function listartest(){
    $test = new testModulo();
    return $test->listartest();
}

function obtenertest($id){
    $test = new testModulo();
    return $test->obtenertest($id);
}

function creartest($nombre, $apellidos, $cedula, $edad, $nombre_competencia, $ubicacion_competencia, $fecha_competencia, $preparado_competencia, $entrenado_previo, $estrategia_previa, $descripcion_nervios, $antes_competir, $experiencia_pasada, $motivacion_competencia, $esperar_competicion, $lograr_competencia, $rutina_mental, $pensamiento_positivo, $preparacion_mental){
    $test = new testModulo();
    $test->setnombre($nombre);
    $test->setapellidos($apellidos);
    $test->setcedula($cedula);
    $test->setedad($edad);
    $test->setnombre_competencia($nombre_competencia);
    $test->setubicacion_competencia($ubicacion_competencia);
    $test->setfecha_competencia($fecha_competencia);
    $test->setpreparado_competencia($preparado_competencia);
    $test->setentrenado_previo($entrenado_previo);
    $test->setestrategia_previa($estrategia_previa);
    $test->setdescripcion_nervios($descripcion_nervios);
    $test->setantes_competir($antes_competir);
    $test->setexperiencia_pasada($experiencia_pasada);
    $test->setmotivacion_competencia($motivacion_competencia);
    $test->setesperar_competicion($esperar_competicion);
    $test->setlograr_competencia($lograr_competencia);
    $test->setrutina_mental($rutina_mental);
    $test->setpensamiento_positivo($pensamiento_positivo);
    $test->setpreparacion_mental($preparacion_mental);
    $test->creartest(); // Aquí se llama al método del modelo
}

function actualizartest($id, $nombre, $apellidos, $cedula, $edad, $nombre_competencia, $ubicacion_competencia, $fecha_competencia, $preparado_competencia, $entrenado_previo, $estrategia_previa, $descripcion_nervios, $antes_competir, $experiencia_pasada, $motivacion_competencia, $esperar_competicion, $lograr_competencia, $rutina_mental, $pensamiento_positivo, $preparacion_mental){
    $test = new testModulo();
    $test->setId($id); // Correcto
    $test->setnombre($nombre);
    $test->setapellidos($apellidos);
    $test->setcedula($cedula);
    $test->setedad($edad);
    $test->setnombre_competencia($nombre_competencia);
    $test->setubicacion_competencia($ubicacion_competencia);
    $test->setfecha_competencia($fecha_competencia);
    $test->setpreparado_competencia($preparado_competencia);
    $test->setentrenado_previo($entrenado_previo);
    $test->setestrategia_previa($estrategia_previa);
    $test->setdescripcion_nervios($descripcion_nervios);
    $test->setantes_competir($antes_competir);
    $test->setexperiencia_pasada($experiencia_pasada);
    $test->setmotivacion_competencia($motivacion_competencia);
    $test->setesperar_competicion($esperar_competicion);
    $test->setlograr_competencia($lograr_competencia);
    $test->setrutina_mental($rutina_mental);
    $test->setpensamiento_positivo($pensamiento_positivo);
    $test->setpreparacion_mental($preparacion_mental);
    $test->actualizartest();
}

function eliminartest($id){
    $test = new testModulo();
    $test->eliminartest($id);
}
?>