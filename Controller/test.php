<?php
// Inicia el búfer de salida. Esto permite que el contenido de la página se genere
// y se guarde en un búfer antes de ser enviado al navegador. Es útil para evitar
// errores de "Headers already sent" cuando se usan funciones como header() o session_start().
ob_start();

// Verifica si la sesión PHP no ha sido iniciada.
// Si no hay una sesión activa, la inicia. Esto es crucial para manejar
// datos de sesión entre diferentes solicitudes del usuario.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluye el archivo del modelo 'test.php'.
// Se asume que BASE_PATH es una constante previamente definida que apunta
// a la ruta base de la aplicación. Este archivo 'test.php' contendría
// la lógica para interactuar con la base de datos y manejar los datos relacionados con los tests.
require_once BASE_PATH . 'Model/test.php';

// Instancia el modelo TestModel.
// Esto crea un objeto a través del cual se podrán llamar a los métodos
// definidos en la clase TestModel para realizar operaciones con los tests.
$model = new TestModel();

// --- Manejo de Solicitudes AJAX ---
// Esta sección del código se encarga de procesar las solicitudes AJAX enviadas por el cliente.
// Se ejecuta solo si la solicitud es de tipo POST y si se ha enviado el parámetro 'ajax_action'.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax_action'])) {
    // Establece la cabecera Content-Type a 'application/json'.
    // Esto indica al navegador que la respuesta del servidor será en formato JSON.
    header('Content-Type: application/json');
    
    try {
        // Inicializa un array vacío para almacenar la respuesta que se enviará como JSON.
        $response = [];
        
        // Un switch que maneja diferentes acciones AJAX basándose en el valor de 'ajax_action'.
        switch ($_POST['ajax_action']) {
            // Caso para obtener todos los tests de un paciente específico.
            case 'obtenerTests':
                // Obtiene el 'id_paciente' de la solicitud POST, por defecto 0 si no se envía.
                $id_paciente = $_POST['id_paciente'] ?? 0;
                // Llama al método del modelo para obtener los tests.
                $tests = $model->obtenerTestsPorPaciente($id_paciente);
                // Prepara la respuesta JSON indicando éxito y los datos obtenidos.
                $response = ['success' => true, 'data' => $tests];
                break;
                
            // Caso para obtener un test específico por tipo e ID.
            case 'obtenerTest':
                // Obtiene el 'tipo' y el 'id' del test de la solicitud POST.
                $tipo = $_POST['tipo'] ?? '';
                $id = $_POST['id'] ?? 0;
                // Llama al método del modelo para obtener el test.
                $test = $model->obtenerTest($tipo, $id);
                // Prepara la respuesta JSON.
                $response = ['success' => true, 'data' => $test];
                break;
                
            // Caso para obtener la lista de pacientes, típicamente para un campo select en un formulario.
            case 'obtenerPacientes':
                // Llama al método del modelo para obtener los pacientes.
                $pacientes = $model->obtenerPacientesParaSelect();
                // Prepara la respuesta JSON.
                $response = ['success' => true, 'data' => $pacientes];
                break;
                
            // Caso para guardar un nuevo test.
            case 'guardar_test':
                // Obtiene el ID del paciente y el tipo de test de la solicitud POST.
                $id_paciente = $_POST['id_paciente'] ?? 0;
                $tipo_test = $_POST['tipo_test'] ?? '';
                // Obtiene la fecha actual en formato 'YYYY-MM-DD'.
                $fecha = date('Y-m-d');
                
                // Un switch interno para manejar el guardado de diferentes tipos de tests.
                switch ($tipo_test) {
                    // Guarda un test de tipo POMS.
                    case 'poms':
                        // Obtiene los datos específicos del test POMS.
                        $deporte = $_POST['deporte'] ?? '';
                        $edad = $_POST['edad'] ?? 0;
                        $respuestas = [];
                        // Recopila las 65 respuestas del test POMS.
                        for ($i = 1; $i <= 65; $i++) {
                            $respuestas[$i] = $_POST['pregunta_'.$i] ?? 0;
                        }
                        // Llama al método del modelo para crear el test POMS.
                        $success = $model->crearTestPoms($id_paciente, $fecha, $deporte, $edad, $respuestas);
                        // Prepara la respuesta basada en el resultado de la operación.
                        $response = $success ? 
                            ['success' => true, 'message' => 'Test POMS guardado correctamente'] : 
                            ['success' => false, 'message' => 'Error al guardar test POMS'];
                        break;
                        
                    // Guarda un test de tipo Confianza.
                    case 'confianza':
                        $respuestas = [];
                        // Recopila las 10 respuestas del test de Confianza.
                        for ($i = 1; $i <= 10; $i++) {
                            $respuestas[$i] = $_POST['pregunta_'.$i] ?? 1;
                        }
                        // Llama al método del modelo para crear el test de Confianza.
                        $success = $model->crearTestConfianza($id_paciente, $fecha, $respuestas);
                        // Prepara la respuesta.
                        $response = $success ? 
                            ['success' => true, 'message' => 'Test de Confianza guardado correctamente'] : 
                            ['success' => false, 'message' => 'Error al guardar test de Confianza'];
                        break;
                        
                    // Guarda un test de tipo Importancia.
                    case 'importancia':
                        $parte1 = [];
                        $parte2 = [];
                        // Recopila las respuestas de la Parte 1 (17 preguntas).
                        for ($i = 1; $i <= 17; $i++) {
                            $parte1[$i] = $_POST['parte1_pregunta_'.$i] ?? 1;
                        }
                        // Recopila las respuestas de la Parte 2 (preguntas 18 a 34).
                        for ($i = 18; $i <= 34; $i++) {
                            $parte2[$i] = $_POST['parte2_pregunta_'.$i] ?? 1;
                        }
                        // Llama al método del modelo para crear el test de Importancia.
                        $success = $model->crearTestImportancia($id_paciente, $fecha, $parte1, $parte2);
                        // Prepara la respuesta.
                        $response = $success ? 
                            ['success' => true, 'message' => 'Test de Importancia guardado correctamente'] : 
                            ['success' => false, 'message' => 'Error al guardar test de Importancia'];
                        break;
                        
                    // Caso por defecto para tipos de test no válidos al guardar.
                    default:
                        $response = ['success' => false, 'message' => 'Tipo de test no válido'];
                }
                break;
                
            // Caso para actualizar un test existente.
            case 'actualizar_test':
                // Obtiene el ID del test y el tipo de test a actualizar.
                $id = $_POST['id_test'] ?? 0;
                $tipo_test = $_POST['tipo_test'] ?? '';
                // Inicializa un array para los datos a actualizar, incluyendo la fecha actual.
                $datos = ['fecha' => date('Y-m-d')];
                
                // Un switch interno para manejar la actualización de diferentes tipos de tests.
                switch ($tipo_test) {
                    // Actualiza un test de tipo POMS.
                    case 'poms':
                        // Agrega los datos específicos de POMS al array de datos.
                        $datos['deporte'] = $_POST['deporte'] ?? '';
                        $datos['edad'] = $_POST['edad'] ?? 0;
                        $respuestas = [];
                        // Recopila las 65 respuestas.
                        for ($i = 1; $i <= 65; $i++) {
                            $respuestas[$i] = $_POST['pregunta_'.$i] ?? 0;
                        }
                        $datos['respuestas'] = $respuestas;
                        break;
                        
                    // Actualiza un test de tipo Confianza.
                    case 'confianza':
                        $respuestas = [];
                        // Recopila las 10 respuestas.
                        for ($i = 1; $i <= 10; $i++) {
                            $respuestas[$i] = $_POST['pregunta_'.$i] ?? 1;
                        }
                        $datos['respuestas'] = $respuestas;
                        break;
                        
                    // Actualiza un test de tipo Importancia.
                    case 'importancia':
                        $parte1 = [];
                        $parte2 = [];
                        // Recopila las respuestas de la Parte 1.
                        for ($i = 1; $i <= 17; $i++) {
                            $parte1[$i] = $_POST['parte1_pregunta_'.$i] ?? 1;
                        }
                        // Recopila las respuestas de la Parte 2.
                        for ($i = 18; $i <= 34; $i++) {
                            $parte2[$i] = $_POST['parte2_pregunta_'.$i] ?? 1;
                        }
                        $datos['parte1'] = $parte1;
                        $datos['parte2'] = $parte2;
                        break;
                        
                    // Caso por defecto para tipos de test no válidos al actualizar.
                    default:
                        $response = ['success' => false, 'message' => 'Tipo de test no válido'];
                        // Envía la respuesta JSON y termina la ejecución.
                        echo json_encode($response);
                        exit;
                }
                
                // Llama al método del modelo para actualizar el test con los datos recopilados.
                $success = $model->actualizarTest($tipo_test, $id, $datos);
                // Prepara la respuesta.
                $response = $success ? 
                    ['success' => true, 'message' => 'Test actualizado correctamente'] : 
                    ['success' => false, 'message' => 'Error al actualizar test'];
                break;
                
            // Caso para eliminar un test.
            case 'eliminarTest':
                // Obtiene el tipo y el ID del test a eliminar.
                $tipo = $_POST['tipo'] ?? '';
                $id = $_POST['id'] ?? 0;
                
                // Llama al método del modelo para eliminar el test.
                $success = $model->eliminarTest($tipo, $id);
                // Prepara la respuesta.
                $response = $success ? 
                    ['success' => true, 'message' => 'Test eliminado correctamente'] : 
                    ['success' => false, 'message' => 'Error al eliminar test'];
                break;
                
            // Caso por defecto para acciones AJAX no válidas.
            default:
                $response = ['success' => false, 'message' => 'Acción no válida'];
        }
        
        // Envía la respuesta JSON al cliente y termina la ejecución del script.
        echo json_encode($response);
        exit;
        
    } catch (Exception $e) {
        // Captura cualquier excepción que ocurra durante el procesamiento de la solicitud AJAX.
        // Envía una respuesta JSON con un mensaje de error y termina la ejecución.
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        exit;
    }
}

// --- Lógica para la vista principal (no AJAX) ---
// Obtener la lista de pacientes para cargar en un elemento select (dropdown) en la vista.
// Esta parte del código se ejecuta si no es una solicitud AJAX.
$pacientes = $model->obtenerPacientesParaSelect();

// Obtener mensajes de estado o error de la URL si existen.
// Estos parámetros se usan para mostrar mensajes al usuario después de una operación
// (por ejemplo, después de guardar o actualizar un test).
$status = $_GET['status'] ?? '';
$error = $_GET['error'] ?? '';

// Incluye el archivo de la vista 'test.php'.
// Se asume que BASE_PATH está definido. Este archivo contendría el HTML y PHP
// para renderizar la interfaz de usuario de la sección de tests, mostrando
// los pacientes, formularios para crear/editar tests, etc.
require_once BASE_PATH . 'View/test.php';

// Envía el contenido del búfer de salida al navegador.
// Esto marca el final del procesamiento del script PHP y envía toda la salida generada.
ob_end_flush();
?>