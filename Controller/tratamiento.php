
<?php
require_once BASE_PATH . 'Model/tratamiento.php';
require_once BASE_PATH . 'View/tratamiento.php';

function listarpaciente(){
    $paciente = new tratamientoModulo();
    return $paciente->listarpaciente();
}
function obtenerpaciente($id){
    $paciente = new tratamientoModulo();
    return $paciente->obtenerpaciente($id);
}
function crearpaciente($fecha_creacion, $diagnostico_descripcion, $tratamiento_tipo, $estado_actual){
    $paciente = new tratamientoModulo();
    $paciente->setfecha_creacion($fecha_creacion);
    $paciente->setdiagnostico_descripcion($diagnostico_descripcion);
    $paciente->settratamiento_tipo($tratamiento_tipo);
    $paciente->setestado_actual($estado_actual);

    $paciente->crearpaciente();

}
function actualizarpaciente($id, $fecha_creacion, $diagnostico_descripcion, $tratamiento_tipo,$estado_actual){ // Asegúrate que los nombres de parámetros coincidan
    $paciente = new tratamientoModulo();
    $paciente->setId($id);
    $paciente->setfecha_creacion($fecha_creacion);
    $paciente->setdiagnostico_descripcion($diagnostico_descripcion);
    $paciente->settratamiento_tipo($tratamiento_tipo);
    $paciente->setestado_actual($estado_actual);

    $paciente->actualizarpaciente(); // Llama al método correcto del modelo (parece que es 'actualizarpaciente' con P mayúscula)
}
function eliminarpaciente($id){
    $paciente = new tratamientoModulo();
    $paciente->eliminarpaciente($id);
}
?>