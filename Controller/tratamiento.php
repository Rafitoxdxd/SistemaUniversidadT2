<?php
require_once BASE_PATH . 'Model/Tratamiento.php';
require_once BASE_PATH . 'Model/Pacientes.php';

class TratamientoController {
    private $tratamientoModel;
    private $pacienteModel;

    public function __construct() {
        $this->tratamientoModel = new Tratamiento();
        $this->pacienteModel = new PacienteModulo();
    }

    public function listarTratamientos() {
        return $this->tratamientoModel->listarTratamientos();
    }

    public function buscarTratamientos($termino) {
        return $this->tratamientoModel->buscarTratamientos($termino);
    }

    public function obtenerTratamiento($id) {
        return $this->tratamientoModel->obtenerTratamiento($id);
    }

    public function crearTratamiento($data) {
        // Validación de datos antes de crear
        $errors = $this->validarDatosTratamiento($data);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
        
        $result = $this->tratamientoModel->crearTratamiento($data);
        return $result !== false 
            ? ['success' => true, 'id' => $result] 
            : ['success' => false, 'message' => 'Error al crear el tratamiento'];
    }

    public function actualizarTratamiento($id, $data) {
        // Validación de datos antes de actualizar
        $errors = $this->validarDatosTratamiento($data);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
        
        $result = $this->tratamientoModel->actualizarTratamiento($id, $data);
        return $result 
            ? ['success' => true] 
            : ['success' => false, 'message' => 'Error al actualizar el tratamiento'];
    }

    public function eliminarTratamiento($id) {
        $result = $this->tratamientoModel->eliminarTratamiento($id);
        return $result 
            ? ['success' => true] 
            : ['success' => false, 'message' => 'Error al eliminar el tratamiento'];
    }

    public function obtenerPacientes() {
        return $this->pacienteModel->listarpaciente();
    }

    private function validarDatosTratamiento($data) {
        $errors = [];
        
        // Validar paciente
        if (empty($data['id_paciente'])) {
            $errors['id_paciente'] = 'Seleccione un paciente';
        }
        
        // Validar fecha
        if (empty($data['fecha_creacion'])) {
            $errors['fecha_creacion'] = 'La fecha de creación es requerida';
        } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['fecha_creacion'])) {
            $errors['fecha_creacion'] = 'Formato de fecha inválido';
        }
        
        // Validar tipo de tratamiento
        if (empty($data['tratamiento_tipo'])) {
            $errors['tratamiento_tipo'] = 'El tipo de tratamiento es requerido';
        } elseif (strlen($data['tratamiento_tipo']) > 100) {
            $errors['tratamiento_tipo'] = 'El tipo de tratamiento no debe exceder 100 caracteres';
        }
        
        // Validar estado
        $estadosValidos = ['inicial', 'en_progreso', 'pausado', 'seguimiento', 'finalizado'];
        if (empty($data['estado_actual']) || !in_array($data['estado_actual'], $estadosValidos)) {
            $errors['estado_actual'] = 'Seleccione un estado válido';
        }
        
        // Validar diagnóstico
        if (empty($data['diagnostico_descripcion'])) {
            $errors['diagnostico_descripcion'] = 'El diagnóstico es requerido';
        } elseif (strlen($data['diagnostico_descripcion']) > 500) {
            $errors['diagnostico_descripcion'] = 'El diagnóstico no debe exceder 500 caracteres';
        }
        
        // Validar observaciones (opcional)
        if (!empty($data['observaciones']) && strlen($data['observaciones']) > 500) {
            $errors['observaciones'] = 'Las observaciones no deben exceder 500 caracteres';
        }
        
        return $errors;
    }

    public function handleAjaxRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax_action'])) {
            header('Content-Type: application/json');
            
            try {
                switch ($_POST['ajax_action']) {
                    case 'listar_tratamientos':
                        echo json_encode(['success' => true, 'data' => $this->listarTratamientos()]);
                        break;
                        
                    case 'obtener_tratamiento':
                        $id = $_POST['id'] ?? 0;
                        echo json_encode(['success' => true, 'data' => $this->obtenerTratamiento($id)]);
                        break;
                        
                    case 'crear_tratamiento':
                        $result = $this->crearTratamiento($_POST);
                        echo json_encode($result);
                        break;
                        
                    case 'actualizar_tratamiento':
                        $id = $_POST['id_tratamiento'] ?? 0;
                        $result = $this->actualizarTratamiento($id, $_POST);
                        echo json_encode($result);
                        break;
                        
                    case 'eliminar_tratamiento':
                        $id = $_POST['id'] ?? 0;
                        $result = $this->eliminarTratamiento($id);
                        echo json_encode($result);
                        break;
                        
                    case 'buscar_tratamientos':
                        $termino = $_POST['termino'] ?? '';
                        echo json_encode(['success' => true, 'data' => $this->buscarTratamientos($termino)]);
                        break;
                        
                    default:
                        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            
            exit();
        }
    }
}

// Instanciar y manejar la solicitud
$controller = new TratamientoController();

// Manejar acciones AJAX
$controller->handleAjaxRequest();

// Obtener datos para la vista
$tratamientos = $controller->listarTratamientos();
$pacientes = $controller->obtenerPacientes();

// Manejar acciones normales (para compatibilidad con envíos de formulario tradicional)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['guardar_tratamiento'])) {
        $result = $controller->crearTratamiento($_POST);
        if ($result['success']) {
            $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Tratamiento creado correctamente'];
            header('Location: ?pagina=tratamiento');
            exit();
        } else {
            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => $result['message'] ?? 'Error al crear el tratamiento'];
        }
    } elseif (isset($_POST['actualizar_tratamiento'])) {
        $id = $_POST['id_tratamiento'] ?? 0;
        $result = $controller->actualizarTratamiento($id, $_POST);
        if ($result['success']) {
            $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Tratamiento actualizado correctamente'];
            header('Location: ?pagina=tratamiento');
            exit();
        } else {
            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => $result['message'] ?? 'Error al actualizar el tratamiento'];
        }
    } elseif (isset($_POST['eliminar_tratamiento'])) {
        $id = $_POST['id_tratamiento'] ?? 0;
        $result = $controller->eliminarTratamiento($id);
        if ($result['success']) {
            $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Tratamiento eliminado correctamente'];
            header('Location: ?pagina=tratamiento');
            exit();
        } else {
            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => $result['message'] ?? 'Error al eliminar el tratamiento'];
        }
    } elseif (isset($_POST['buscar'])) {
        $termino = $_POST['termino'] ?? '';
        $tratamientos = $controller->buscarTratamientos($termino);
    }
}

// Incluir la vista
require_once BASE_PATH . 'View/tratamiento.php';
?>