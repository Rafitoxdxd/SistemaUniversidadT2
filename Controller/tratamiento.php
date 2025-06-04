<?php
require_once BASE_PATH . 'Model/tratamiento.php';
require_once BASE_PATH . 'View/tratamiento.php';

function listartratamientos() {
    $tratamiento = new tratamientoModulo();
    return $tratamiento->listartratamientos();
}
function obtenertratamiento($id) {
    $tratamiento = new tratamientoModulo();
    return $tratamiento->obtenertratamiento($id);
}
function creartratamiento($id_paciente, $fecha_creacion, $diagnostico_descripcion, $tratamiento_tipo, $estado_actual, $observaciones) {
    $tratamiento = new tratamientoModulo();
    $tratamiento->setid_paciente($id_paciente);
    $tratamiento->setfecha_creacion($fecha_creacion);
    $tratamiento->setdiagnostico_descripcion($diagnostico_descripcion);
    $tratamiento->settratamiento_tipo($tratamiento_tipo);
    $tratamiento->setestado_actual($estado_actual);
    $tratamiento->setobservaciones($observaciones);
    $tratamiento->creartratamiento();
}
function actualizartratamiento($id, $id_paciente, $fecha_creacion, $diagnostico_descripcion, $tratamiento_tipo, $estado_actual, $observaciones) {
    $tratamiento = new tratamientoModulo();
    $tratamiento->setId($id);
    $tratamiento->setid_paciente($id_paciente);
    $tratamiento->setfecha_creacion($fecha_creacion);
    $tratamiento->setdiagnostico_descripcion($diagnostico_descripcion);
    $tratamiento->settratamiento_tipo($tratamiento_tipo);
    $tratamiento->setestado_actual($estado_actual);
    $tratamiento->setobservaciones($observaciones);
    $tratamiento->actualizartratamiento();
}
function eliminartratamiento($id) {
    $tratamiento = new tratamientoModulo();
    $tratamiento->eliminartratamiento($id);
}
// Para la vista: obtener todos los pacientes
function obtenerPacientesParaSelect() {
    $paciente = new pacienteModulo();
    return $paciente->listarpaciente();
}

if (isset($_POST['guardar_tratamiento'])) {
    creartratamiento(
        $_POST['id_paciente'],
        $_POST['fecha_creacion'],
        $_POST['diagnostico_descripcion'],
        $_POST['tratamiento_tipo'],
        $_POST['estado_actual'],
        $_POST['observaciones'] ?? ''
    );
    // Redirigir o mostrar mensaje de éxito
}
?>