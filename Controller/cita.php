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
function crearcita($title, $descripcion, $color, $textColor, $start, $end){
    $cita = new citaModulo();
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
?>