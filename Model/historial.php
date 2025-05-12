<?php
require_once BASE_PATH . ('Config/conexion.php');

class Historial {
	
	private $ID;
	private $datos;
	private $idPaciente;
	private $idPsicologo;

	public static function eliminarHistorial($id)
	{
		//si no hay conexión la crea
        if (Conexion::getConexion() == null)
        { Conexion::conectar(); }

		//almacena la conexion en la variable PDO
        $pdo = Conexion::getConexion();

		//almacenar la consulta en una variable
        $sql = "DELETE FROM history WHERE ID = :id";

		//prepara la consulta
        //esto básicamente es como guardar la consulta que almacenamos en $sql en una variable sin ejecutarla
        //esto nos permitirá alterar los valores de los marcadores antes de ejecutarla
        $stmt = $pdo->prepare($sql);

		//establece los valeres de los marcadores a los que habian en el objeto $historial
		$stmt->bindParam(':id', $id);

		//ejecuta la consulta
        $stmt->execute();
	}

	public static function cargarHistoriales()
	{
		$historiales = null; //variable para retornar su valor

		//verifica si se ha hecho una conexión con la BD
        //si no hay conexión la crea
        if (Conexion::getConexion() == null)
        { Conexion::conectar(); }

		//almacena la conexion en la variable PDO
        $pdo = Conexion::getConexion();

		//almacenar la consulta en una variable
        $sql = "SELECT * FROM history";
		//prepara la consulta
        $stmt = $pdo->prepare($sql);
		//ejecuta la consulta
        $stmt->execute();
		
		//obtiene los resultados de la consulta, devolverá los datos del usuario si existe, si no, será null
		$historiales = $stmt->fetchAll(PDO::FETCH_BOTH);

		$instHistoriales = array();
		
		for ($i = 0; $i < count($historiales); $i++)
		{
			$instancia = new Historial();

			$instancia->setDatosHistorial(
				$historiales[$i]["ID"],
				$historiales[$i]["datos"],
				$historiales[$i]["idPaciente"],
				$historiales[$i]["idPsicologo"]
			);

			$instHistoriales[$i] = $instancia;
		}

		return $instHistoriales;
	}

	public static function registrarHistorial(Historial $historial)
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
        $sql =  "INSERT INTO history (datos, idPaciente, idPsicologo) "
        ."VALUES (:datos, :idPaciente, :idPsicologo)";

		//prepara la consulta
        //esto básicamente es como guardar la consulta que almacenamos en $sql en una variable sin ejecutarla
        //esto nos permitirá alterar los valores de los marcadores antes de ejecutarla
        $stmt = $pdo->prepare($sql);

		//establece los valeres de los marcadores a los que habian en el objeto $historial
		$stmt->bindParam(':datos', $historial->datos);
		$stmt->bindParam(':idPaciente', $historial->idPaciente);
		$stmt->bindParam(':idPsicologo', $historial->idPsicologo);
		
		/*
		//verifica si ya existia ese historial en la BD
        //esta consulta sigue el mismo procedimiento de antes
        $verify_sql = "SELECT datos FROM history"; //guarda la consulta en una variable
        $verify_stmt = $pdo->prepare($verify_sql); //prepara la consulta
		$verify_stmt->execute(); //ejecuta la consulta
		$verifyData = $verify_stmt->fetch(PDO::FETCH_ASSOC);
		*/

		if ($stmt->execute()) //ejecuta la consulta)
        { $registered = true; }

		//retorna el resultado de la ejecución de la consulta
        return $registered;
	}
	
	public function setDatosHistorial($ID, $datos, $idPaciente, $idPsicologo)
	{
		$this->ID = $ID;
		$this->datos = $datos;
		$this->idPaciente = $idPaciente;
		$this->idPsicologo = $idPsicologo;
	}

	//metodos getter
	public function getID() { return $this->ID; }
	public function getDatos() { return $this->datos; }
	public function getIdPaciente() { return $this->idPaciente; }
	public function getIdPsicologo() { return $this->idPsicologo; }

	//metodos setter
	public function setID($ID) { $this->ID = $ID; }
	public function setDatos($datos) { $this->datos = $datos; }
	public function setIdPaciente($idPaciente) { $this->idPaciente = $idPaciente; }
	public function setIdPsicologo($idPsicologo) { $this->idPsicologo = $idPsicologo; }
}
?>