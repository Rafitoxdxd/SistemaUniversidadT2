<?php

require_once BASE_PATH . 'config/conexion.php';

class testModulo extends Conexion{

    private $id;
    private $nombre;
    private $apellidos;
    private $cedula;
    private $edad;
    private $nombre_competencia;
    private $ubicacion_competencia;
    private $fecha_competencia;
    private $preparado_competencia;
    private $entrenado_previo;
    private $estrategia_previa;
    private $descripcion_nervios;
    private $antes_competir;
    private $experiencia_pasada;
    private $motivacion_competencia;
    private $esperar_competicion;
    private $lograr_competencia;
    private $rutina_mental;
    private $pensamiento_positivo;
    private $preparacion_mental;

    public function __construct(){
        parent::__construct();
    }
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellidos(){
        return $this->apellidos;
    }
    public function getCedula(){
        return $this->cedula;
    }
     public function getedad(){
        return $this->edad;
    }
    public function getNombre_competencia(){
        return $this->nombre_competencia;
    }
    public function getUbicacion_competencia(){
        return $this->ubicacion_competencia;
    }
    public function getFecha_competencia(){
        return $this->fecha_competencia;
    }
    public function getPreparado_competencia(){
        return $this->preparado_competencia;
    }
    public function getEntrenado_previo(){
        return $this->entrenado_previo;
    }
    public function getEstrategia_previa(){
        return $this->estrategia_previa;
    }
    public function getDescripcion_nervios(){
        return $this->descripcion_nervios;
    }
    public function getAntes_competir(){
        return $this->antes_competir;
    }
    public function getExperiencia_pasada(){
        return $this->experiencia_pasada;
    }
    public function getMotivacion_competencia(){
        return $this->motivacion_competencia;
    }
    public function getEsperar_competicion(){
        return $this->esperar_competicion;
    }
	public function getLograr_competencia(){
        return $this->lograr_competencia;
    }
    public function getRutina_mental(){
        return $this->rutina_mental;
    }
    public function getPensamiento_positivo(){
        return $this->pensamiento_positivo;
    }
    public function getPreparacion_mental(){
        return $this->preparacion_mental;
    }



    public function setId($id){
        $this->id = $id;
    }
    public function setnombre($nombre){
        $this->nombre = $nombre;
    }
    public function setapellidos($apellidos){
        $this->apellidos = $apellidos;
    }
    public function setcedula($cedula){
        $this->cedula = $cedula;
    }
    public function setedad($edad){
        $this->edad = $edad;
    }
    public function setnombre_competencia($nombre_competencia){
        $this->nombre_competencia = $nombre_competencia;
    }
    public function setubicacion_competencia($ubicacion_competencia){
        $this->ubicacion_competencia = $ubicacion_competencia;
    }
    public function setfecha_competencia($fecha_competencia){
        $this->fecha_competencia = $fecha_competencia;
    }
    public function setpreparado_competencia($preparado_competencia){
        $this->preparado_competencia = $preparado_competencia;
    }
    public function setentrenado_previo($entrenado_previo){
        $this->entrenado_previo = $entrenado_previo;
    }
    public function setestrategia_previa($estrategia_previa){
        $this->estrategia_previa = $estrategia_previa;
    }
    public function setdescripcion_nervios($descripcion_nervios){
        $this->descripcion_nervios = $descripcion_nervios;
    }
    public function setantes_competir($antes_competir){
        $this->antes_competir = $antes_competir;
    }
    public function setexperiencia_pasada($experiencia_pasada){
        $this->experiencia_pasada = $experiencia_pasada;
    }
    public function setmotivacion_competencia($motivacion_competencia){
        $this->motivacion_competencia = $motivacion_competencia;
    }
    public function setesperar_competicion($esperar_competicion){
        $this->esperar_competicion = $esperar_competicion;
    }
    public function setlograr_competencia($lograr_competencia){
        $this->lograr_competencia = $lograr_competencia;
    }
    public function setrutina_mental($rutina_mental){
        $this->rutina_mental = $rutina_mental;
    }
    public function setpensamiento_positivo($pensamiento_positivo){
        $this->pensamiento_positivo = $pensamiento_positivo;
    }
    public function setpreparacion_mental($preparacion_mental){
        $this->preparacion_mental = $preparacion_mental;
    }
    
 

    public function listartest(){
        $stmt = $this->pdo->query("SELECT * FROM test");
        return $stmt-> fetchALL(PDO::FETCH_ASSOC);
    }
    public function obtenertest($id){
        $stmt = $this->pdo->prepare("SELECT * FROM test WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function creartest(){
        $stmt=$this->pdo->prepare("INSERT INTO test (nombre,apellidos,cedula,edad,nombre_competencia,ubicacion_competencia,fecha_competencia,preparado_competencia,entrenado_previo,estrategia_previa,descripcion_nervios,antes_competir,experiencia_pasada,motivacion_competencia,esperar_competicion,lograr_competencia,rutina_mental,pensamiento_positivo,preparacion_mental) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$this->nombre,$this->apellidos,$this->cedula,$this->edad,$this->nombre_competencia,$this->ubicacion_competencia,$this->fecha_competencia,$this->preparado_competencia,$this->entrenado_previo,$this->estrategia_previa,$this->descripcion_nervios,$this->antes_competir,$this->experiencia_pasada,$this->motivacion_competencia,$this->esperar_competicion,$this->lograr_competencia,$this->rutina_mental,$this->pensamiento_positivo,$this->preparacion_mental]);
    }
    public function actualizartest(){
        $stmt = $this->pdo->prepare("UPDATE test SET nombre = ?, apellidos = ?, cedula = ?,  edad = ?,  nombre_competencia = ?,  ubicacion_competencia = ?,  fecha_competencia = ?,  preparado_competencia = ?,  entrenado_previo = ?,  estrategia_previa = ?,  descripcion_nervios = ?, antes_competir  = ?,  experiencia_pasada = ?,  motivacion_competencia = ?,  esperar_competicion = ?,  lograr_competencia = ?,  rutina_mental = ?,  pensamiento_positivo = ?,  preparacion_mental = ?  WHERE id = ?");
    // 5 parámetros en el orden correcto, ID al final para el WHERE
    $stmt->execute([$this->nombre,$this->apellidos,$this->cedula,$this->edad,$this->nombre_competencia,$this->ubicacion_competencia,$this->fecha_competencia,$this->preparado_competencia,$this->entrenado_previo,$this->estrategia_previa,$this->descripcion_nervios,$this->antes_competir,$this->experiencia_pasada,$this->motivacion_competencia,$this->esperar_competicion,$this->lograr_competencia,$this->rutina_mental,$this->pensamiento_positivo,$this->preparacion_mental,$this->id]);
    }
    public function eliminartest($id){
        $stmt=$this->pdo->prepare("DELETE FROM test WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>
