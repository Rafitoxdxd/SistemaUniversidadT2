<?php
require_once BASE_PATH . 'Model/cita.php';
require_once BASE_PATH . 'View/cita.php';

function listarcita(){
    $cita = new citaModulo();
    return $cita->listarcita();
}
function obtenercita($id){
    $cita = new citaModulo();
    return $cita->obtenercita($id);
}
function crearcita($id_paciente, $title, $descripcion, $color, $textColor, $start, $end){
    $cita = new citaModulo();
    $cita->setid_paciente($id_paciente); // Faltaba esta línea
    $cita->settitle($title);
    $cita->setdescripcion($descripcion);
    $cita->setcolor($color);
    $cita->settextColor($textColor);
    $cita->setstart($start);
    $cita->setend($end);
    $cita->crearcita();

}
function actualizarcita($id, $title, $descripcion, $color, $textColor, $start, $end){ // Asegúrate que los nombres de parámetros coincidan
    $cita = new citaModulo();
    $cita->setId($id);
    $cita->settitle($title);// Nombre de método correcto (según tu modelo)
    $cita->setdescripcion($descripcion);// Nombre de método correcto (según tu modelo)
    $cita->setcolor($color);// Nombre de método correcto (según tu modelo)
    $cita->settextColor($textColor);// Nombre de método correcto (según tu modelo)
    $cita->setstart($start);// Nombre de método correcto (según tu modelo)    
    $cita->setend($end);// Nombre de método correcto (según tu modelo)
    $cita->actualizarcita(); // Llama al método correcto del modelo (parece que es 'actualizarcita' con P mayúscula)
}
function eliminarcita($id){
    $cita = new citaModulo();
    $cita->eliminarcita($id);
}
// Para la vista: obtener todos los pacientes
function obtenerPacientesParaSelect(){
    $paciente = new pacienteModulo();
    return $paciente->listarpaciente();
}

if (isset($_POST['guardar_cita'])) {
    crearcita(
        $_POST['id_paciente'],
        $_POST['title'],
        $_POST['descripcion'],
        $_POST['color'],
        $_POST['textColor'],
        $_POST['start'],
        $_POST['end']
    );
    // Redirigir o mostrar mensaje de éxito
}
?>