<?php

require_once BASE_PATH . 'Config/conexion.php';

class citaModulo extends Conexion{

    private $id;
    private $id_paciente;    
    private $title;
    private $descripcion;
    private $color;
    private $textColor;
    private $start;
    private $end;
    protected $pdo;

    public function __construct(){
        $this->pdo = Conexion::getConexion();
    }
    public function getId(){
        return $this->id;
    }
    public function getid_paciente(){
    return $this->id_paciente;
}
    public function gettitle(){
        return $this->title;
    }
    public function getdescripcion(){
        return $this->descripcion;
    }
    public function getcolor(){
        return $this->color;
    }
    public function gettextColor(){
        return $this->textColor;
    }
    public function getstart(){
        return $this->start;
    }
    public function getend(){
        return $this->end;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setid_paciente($id_paciente){
    $this->id_paciente = $id_paciente;
}
    public function settitle($title){
        $this->title = $title;
    }
    public function setdescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function setcolor($color){
        $this->color = $color;
    }
    public function settextColor($textColor){
        $this->textColor = $textColor;
    }
    public function setstart($start){
        $this->start = $start;
    }
    public function setend($end){
        $this->end = $end;
    }

    public function listarcita(){
        $stmt = $this->pdo->query("SELECT cita.*, paciente.nombre, paciente.apellido, paciente.cedula 
                                   FROM cita 
                                   JOIN paciente ON cita.id_paciente = paciente.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenercita($id){
        $stmt = $this->pdo->prepare("SELECT * FROM cita WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function crearcita(){
        $stmt = $this->pdo->prepare("INSERT INTO cita (id_paciente, title, descripcion, color, textColor, start, end) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([
            $this->id_paciente,
            $this->title,
            $this->descripcion,
            $this->color,
            $this->textColor,
            $this->start,
            $this->end
        ]);
    }
    public function actualizarcita(){
        $stmt = $this->pdo->prepare("UPDATE cita SET id_paciente = ?, title = ?, descripcion = ?, color = ?, textColor = ?, start = ?, end = ? WHERE id = ?");
    // 5 parámetros en el orden correcto, ID al final para el WHERE
    $stmt->execute([$this->id_paciente, $this->title,$this->descripcion, $this->color, $this->textColor, $this->start, $this->end,$this->id]);
    }
    public function eliminarcita($id){
        $stmt=$this->pdo->prepare("DELETE FROM cita WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>