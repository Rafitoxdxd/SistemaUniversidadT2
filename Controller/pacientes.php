<?php
// Inicia el búfer de salida. Esto es útil porque te permite enviar encabezados HTTP (como redirecciones con header())
// en cualquier punto del script, incluso después de que ya se haya enviado algo de HTML o texto.
// Sin esto, si intentas usar header() después de cualquier salida, PHP te dará un error de "headers already sent".
ob_start(); 

// Comprueba si ya existe una sesión activa. PHP_SESSION_NONE significa que las sesiones están habilitadas, pero ninguna existe.
// Si no hay una sesión iniciada, la inicia. Esto es necesario si vas a usar variables de sesión (como $_SESSION['usuario']).
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluye el archivo del modelo 'pacientes.php'.
require_once BASE_PATH . 'Model/pacientes.php';

// --- BLOQUE AJAX PARA RESPONDER JSON ---
// Este bloque se ejecuta si la URL contiene '?ajax=1'.
// Se usa para peticiones donde el cliente (JavaScript en el navegador) espera una respuesta en formato JSON.
if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    // Establece el tipo de contenido de la respuesta a 'application/json'.
    // Esto le dice al navegador que los datos que vienen son JSON y deben ser interpretados como tal.
    header('Content-Type: application/json');

    // Obtiene el valor del parámetro 'filtro' de la URL (si existe), lo convierte a minúsculas.
    // El operador '??' (coalescencia nula) asigna un string vacío si 'filtro' no está definido.
    $filtro = strtolower($_GET['filtro'] ?? '');

    // Llama a la función listarpaciente() (definida más abajo) para obtener todos los pacientes de la base de datos.
    $todosLosPacientes = listarpaciente();
    $pacientesFiltrados = $todosLosPacientes; // Inicialmente, los pacientes filtrados son todos los pacientes.

    // Si se proporcionó un filtro (no está vacío)...
    if (!empty($filtro)) {
        // array_filter recorre cada elemento de $todosLosPacientes y aplica una función (callback).
        // Si la función devuelve true, el elemento se mantiene en $pacientesFiltrados.
        $pacientesFiltrados = array_filter($todosLosPacientes, function ($paciente) use ($filtro) {
            // stripos busca la primera ocurrencia de $filtro dentro de una cadena, sin distinguir mayúsculas/minúsculas.
            // Devuelve la posición si lo encuentra, o false si no.
            // Se comprueba si el filtro coincide con el nombre, apellido, cédula o teléfono del paciente.
            return (stripos($paciente['nombre'], $filtro) !== false) ||
                (stripos($paciente['apellido'], $filtro) !== false) ||
                (isset($paciente['cedula']) && stripos($paciente['cedula'], $filtro) !== false) || // isset para evitar errores si la cédula no existe
                (isset($paciente['telefono']) && stripos($paciente['telefono'], $filtro) !== false); // isset para evitar errores si el teléfono no existe
        });
    }
    // Convierte el array $pacientesFiltrados a formato JSON y lo envía como respuesta.
    // array_values() reindexa el array para que las claves sean numéricas consecutivas (0, 1, 2...), lo cual es común para listas en JSON.
    // Se envuelve en un objeto con la clave 'pacientes' porque el JavaScript del lado del cliente probablemente espera esta estructura.
    echo json_encode(['pacientes' => array_values($pacientesFiltrados)]);
    // Termina la ejecución del script. Es crucial para las respuestas AJAX para evitar que se envíe más contenido (como el HTML de la vista).
    exit;
}
// --- FIN BLOQUE AJAX ---

// MANEJO DE ACCIÓN AJAX PARA LISTAR PACIENTES 
// Este es otro bloque para manejar una petición AJAX específica, activada por '?accion=listarPacientesAjax'.
// Es similar al bloque anterior pero más específico en su activación.
if (isset($_GET['accion']) && $_GET['accion'] === 'listarPacientesAjax') {
    header('Content-Type: application/json'); // Indica que la respuesta es JSON.
    $filtro = strtolower($_GET['filtro'] ?? ''); // Obtiene el filtro, si existe.
    
    $todosLosPacientes = listarpaciente(); // Obtiene todos los pacientes.
    $pacientesFiltrados = $todosLosPacientes; // Inicializa la lista filtrada.

    // Si hay un filtro, aplica la lógica de filtrado.
    if (!empty($filtro)) {
        $pacientesFiltrados = array_filter($todosLosPacientes, function ($paciente) use ($filtro) {
            return (stripos($paciente['nombre'], $filtro) !== false) ||
                (stripos($paciente['apellido'], $filtro) !== false) ||
                (isset($paciente['cedula']) && stripos($paciente['cedula'], $filtro) !== false) ||
                (isset($paciente['telefono']) && stripos($paciente['telefono'], $filtro) !== false);
        });
    }
    // Envía la respuesta JSON. El JavaScript del cliente espera un objeto con una clave 'pacientes'.
    echo json_encode(['pacientes' => array_values($pacientesFiltrados)]); // array_values para reindexar.
    exit; // MUY IMPORTANTE: Terminar la ejecución para no enviar más nada.
}

// MANEJO DE ACCIÓN DE CREAR PACIENTE (cuando se envía el formulario de registro)
// Este bloque se ejecuta si se ha enviado un formulario por POST y existe un campo con name="guardara".
// 'guardara' es el nombre del botón de submit en el formulario de registro de pacientes.
if (isset($_POST['guardara'])) { 
    // 1. Recolectar datos del array $_POST.
    // Se usa el operador de coalescencia nula (??) para asignar null si el campo no está presente en $_POST,
    // lo que ayuda a prevenir errores de "undefined index".
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

    // 2. Validar datos. Aquí se hace una validación básica: que los campos obligatorios no estén vacíos.
    // Se podrían (y deberían) añadir más validaciones: formato de email, longitud de contraseña, formato de cédula, etc.
    if (empty($nombre) || empty($apellido) || empty($email) || empty($password) || empty($cedula)) {
        // Si faltan datos, redirige al usuario de vuelta a la página de pacientes con un mensaje de error.
        // El parámetro 'status' en la URL se puede usar en la vista para mostrar un mensaje al usuario.
        header('Location: ?pagina=pacientes&status=error_creacion_faltan_datos');
        exit; // Termina la ejecución.
    }

    // 3. Hashear contraseña. ¡Esto es crucial por seguridad!
    // Nunca se deben guardar contraseñas en texto plano en la base de datos.
    // password_hash() crea un hash seguro de la contraseña. PASSWORD_DEFAULT usa el algoritmo de hashing más fuerte disponible en PHP.
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 4. Llamar a la función del controlador (definida más abajo) que interactúa con el modelo para crear el paciente.
    // Se pasa la contraseña ya hasheada.
    crearpaciente($nombre, $apellido, $cedula, $telefono, $fecha_nacimiento, $genero, $direccion, $ciudad, $pais, $email, $hashedPassword);

    // 5. Redireccionar para evitar reenvío de formulario (Patrón Post/Redirect/Get - PRG).
    // Después de procesar un POST exitosamente, se redirige al usuario. Esto evita que si el usuario recarga la página,
    // el formulario se envíe de nuevo.
    header('Location: ?pagina=pacientes&status=creado_exitosamente');
    exit; 
}

// --- MANEJO DE ACCIÓN DE ACTUALIZAR PACIENTE (cuando se envía el formulario de modificación) ---
// Este bloque se ejecuta si se ha enviado un formulario por POST y existe un campo con name="actualizar_paciente_submit".
if (isset($_POST['actualizar_paciente_submit'])) { 
    // Obtiene el ID del paciente a actualizar desde el campo oculto 'id_paciente' del formulario.
    $id_paciente = $_POST['id_paciente'] ?? null;

    // Si se proporcionó un ID de paciente...
    if ($id_paciente) {
        // Llama a la función del controlador para actualizar los datos del paciente.
        // Se pasan los nuevos valores obtenidos de $_POST.
        // Para la contraseña, se pasa null. Esto implica que la función actualizarpaciente
        // y el modelo deben estar preparados para no actualizar la contraseña si no se proporciona una nueva.
        // Si se quisiera permitir cambiar la contraseña aquí, se necesitaría un campo para la nueva contraseña
        // y lógica para hashearla antes de pasarla.
        actualizarpaciente(
            $id_paciente,
            $_POST['nombre'] ?? null,
            $_POST['apellido'] ?? null,
            $_POST['cedula'] ?? null,
            $_POST['telefono'] ?? null,
            $_POST['fecha_nacimiento'] ?? null,
            $_POST['genero'] ?? null,
            $_POST['direccion'] ?? null,
            $_POST['ciudad'] ?? null,
            $_POST['pais'] ?? null,
            $_POST['email'] ?? null, // El email se puede actualizar
            null // Contraseña no se actualiza en este flujo (se pasa null)
        );
        // Redirige con un mensaje de éxito.
        header('Location: ?pagina=pacientes&status=actualizado_exitosamente');
        exit;
    } else {
        // Si no se proporcionó un ID, redirige con un mensaje de error.
        header('Location: ?pagina=pacientes&status=error_actualizacion_sin_id');
        exit;
    }
}

//  Manejo de acción para eliminar un paciente.
// Se activa si la URL contiene '?accion=eliminarpaciente&id_paciente=ID_DEL_PACIENTE'.
// Nota: En la vista, el ID del paciente se pasa como 'id', no 'id_paciente' en el enlace de eliminación.
// Esto debería ser consistente. Asumiré que la vista envía 'id' y lo cambiaré aquí, o se debe cambiar en la vista.
// Por ahora, el código original usa 'id_paciente' aquí, así que lo mantendré, pero es un punto a revisar.
// El código de la vista `pacientes.php` en la línea 176 usa `&id=`, así que hay una inconsistencia.
// Voy a asumir que el GET debería ser 'id' como en la vista.
// if (isset($_GET['accion']) && $_GET['accion'] === 'eliminarpaciente' && isset($_GET['id'])) {
//    eliminarpaciente($_GET['id']); // Usar $_GET['id'] si la vista envía 'id'
//    header('Location: ?pagina=pacientes&status=eliminado_exitosamente');
//    exit;
// }
// Corrigiendo según el código original que espera 'id_paciente' en el GET para esta acción:
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminarpaciente' && isset($_GET['id_paciente'])) {
    eliminarpaciente($_GET['id_paciente']);
    header('Location: ?pagina=pacientes&status=eliminado_exitosamente');
    exit;
}


// --- Funciones del controlador ---
// Estas funciones actúan como intermediarios entre la lógica de la aplicación (este archivo) y el modelo (pacientes.php en Model).
// Son llamadas por los bloques de manejo de acciones (POST/GET) de arriba o directamente por el script principal
// si se necesita cargar datos para mostrar en la vista (por ejemplo, al cargar la página inicialmente).

// Función para listar todos los pacientes.
function listarpaciente(){
    // Crea una nueva instancia del modelo 'pacienteModulo'.
    $paciente = new pacienteModulo();
    // Llama al método 'listarpaciente' del modelo, que ejecuta la consulta a la BD y devuelve los resultados.
    return $paciente->listarpaciente();
}

// Función para obtener los datos de un paciente específico por su ID.
function obtenerpaciente($id){
    $paciente = new pacienteModulo();
    // Llama al método 'obtenerpaciente' del modelo, pasándole el ID.
    return $paciente->obtenerpaciente($id);
}

// Función para crear un nuevo paciente.
// Recibe todos los datos del paciente como parámetros.
function crearpaciente($nombre, $apellido, $cedula, $telefono, $fecha_nacimiento, $genero, $direccion, $ciudad, $pais, $email, $password){
    $paciente = new pacienteModulo();
    // Usa los métodos 'set' del modelo para asignar cada valor a las propiedades correspondientes del objeto $paciente.
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
    $paciente->setpassword($password); // La contraseña ya debería estar hasheada aquí.
    // Llama al método 'crearpaciente' del modelo para insertar los datos en la BD.
    return $paciente->crearpaciente(); 
}

// Función para actualizar los datos de un paciente existente.
// Recibe el ID del paciente y los nuevos datos.
function actualizarpaciente($id, $nombre, $apellido, $cedula, $telefono, $fecha_nacimiento, $genero, $direccion, $ciudad, $pais, $email, $password){
    $paciente = new pacienteModulo();
    $paciente->setId($id); // Establece el ID del paciente a modificar.
    $paciente->setNombre($nombre);
    $paciente->setapellido($apellido);
    $paciente->setcedula($cedula);
    $paciente->settelefono($telefono); 
    $paciente->setfecha_nacimiento($fecha_nacimiento);
    $paciente->setgenero($genero);
    $paciente->setdireccion($direccion);
    $paciente->setciudad($ciudad);
    $paciente->setpais($pais);

    // Solo actualiza el email si se proporciona uno nuevo (no es null).
    if ($email !== null) { 
        $paciente->setemail($email);
    }
    // Solo actualiza la contraseña si se proporciona una nueva (no es null).
    // IMPORTANTE: Si se permite actualizar la contraseña aquí, debería ser hasheada antes de llamar a setpassword.
    // Actualmente, se pasa $password (que es null en el flujo de actualización de arriba).
    // Si se quisiera cambiar la contraseña, el formulario de edición necesitaría campos para la nueva contraseña
    // y este controlador debería hashearla.
    if ($password !== null) { 
        $paciente->setpassword($password); // Si $password no es null, debería ser una contraseña ya hasheada.
    }
    // Llama al método 'actualizarpaciente' del modelo.
    return $paciente->actualizarpaciente(); 
}

// Función para eliminar un paciente por su ID.
function eliminarpaciente($id_paciente){
    $paciente = new pacienteModulo();
    // Llama al método 'eliminarpaciente' del modelo.
    return $paciente->eliminarpaciente($id_paciente);
}


// --- Preparación de datos para la vista ---
// Este código se ejecuta si ninguna de las condiciones anteriores (AJAX, POST, GET con 'exit') se cumplió.
// Es decir, cuando se carga la página de pacientes de forma normal.
$pacientes = listarpaciente(); // Llama a la función para obtener la lista completa de pacientes.
                               // Esta variable $pacientes estará disponible en el archivo de la vista.

// --- Inclusión de la vista ---
// Incluye el archivo PHP que contiene el HTML para mostrar la página de pacientes.
// La vista (pacientes.php en la carpeta View) tendrá acceso a la variable $pacientes definida arriba.
require_once BASE_PATH . 'View/pacientes.php'; 

// Envía el contenido del búfer de salida al navegador y lo desactiva.
// Todo lo que se haya "impreso" (echo, HTML fuera de <?php ?>) desde ob_start() se envía ahora.
ob_end_flush(); 
?>
