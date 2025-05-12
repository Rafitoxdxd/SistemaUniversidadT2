<?php
require_once BASE_PATH . 'Model/pacientes.php';
require_once BASE_PATH . 'View/pacientes.php';

function listarpaciente(){
    $paciente = new pacienteModulo();
    return $paciente->listarpaciente();
}
function obtenerpaciente($id){
    $paciente = new pacienteModulo();
    return $paciente->obtenerpaciente($id);
}
function crearpaciente($nombre,$apellido, $cedula, $telefono, $fecha_nacimiento, $genero,$direccion, $ciudad,$pais, $email, $password){
    $paciente = new pacienteModulo();
    $paciente->setNombre($nombre);
    $paciente->setapellido($apellido);
    $paciente->setcedula($cedula);
    $paciente->settelefono($telefono);
    $paciente->setfecha_nacimiento($fecha_nacimiento);
    $paciente->setgenero($genero);
    $paciente->setdireccion($direccion);
    $paciente->setciudad($ciudad);
    $paciente->setpais($pais);
    $paciente->setemail($email);
    $paciente->setpassword($password);
    $paciente->crearpaciente();

}
function actualizarpaciente($id, $nombre, $apellido, $cedula, $telefono, $fecha_nacimiento, $genero, $direccion, $ciudad, $pais, $email, $password){ // Asegúrate que los nombres de parámetros coincidan
    $paciente = new pacienteModulo();
    $paciente->setId($id);
    $paciente->setNombre($nombre);// Nombre de método correcto (según tu modelo)
    $paciente->setapellido($apellido); // Nombre de método correcto (según tu modelo)
    $paciente->setcedula($cedula); // Nombre de método correcto (según tu modelo)
    $paciente->settelefono($telefono);
    $paciente->setfecha_nacimiento($fecha_nacimiento);
    $paciente->setgenero($genero);
    $paciente->setdireccion($direccion);
    $paciente->setciudad($ciudad);
    $paciente->setpais($pais);
    $paciente->setemail($email);
    $paciente->setpassword($password);
    $paciente->actualizarpaciente(); // Llama al método correcto del modelo (parece que es 'actualizarpaciente' con P mayúscula)
}
function eliminarpaciente($id){
    $paciente = new pacienteModulo();
    $paciente->eliminarpaciente($id);
}
?>