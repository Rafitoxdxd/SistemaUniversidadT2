<?php
ob_start(); // Iniciar buffer de salida al principio del script. Esencial para header().

// Asegurar que la sesión esté iniciada si se va a usar.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . 'Model/pacientes.php';

// --- BLOQUE AJAX PARA RESPONDER JSON ---
if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    header('Content-Type: application/json');
    $filtro = strtolower($_GET['filtro'] ?? '');
    $todosLosPacientes = listarpaciente();
    $pacientesFiltrados = $todosLosPacientes;

    if (!empty($filtro)) {
        $pacientesFiltrados = array_filter($todosLosPacientes, function ($paciente) use ($filtro) {
            return (stripos($paciente['nombre'], $filtro) !== false) ||
                (stripos($paciente['apellido'], $filtro) !== false) ||
                (isset($paciente['cedula']) && stripos($paciente['cedula'], $filtro) !== false) ||
                (isset($paciente['telefono']) && stripos($paciente['telefono'], $filtro) !== false);
        });
    }
    echo json_encode(['pacientes' => array_values($pacientesFiltrados)]);
    exit;
}
// --- FIN BLOQUE AJAX ---

// MANEJO DE ACCIÓN AJAX PARA LISTAR PACIENTES 
if (isset($_GET['accion']) && $_GET['accion'] === 'listarPacientesAjax') {
    header('Content-Type: application/json'); // Indicar que la respuesta es JSON.
    $filtro = strtolower($_GET['filtro'] ?? '');
    
    $todosLosPacientes = listarpaciente(); // Llama a la función definida más abajo.
    $pacientesFiltrados = $todosLosPacientes;

    if (!empty($filtro)) {
        $pacientesFiltrados = array_filter($todosLosPacientes, function ($paciente) use ($filtro) {
            return (stripos($paciente['nombre'], $filtro) !== false) ||
                (stripos($paciente['apellido'], $filtro) !== false) ||
                (isset($paciente['cedula']) && stripos($paciente['cedula'], $filtro) !== false) ||
                (isset($paciente['telefono']) && stripos($paciente['telefono'], $filtro) !== false);
        });
    }
    // El JavaScript espera un objeto con una clave 'pacientes'.
    echo json_encode(['pacientes' => array_values($pacientesFiltrados)]); // array_values para reindexar.
    exit; // MUY IMPORTANTE: Terminar la ejecución para no enviar más nada.
}

// MANEJO DE ACCIÓN DE CREAR PACIENTE (cuando se envía el formulario de registro)
if (isset($_POST['guardara'])) { // 'guardara' es el name del botón submit del formulario de registro.
    // 1. Recolectar datos del $_POST
    $nombre = $_POST['nombre'] ?? null;
    $apellido = $_POST['apellido'] ?? null;
    $cedula = $_POST['cedula'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
    $genero = $_POST['genero'] ?? null;
    $direccion = $_POST['direccion'] ?? null;
    $ciudad = $_POST['ciudad'] ?? null;
    $pais = $_POST['pais'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    // 2. Validar datos (aquí puedes añadir más validaciones)
    if (empty($nombre) || empty($apellido) || empty($email) || empty($password) || empty($cedula)) {
        // Manejar error, por ejemplo, redirigir con un mensaje.
        header('Location: ?pagina=pacientes&status=error_creacion_faltan_datos');
        exit;
    }

    // 3. Hashear contraseña (¡Seguridad!)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 4. Llamar a la función del controlador que interactúa con el modelo.
    crearpaciente($nombre, $apellido, $cedula, $telefono, $fecha_nacimiento, $genero, $direccion, $ciudad, $pais, $email, $hashedPassword);

    // 5. Redireccionar para evitar reenvío de formulario (Patrón Post/Redirect/Get).
    header('Location: ?pagina=pacientes&status=creado_exitosamente');
    exit; // MUY IMPORTANTE: Terminar la ejecución.
}

// --- MANEJO DE ACCIÓN DE ACTUALIZAR PACIENTE (cuando se envía el formulario de modificación) ---
if (isset($_POST['actualizar_paciente_submit'])) { // 'actualizar_paciente_submit' es el name del botón.
    $id = $_POST['id'] ?? null;
    // Recolectar todos los demás campos del formulario de modificación...
    // (nombre, apellido, cedula, telefono, fecha_nacimiento, genero, direccion, ciudad, pais)
    // NOTA: El formulario de modificación no pide email ni contraseña.

    if ($id) {
        // Llama a tu función existente. Asegúrate de pasar todos los parámetros que espera.
        actualizarpaciente(
            $id, 
            $_POST['nombre'] ?? null, 
            $_POST['apellido'] ?? null, 
            $_POST['cedula'] ?? null, 
            $_POST['telefono'] ?? null, 
            $_POST['fecha_nacimiento'] ?? null, 
            $_POST['genero'] ?? null, 
            $_POST['direccion'] ?? null, 
            $_POST['ciudad'] ?? null, 
            $_POST['pais'] ?? null, 
            $_POST['email'] ?? null,             
            null  // password no se modifica desde este form (si se quisiera, hashear)
        );
        header('Location: ?pagina=pacientes&status=actualizado_exitosamente');
        exit;
    } else {
        header('Location: ?pagina=pacientes&status=error_actualizacion_sin_id');
        exit;
    }
}

//  Manejo de accion para eliminar 
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminarPaciente' && isset($_GET['id'])) {
    $id_a_eliminar = $_GET['id'];
    if (!empty($id_a_eliminar)) {
        eliminarpaciente($id_a_eliminar); // Llama a tu función existente.
        header('Location: ?pagina=pacientes&status=eliminado_exitosamente');
        exit;
    }
}

// funciones de controlador
// Estas funciones son llamadas por los bloques de arriba o por tu index.php/vista para mostrar datos.

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
    return $paciente->crearpaciente(); 
}
function actualizarpaciente($id, $nombre, $apellido, $cedula, $telefono, $fecha_nacimiento, $genero, $direccion, $ciudad, $pais, $email, $password){ // Asegúrate que los nombres de parámetros coincidan
    $paciente = new pacienteModulo();
    $paciente->setId($id);
    $paciente->setNombre($nombre);
    $paciente->setapellido($apellido);
    $paciente->setcedula($cedula);
    $paciente->settelefono($telefono); 
    $paciente->setfecha_nacimiento($fecha_nacimiento);
    $paciente->setgenero($genero);
    $paciente->setdireccion($direccion);
    $paciente->setciudad($ciudad);
    $paciente->setpais($pais);

    if ($email !== null) { // Solo setea si se proporciona
        $paciente->setemail($email);
    }
    if ($password !== null) { // Solo setea si se proporciona (y debería estar hasheada)
        $paciente->setpassword($password);
    }
    return $paciente->actualizarpaciente(); 
}
function eliminarpaciente($id){
    $paciente = new pacienteModulo();
    return $paciente->eliminarpaciente($id);
}

// Prepara los datos para la vista
// Esto solo se ejecutará si no es una petición AJAX o un POST/GET que ya hizo `exit;`.
$pacientes = listarpaciente(); // Llama a la función para obtener los pacientes.

// Incluir en la vista 
require_once BASE_PATH . 'View/pacientes.php'; // La vista ahora tiene acceso a $pacientes.

ob_end_flush(); // Enviar el buffer de salida.
?>