<?php

require_once BASE_PATH . 'config/conexion.php';

class citaModulo extends Conexion{

    private $id;
    private $title;
    private $descripcion;
    private $color;
    private $textColor;
    private $start;
    private $end;

    public function __construct(){
        parent::__construct();
    }
    public function getId(){
        return $this->id;
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
        $stmt = $this->pdo->query("SELECT * FROM cita");
        return $stmt-> fetchALL(PDO::FETCH_ASSOC);
    }
    public function obtenercita($id){
        $stmt = $this->pdo->prepare("SELECT * FROM cita WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function crearcita(){
        $stmt=$this->pdo->prepare("INSERT INTO cita (title, descripcion, color, textColor, start, end) VALUES (?,?,?,?,?,?)");
        $stmt->execute([$this->title, $this->descripcion, $this->color, $this->textColor, $this->start, $this->end]);
    }
    public function actualizarcita(){
        $stmt = $this->pdo->prepare("UPDATE cita SET title = ?, descripcion = ?, color = ?, textColor = ?, start = ?, end = ? WHERE id = ?");
    // 5 parámetros en el orden correcto, ID al final para el WHERE
    $stmt->execute([$this->title,$this->descripcion, $this->color, $this->textColor, $this->start, $this->end,$this->id]);
    }
    public function eliminarcita($id){
        $stmt=$this->pdo->prepare("DELETE FROM cita WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>