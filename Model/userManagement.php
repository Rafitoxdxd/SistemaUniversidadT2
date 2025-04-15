<?php
//include("connection.php");

//clase para manejar la conexion con la base de datos
class Usuario
{
    //atributos
    private $id;
    private $cedula;
    private $nombre;
    private $apellido;
    private $correo;
    private $FNacimiento;
    private $genero;
    private $psicologo;

    //NO PRESTAR ATENCION
    //Metodo constructor (en caso de ser necesario)
    /*public function __construct($id, $cedula, $nombre, $apellido, $correo, $fNacimiento, $genero, $psicologo)
    {
        $data["id"] = $id;
        $data["cedula"] = $cedula;
        $data["nombre"] = $nombre;
        $data["apellido"] = $apellido;
        $data["correo"] = $correo;
        $data["fNacimiento"] = $fNacimiento;
        $data["genero"] = $genero;
        $data["psicologo"] = $psicologo;

        //asigna los valores de los parametros a un usuario cuando se crea
        setDatosUsuario(...$data);
    }*/


    public static function registrarUsuario(Usuario $usuario, string $tablename, string $contra)
    {
        $registered = false; //variable para retornar su valor

        //verifica si se ha hecho una conexión con la BD
        //si no hay conexión la crea
        if (Conexion::getConexion() == null)
        { Conexion::conectar(); }

        //almacena la conexion en la variable PDO
        $pdo = Conexion::getConexion();
        
        //almacenar la consulta en una variable
        //eso que esta en values (que si :ci, :name, :mail, etc.) son marcadores
        //los marcadores digamos que son referencias que usaremos luego
        $sql =  "INSERT INTO ". $tablename ." (cedula, name, lastName, mail, password, birthDate, gender) "
        ."VALUES (:ci, :name, :lastname, :mail, :password, :birthdate, :gender)";
        
        //esto simplemente encripta la contraseña que se haya ingresado en el formulario
        $encryptedPass = password_hash($contra, PASSWORD_BCRYPT);

        //prepara la consulta
        //esto básicamente es como guardar la consulta que almacenamos en $sql en una variable sin ejecutarla
        //esto nos permitirá alterar los valores de los marcadores antes de ejecutarla
        $stmt = $pdo->prepare($sql);
        
        //establece los valeres de los marcadores a los que habian en el objeto $usuario
        $stmt->bindParam(':ci', $usuario->getCedula());
        $stmt->bindParam(':name', $usuario->getNombre());
        $stmt->bindParam(':lastname', $usuario->getApellido());
        $stmt->bindParam(':mail', $usuario->getCorreo());
        $stmt->bindParam(':password', $encryptedPass);
        $stmt->bindParam(':birthdate', $usuario->getFNacimiento());
        $stmt->bindParam(':gender', $usuario->getGenero());

        //verifica si ya existia ese usuario en la BD
        //esta consulta sigue el mismo procedimiento de antes
        $verify_sql = "SELECT cedula FROM ". $tablename ." WHERE cedula = :ci"; //guarda la consulta en una variable
        $verify_stmt = $pdo->prepare($verify_sql); //prepara la consulta
        $verify_stmt->bindParam(':ci', $tableData["ci"]); //establece los valores de los marcadores
        $verify_stmt->execute(); //ejecuta la consulta

        //si no hay ningun usuario con esa cedula, ejecuta la primera consulta que se ha preparado
        if (!$verify_stmt->fetch(PDO::FETCH_ASSOC))
        {
            $stmt->execute(); //ejecuta la consulta
            $registered = true;
        }

        //retorna el resultado de la ejecución de la consulta
        return $registered;
    }

    //asigna los valores a la instancia usuario que llame el método
    public function setDatosUsuario($id, $cedula, $nombre, $apellido, $correo, $FNacimiento, $genero)
    {
        $this->id = $id;
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->FNacimiento = $FNacimiento;
        $this->genero = $genero;
    }

    //bueno los métodos son autodescriptivos
    //métodos getter
    //el & hace que el valor que retorne sea la referencia de la variable
    public function &getId() { return $this->id; }
    public function &getCedula() { return $this->cedula; }
    public function &getNombre() { return $this->nombre; }
    public function &getApellido() { return $this->apellido; }
    public function &getCorreo() { return $this->correo; }
    public function &getFNacimiento() { return $this->FNacimiento; }
    public function &getGenero() { return $this->genero; }
    public function &getPsicologo() { return $this->psicologo; }

    //métodos Setter
    public function setId($id) { $this->id = $id; }
    public function setCedula($cedula) { $this->cedula = $cedula; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setApellido($apellido) { $this->apellido = $apellido; }
    public function setCorreo($correo) { $this->correo = $correo; }
    public function setFNacimiento($fNacimiento) { $this->FNacimiento = $fNacimiento; }
    public function setGenero($genero) { $this->genero = $genero; }
    public function setPsicologo($psicologo) { $this->psicologo = $psicologo; }

}

?>
