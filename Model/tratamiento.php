<?php
require_once BASE_PATH . 'Config/conexion.php';

class tratamientoModulo extends Conexion {
    private $id;
    private $id_paciente;
    private $fecha_creacion;
    private $diagnostico_descripcion;
    private $tratamiento_tipo;
    private $estado_actual;
    private $observaciones;
    protected $pdo;

    public function __construct() {
        $this->pdo = Conexion::getConexion();
    }
    // Getters
    public function getId() { return $this->id; }
    public function getid_paciente() { return $this->id_paciente; }
    public function getfecha_creacion() { return $this->fecha_creacion; }
    public function getdiagnostico_descripcion() { return $this->diagnostico_descripcion; }
    public function gettratamiento_tipo() { return $this->tratamiento_tipo; }
    public function getestado_actual() { return $this->estado_actual; }
    public function getobservaciones() { return $this->observaciones; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setid_paciente($id_paciente) { $this->id_paciente = $id_paciente; }
    public function setfecha_creacion($fecha_creacion) { $this->fecha_creacion = $fecha_creacion; }
    public function setdiagnostico_descripcion($diagnostico_descripcion) { $this->diagnostico_descripcion = $diagnostico_descripcion; }
    public function settratamiento_tipo($tratamiento_tipo) { $this->tratamiento_tipo = $tratamiento_tipo; }
    public function setestado_actual($estado_actual) { $this->estado_actual = $estado_actual; }
    public function setobservaciones($observaciones) { $this->observaciones = $observaciones; }

    public function listartratamientos() {
        $stmt = $this->pdo->query("SELECT tratamientos.*, pacientes.nombre_completo, pacientes.cedula FROM tratamientos JOIN pacientes ON tratamientos.id_paciente = pacientes.id ORDER BY tratamientos.fecha_creacion DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenertratamiento($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM tratamientos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function creartratamiento() {
        $stmt = $this->pdo->prepare("INSERT INTO tratamientos (id_paciente, fecha_creacion, diagnostico_descripcion, tratamiento_tipo, estado_actual, observaciones) VALUES (?,?,?,?,?,?)");
        $stmt->execute([
            $this->id_paciente,
            $this->fecha_creacion,
            $this->diagnostico_descripcion,
            $this->tratamiento_tipo,
            $this->estado_actual,
            $this->observaciones
        ]);
    }
    public function actualizartratamiento() {
        $stmt = $this->pdo->prepare("UPDATE tratamientos SET id_paciente = ?, fecha_creacion = ?, diagnostico_descripcion = ?, tratamiento_tipo = ?, estado_actual = ?, observaciones = ? WHERE id = ?");
        $stmt->execute([
            $this->id_paciente,
            $this->fecha_creacion,
            $this->diagnostico_descripcion,
            $this->tratamiento_tipo,
            $this->estado_actual,
            $this->observaciones,
            $this->id
        ]);
    }
    public function eliminartratamiento($id) {
        $stmt = $this->pdo->prepare("DELETE FROM tratamientos WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>