<?php
require_once BASE_PATH . 'Config/conexion.php';

class TestModel extends Conexion {
    private $pdo;

    public function __construct() {
        if (Conexion::getConexion() == null) {
            Conexion::conectar();
        }
        $this->pdo = Conexion::getConexion();
    
    }

    // Obtener todos los tests de un paciente
    public function obtenerTestsPorPaciente($id_paciente) {
        $tests = [];
        
        // Obtener tests POMS
        $stmt = $this->pdo->prepare("SELECT * FROM test_poms WHERE id_paciente = ?");
        $stmt->execute([$id_paciente]);
        $tests['poms'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Obtener tests Confianza
        $stmt = $this->pdo->prepare("SELECT * FROM test_confianza WHERE id_paciente = ?");
        $stmt->execute([$id_paciente]);
        $tests['confianza'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Obtener tests Importancia
        $stmt = $this->pdo->prepare("SELECT * FROM test_importancia WHERE id_paciente = ?");
        $stmt->execute([$id_paciente]);
        $tests['importancia'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $tests;
    }

    // Crear un nuevo test POMS
    public function crearTestPoms($id_paciente, $fecha, $deporte, $edad, $respuestas) {
        $stmt = $this->pdo->prepare("INSERT INTO test_poms (id_paciente, fecha, deporte, edad, respuestas) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$id_paciente, $fecha, $deporte, $edad, json_encode($respuestas)]);
    }

    // Crear un nuevo test de Confianza
    public function crearTestConfianza($id_paciente, $fecha, $respuestas) {
        $stmt = $this->pdo->prepare("INSERT INTO test_confianza (id_paciente, fecha, respuestas) VALUES (?, ?, ?)");
        return $stmt->execute([$id_paciente, $fecha, json_encode($respuestas)]);
    }

    // Crear un nuevo test de Importancia
    public function crearTestImportancia($id_paciente, $fecha, $parte1, $parte2) {
        $stmt = $this->pdo->prepare("INSERT INTO test_importancia (id_paciente, fecha, parte1, parte2) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$id_paciente, $fecha, json_encode($parte1), json_encode($parte2)]);
    }

    // Obtener un test específico por tipo e ID
    public function obtenerTest($tipo, $id) {
        $tabla = "test_" . strtolower($tipo);
        $stmt = $this->pdo->prepare("SELECT * FROM $tabla WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un test existente
    public function actualizarTest($tipo, $id, $datos) {
        $tabla = "test_" . strtolower($tipo);
        $campos = [];
        $valores = [];
        
        foreach ($datos as $campo => $valor) {
            $campos[] = "$campo = ?";
            $valores[] = is_array($valor) ? json_encode($valor) : $valor;
        }
        
        $valores[] = $id;
        $sql = "UPDATE $tabla SET " . implode(', ', $campos) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($valores);
    }

    // Eliminar un test
    public function eliminarTest($tipo, $id) {
        $tabla = "test_" . strtolower($tipo);
        $stmt = $this->pdo->prepare("DELETE FROM $tabla WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Obtener lista de pacientes para select
    public function obtenerPacientesParaSelect() {
        $stmt = $this->pdo->query("SELECT id_paciente, nombre, apellido FROM paciente ORDER BY apellido, nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>