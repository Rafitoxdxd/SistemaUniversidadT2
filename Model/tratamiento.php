<?php
require_once BASE_PATH . 'Config/conexion.php';

class Tratamiento extends Conexion {
    private $id_tratamiento;
    private $id_paciente;
    private $fecha_creacion;
    private $diagnostico_descripcion;
    private $tratamiento_tipo;
    private $estado_actual;
    private $observaciones;
    private $pdo;       

    public function __construct() {
        if (Conexion::getConexion() == null) {
            Conexion::conectar();
        }
        $this->pdo = Conexion::getConexion();
    }

    public function listarTratamientos() {
        try {
            $sql = "SELECT t.*, p.nombre, p.apellido, p.cedula 
                    FROM tratamientos t 
                    JOIN paciente p ON t.id_paciente = p.id_paciente 
                    ORDER BY t.fecha_creacion DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al listar tratamientos: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerTratamiento($id) {
        try {
            $sql = "SELECT t.*, p.nombre, p.apellido, p.cedula 
                    FROM tratamientos t 
                    JOIN paciente p ON t.id_paciente = p.id_paciente 
                    WHERE t.id_tratamiento = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener tratamiento: " . $e->getMessage());
            return false;
        }
    }

    public function buscarTratamientos($termino) {
        try {
            $sql = "SELECT t.*, p.nombre, p.apellido, p.cedula 
                    FROM tratamientos t 
                    JOIN paciente p ON t.id_paciente = p.id_paciente 
                    WHERE p.nombre LIKE ? OR p.apellido LIKE ? OR p.cedula LIKE ? 
                    OR t.estado_actual LIKE ? OR t.fecha_creacion LIKE ?
                    ORDER BY t.fecha_creacion DESC";
            $stmt = $this->pdo->prepare($sql);
            $termino = "%$termino%";
            $stmt->execute([$termino, $termino, $termino, $termino, $termino]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al buscar tratamientos: " . $e->getMessage());
            return [];
        }
    }

    public function crearTratamiento($data) {
        try {
            $sql = "INSERT INTO tratamientos 
                    (id_paciente, fecha_creacion, diagnostico_descripcion, tratamiento_tipo, estado_actual, observaciones) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $data['id_paciente'],
                $data['fecha_creacion'],
                $data['diagnostico_descripcion'],
                $data['tratamiento_tipo'],
                $data['estado_actual'],
                $data['observaciones'] ?? ''
            ]);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error al crear tratamiento: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarTratamiento($id, $data) {
        try {
            $sql = "UPDATE tratamientos SET 
                    id_paciente = ?, 
                    fecha_creacion = ?, 
                    diagnostico_descripcion = ?, 
                    tratamiento_tipo = ?, 
                    estado_actual = ?, 
                    observaciones = ? 
                    WHERE id_tratamiento = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                $data['id_paciente'],
                $data['fecha_creacion'],
                $data['diagnostico_descripcion'],
                $data['tratamiento_tipo'],
                $data['estado_actual'],
                $data['observaciones'] ?? '',
                $id
            ]);
        } catch (PDOException $e) {
            error_log("Error al actualizar tratamiento: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarTratamiento($id) {
        try {
            $sql = "DELETE FROM tratamientos WHERE id_tratamiento = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar tratamiento: " . $e->getMessage());
            return false;
        }
    }
}
?>