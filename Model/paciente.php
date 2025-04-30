<?php

require_once BASE_PATH . 'config/conexion.php';

class pacienteModulo extends Conexion{

    private $id;
    private $nombre;
    private $apellido;
    private $cedula;
    private $telefono;
    private $fecha_nacimiento;
    private $genero;
    private $direccion;
    private $ciudad;
    private $pais;
    private $email;
    private $password;

    public function __construct(){
        parent::__construct();
    }
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getCedula(){
        return $this->cedula;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getFechaNacimiento(){
        return $this->fecha_nacimiento;
    }
    public function getGenero(){
        return $this->genero;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getCiudad(){
        return $this->ciudad;
    }
    public function getPais(){
        return $this->pais;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setnombre($nombre){
        $this->nombre = $nombre;
    }
    public function setapellido($apellido){
        $this->apellido = $apellido;
    }
    public function setcedula($cedula){
        $this->cedula = $cedula;
    }
    public function settelefono($telefono){
        $this->telefono = $telefono;
    }
    public function setfecha_nacimiento($fecha_nacimiento){
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
    public function setgenero($genero){
        $this->genero = $genero;
    }
    public function setdireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setciudad($ciudad){
        $this->ciudad = $ciudad;
    }
    public function setpais($pais){
        $this->pais = $pais;
    }
    public function setemail($email){
        $this->email = $email;
    }
    public function setpassword($password){
        $this->password = $password;
    }

    public function listarpaciente(){
        $stmt = $this->pdo->query("SELECT * FROM paciente");
        return $stmt-> fetchALL(PDO::FETCH_ASSOC);
    }
    public function obtenerpaciente($id){
        $stmt = $this->pdo->prepare("SELECT * FROM paciente WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function crearpaciente(){
        $stmt=$this->pdo->prepare("INSERT INTO paciente (nombre,apellido,cedula,telefono,fecha_nacimiento,genero,direccion,ciudad,pais,email,password) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$this->nombre,$this->apellido,$this->cedula,$this->telefono,$this->fecha_nacimiento,$this->genero,$this->direccion,$this->ciudad,$this->pais,$this->email,$this->password]);
    }
    public function actualizarpaciente(){
        $stmt = $this->pdo->prepare("UPDATE paciente SET nombre = ?, apellido = ?, cedula = ?, telefono = ?, fecha_nacimiento = ?, genero = ?, direccion = ?, ciudad = ?, pais = ?, email = ?, password = ? WHERE id = ?");
    // 5 parámetros en el orden correcto, ID al final para el WHERE
    $stmt->execute([$this->nombre,$this->apellido, $this->cedula, $this->telefono, $this->fecha_nacimiento, $this->genero, $this->direccion, $this->ciudad, $this->pais, $this->email, $this->password, $this->id]);
    }
    public function eliminarpaciente($id){
        $stmt=$this->pdo->prepare("DELETE FROM paciente WHERE id=?");
        $stmt->execute([$id]);
    }
}
?>