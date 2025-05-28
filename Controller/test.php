 <?php
ob_start(); // Iniciar buffer de salida al principio del script. Esencial para header().

// Asegurar que la sesión esté iniciada si se va a usar.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . 'Model/test.php';
// NO incluir la Vista aquí al principio.

// MANEJO DE ACCIÓN AJAX PARA LISTAR test 
if (isset($_GET['accion']) && $_GET['accion'] === 'listartestAjax') {
    header('Content-Type: application/json'); // Indicar que la respuesta es JSON.
    $filtro = strtolower($_GET['filtro'] ?? '');
    
    $todosLostest = listartest(); // Llama a la función definida más abajo.
    $testFiltrados = $todosLostest;

    if (!empty($filtro)) {
        $testFiltrados = array_filter($todosLostest, function ($test) use ($filtro) {
            return (stripos($test['nombre'], $filtro) !== false) ||
                (stripos($test['apellidos'], $filtro) !== false) ||
                (isset($test['cedula']) && stripos($test['cedula'], $filtro) !== false) ||
                (isset($test['edad']) && stripos($test['edad'], $filtro) !== false);
        });
    }
    // El JavaScript espera un objeto con una clave 'test'.
    echo json_encode(['test' => array_values($testFiltrados)]); // array_values para reindexar.
    exit; // MUY IMPORTANTE: Terminar la ejecución para no enviar más nada.
}

// MANEJO DE ACCIÓN DE CREAR test (cuando se envía el formulario de registro)
if (isset($_POST['guardara'])) { // 'guardara' es el name del botón submit del formulario de registro.
    // 1. Recolectar datos del $_POST
    $nombre = $_POST['nombre'] ?? null;
    $apellidos = $_POST['apellidos'] ?? null;
    $cedula = $_POST['cedula'] ?? null;
    $edad = $_POST['edad'] ?? null;
    $nombre_competencia = $_POST['nombre_competencia'] ?? null;
    $ubicacion_competencia = $_POST['ubicacion_competencia'] ?? null;
    $fecha_competencia = $_POST['fecha_competencia'] ?? null;
    $preparado_competencia = $_POST['preparado_competencia'] ?? null;
    $entrenado_previo = $_POST['entrenado_previo'] ?? null;
    $estrategia_previa = $_POST['estrategia_previa'] ?? null;
    $descripcion_nervios = $_POST['descripcion_nervios'] ?? null;
    $antes_competir = $_POST['antes_competir'] ?? null;
    $experiencia_pasada = $_POST['experiencia_pasada'] ?? null;
    $motivacion_competencia = $_POST['motivacion_competencia'] ?? null;
    $esperar_competicion = $_POST['esperar_competicion'] ?? null;
    $lograr_competencia = $_POST['lograr_competencia'] ?? null;
    $rutina_mental = $_POST['rutina_mental'] ?? null;
    $pensamiento_positivo = $_POST['pensamiento_positivo'] ?? null;
    $preparacion_mental = $_POST['preparacion_mental'] ?? null;
  

    // 2. Validar datos (aquí puedes añadir más validaciones)
    if (empty($nombre) || empty($apellidos) || empty($edad) || empty($cedula)) {
        // Manejar error, por ejemplo, redirigir con un mensaje.
        header('Location: ?pagina=test&status=error_creacion_faltan_datos');
        exit;
    }

    // 3. Hashear contraseña (¡Seguridad!)
  //  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 4. Llamar a la función del controlador que interactúa con el modelo.
    creartest($nombre, $apellido, $cedula, $telefono, $fecha_nacimiento, $genero, $direccion, $ciudad, $pais, $email, $hashedPassword);

    // 5. Redireccionar para evitar reenvío de formulario (Patrón Post/Redirect/Get).
    header('Location: ?pagina=test&status=creado_exitosamente');
    exit; // MUY IMPORTANTE: Terminar la ejecución.
}

// --- MANEJO DE ACCIÓN DE ACTUALIZAR test (cuando se envía el formulario de modificación) ---
if (isset($_POST['actualizar_test_submit'])) { // 'actualizar_test_submit' es el name del botón.
    $id = $_POST['id'] ?? null;
    // Recolectar todos los demás campos del formulario de modificación...
    // (nombre, apellido, cedula, telefono, fecha_nacimiento, genero, direccion, ciudad, pais)
    // NOTA: El formulario de modificación no pide email ni contraseña.

    if ($id) {
        // Llama a tu función existente. Asegúrate de pasar todos los parámetros que espera.
        actualizartest(
            $id, 
            $_POST['nombre'] ?? null, 
            $_POST['apellido'] ?? null, 
            $_POST['cedula'] ?? null, 
            $_POST['edad'] ?? null, 
            $_POST['nombre_competencia'] ?? null, 
            $_POST['ubicacion_competencia'] ?? null, 
            $_POST['fecha_competencia'] ?? null, 
            $_POST['preparado_competencia'] ?? null, 
            $_POST['entrenado_previo'] ?? null, 
            $_POST['estrategia_previa'] ?? null, 
            $_POST['descripcion_nervios'] ?? null, 
            $_POST['antes_competir'] ?? null, 
            $_POST['experiencia_pasada'] ?? null, 
            $_POST['motivacion_competencia'] ?? null, 
            $_POST['esperar_competicion'] ?? null, 
            $_POST['lograr_competencia'] ?? null, 
            $_POST['rutina_mental'] ?? null, 
            $_POST['pensamiento_positivo'] ?? null, 
            $_POST['preparacion_mental'] ?? null,                 
            null  // password no se modifica desde este form (si se quisiera, hashear)
        );
        header('Location: ?pagina=test&status=actualizado_exitosamente');
        exit;
    } else {
        header('Location: ?pagina=test&status=error_actualizacion_sin_id');
        exit;
    }
}

//  Manejo de accion para eliminar 
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminartest' && isset($_GET['id'])) {
    $id_a_eliminar = $_GET['id'];
    if (!empty($id_a_eliminar)) {
        eliminartest($id_a_eliminar); // Llama a tu función existente.
        header('Location: ?pagina=test&status=eliminado_exitosamente');
        exit;
    }
}

// funciones de controlador
// Estas funciones son llamadas por los bloques de arriba o por tu index.php/vista para mostrar datos.

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
   return $test->creartest(); 
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


    if ($cedula !== null) { // Solo setea si se proporciona
        $test->setcedula($cedula);
    }
    return $test->actualizartest(); 
}
function eliminartest($id){
    $test = new testModulo();
    return $test->eliminartest($id);
}

// Prepara los datos para la vista
// Esto solo se ejecutará si no es una petición AJAX o un POST/GET que ya hizo `exit;`.
$test = listartest(); // Llama a la función para obtener los test.

// Incluir en la vista 
require_once BASE_PATH . 'View/test.php'; // La vista ahora tiene acceso a $test.

ob_end_flush(); // Enviar el buffer de salida.
?>