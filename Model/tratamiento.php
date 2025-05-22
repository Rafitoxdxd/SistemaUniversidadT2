<?php

require_once BASE_PATH . 'Config/conexion.php';

class tratamientoModulo extends Conexion{

    private $id;
    private $fecha_creacion;
    private $diagnostico_descripcion;
    private $tratamiento_tipo;
    private $estado_actual;

    public function __construct(){
        parent::__construct();
    }
    public function getId(){
        return $this->id;
    }
    public function getfecha_creacion(){
        return $this->fecha_creacion;
    }
    public function getdiagnostico_descripcion(){
        return $this->diagnostico_descripcion;
    }
    public function gettratamiento_tipo(){
        return $this->tratamiento_tipo;
    }
    public function getestado_actual(){
        return $this->estado_actual;
    }



    public function setId($id){
        $this->id = $id;
    }
    public function setfecha_creacion($fecha_creacion){
        $this->fecha_creacion = $fecha_creacion;
    }
    public function setdiagnostico_descripcion($diagnostico_descripcion){
        $this->diagnostico_descripcion = $diagnostico_descripcion;
    }
    public function settratamiento_tipo($tratamiento_tipo){
        $this->tratamiento_tipo = $tratamiento_tipo;
    }
    public function setestado_actual($estado_actual){
        $this->estado_actual = $estado_actual;
    }



    public function listartratamiento(){
        $stmt = $this->pdo->query("SELECT * FROM tratamiento");
        return $stmt-> fetchALL(PDO::FETCH_ASSOC);
    }
    public function obtenertratamiento($id){
        $stmt = $this->pdo->prepare("SELECT * FROM tratamiento WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function creartratamiento(){
        $stmt=$this->pdo->prepare("INSERT INTO tratamiento (fecha_creacion,diagnostico_descripcion,tratamiento_tipo,estado_actual) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$this->fecha_creacion,$this->diagnostico_descripcion,$this->tratamiento_tipo,$this->estado_actual]);
    }
    public function actualizartratamiento(){
        $stmt = $this->pdo->prepare("UPDATE tratamiento SET fecha_creacion = ?, diagnostico_descripcion = ?, tratamiento_tipo = ?, estado_actual = ?, WHERE id = ?");
    // 5 parámetros en el orden correcto, ID al final para el WHERE
    $stmt->execute([$this->fecha_creacion,$this->diagnostico_descripcion,$this->tratamiento_tipo,$this->estado_actual]);
    }
    public function eliminartratamiento($id){
        $stmt=$this->pdo->prepare("DELETE FROM tratamiento WHERE id=?");
        $stmt->execute([$id]);
    }
}



?>