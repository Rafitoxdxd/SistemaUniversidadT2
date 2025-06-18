<?php
require_once BASE_PATH . 'Config/conexion.php';

class TestModel extends Conexion {
    // Atributos privados para encapsulación
    private $id;
    private $id_paciente;
    private $fecha;
    private $deporte;
    private $edad;
    private $respuestas;
    private $parte1;
    private $parte2;
    private $pdo;

    public function __construct() {
        if (Conexion::getConexion() == null) {
            Conexion::conectar();
        }
        $this->pdo = Conexion::getConexion();
    }

    // Métodos Getter
    public function getId() {
        return $this->id;
    }

    public function getIdPaciente() {
        return $this->id_paciente;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getDeporte() {
        return $this->deporte;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getRespuestas() {
        return $this->respuestas;
    }

    public function getParte1() {
        return $this->parte1;
    }

    public function getParte2() {
        return $this->parte2;
    }

    // Métodos Setter
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setIdPaciente($id_paciente) {
        $this->id_paciente = $id_paciente;
        return $this;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
        return $this;
    }

    public function setDeporte($deporte) {
        $this->deporte = $deporte;
        return $this;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
        return $this;
    }

    public function setRespuestas($respuestas) {
        $this->respuestas = $respuestas;
        return $this;
    }

    public function setParte1($parte1) {
        $this->parte1 = $parte1;
        return $this;
    }

    public function setParte2($parte2) {
        $this->parte2 = $parte2;
        return $this;
    }

    // Métodos públicos para operaciones CRUD
    public function obtenerTestsPorPaciente($id_paciente) {
        $tests = [];
        
        // Obtener tests POMS
        $tests['poms'] = $this->obtenerTestsPorTipo('poms', $id_paciente);
        
        // Obtener tests Confianza
        $tests['confianza'] = $this->obtenerTestsPorTipo('confianza', $id_paciente);
        
        // Obtener tests Importancia
        $tests['importancia'] = $this->obtenerTestsPorTipo('importancia', $id_paciente);
        
        return $tests;
    }

    public function crearTestPoms($id_paciente, $fecha, $deporte, $edad, $respuestas) {
        $this->setIdPaciente($id_paciente)
             ->setFecha($fecha)
             ->setDeporte($deporte)
             ->setEdad($edad)
             ->setRespuestas($respuestas);

        // Asegurar que las respuestas sean numéricas
        $respuestasFormateadas = [];
        foreach ($this->getRespuestas() as $key => $value) {
            $respuestasFormateadas[$key] = (int)$value;
        }

        $stmt = $this->pdo->prepare("INSERT INTO test_poms (id_paciente, fecha, deporte, edad, respuestas) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $this->getIdPaciente(),
            $this->getFecha(),
            $this->getDeporte(),
            $this->getEdad(),
            json_encode($respuestasFormateadas, JSON_PRETTY_PRINT)
        ]);
    }

    public function crearTestConfianza($id_paciente, $fecha, $respuestas, $edad = null) {
        $this->setIdPaciente($id_paciente)
             ->setFecha($fecha)
             ->setRespuestas($respuestas)
             ->setEdad($edad);

        // Asegurar que las respuestas sean numéricas
        $respuestasFormateadas = [];
        foreach ($this->getRespuestas() as $key => $value) {
            $respuestasFormateadas[$key] = (int)$value;
        }

        $stmt = $this->pdo->prepare("INSERT INTO test_confianza (id_paciente, edad, fecha, respuestas) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $this->getIdPaciente(),
            $this->getEdad(),
            $this->getFecha(),
            json_encode($respuestasFormateadas, JSON_PRETTY_PRINT)
        ]);
    }

    public function crearTestImportancia($id_paciente, $fecha, $parte1, $parte2, $edad = null) {
        $this->setIdPaciente($id_paciente)
             ->setFecha($fecha)
             ->setParte1($parte1)
             ->setParte2($parte2)
             ->setEdad($edad);

        // Asegurar que las respuestas sean numéricas
        $parte1Formateada = [];
        $parte2Formateada = [];
        
        foreach ($this->getParte1() as $key => $value) {
            $parte1Formateada[$key] = (int)$value;
        }
        
        foreach ($this->getParte2() as $key => $value) {
            $parte2Formateada[$key] = (int)$value;
        }

        $stmt = $this->pdo->prepare("INSERT INTO test_importancia (id_paciente, edad, fecha, parte1, parte2) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $this->getIdPaciente(),
            $this->getEdad(),
            $this->getFecha(),
            json_encode($parte1Formateada, JSON_PRETTY_PRINT),
            json_encode($parte2Formateada, JSON_PRETTY_PRINT)
        ]);
    }
    public function obtenerTest($tipo, $id) {
        $tabla = "test_" . strtolower($tipo);
        $stmt = $this->pdo->prepare("SELECT * FROM $tabla WHERE id = ?");
        $stmt->execute([$id]);
        $test = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($test) {
            $this->mapearDatosTest($test, $tipo);
            return $this->getDatosTest();
        }
        
        return null;
    }

    public function obtenerTestConPaciente($tipo, $id) {
        $tabla = "test_" . strtolower($tipo);
        
        $sql = "SELECT t.*, p.nombre, p.apellido, p.cedula, p.telefono, p.fecha_nacimiento, p.genero 
                FROM $tabla t
                JOIN paciente p ON t.id_paciente = p.id_paciente
                WHERE t.id = ?";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $test = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($test) {
            $this->mapearDatosTest($test, $tipo);
            $datosTest = $this->getDatosTest();
            $datosTest['paciente'] = $this->obtenerInfoPaciente($this->getIdPaciente());
            return $datosTest;
        }
        
        return null;
    }

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

    public function eliminarTest($tipo, $id) {
        $tabla = "test_" . strtolower($tipo);
        $stmt = $this->pdo->prepare("DELETE FROM $tabla WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function obtenerPacientesParaSelect() {
        $stmt = $this->pdo->query("SELECT id_paciente, nombre, apellido FROM paciente ORDER BY apellido, nombre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Métodos privados para encapsular lógica interna
    private function obtenerTestsPorTipo($tipo, $id_paciente) {
        $tabla = "test_" . strtolower($tipo);
        $stmt = $this->pdo->prepare("SELECT * FROM $tabla WHERE id_paciente = ?");
        $stmt->execute([$id_paciente]);
        $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Decodificar respuestas JSON para cada test
        foreach ($tests as &$test) {
            if (isset($test['respuestas'])) {
                $test['respuestas'] = json_decode($test['respuestas'], true);
            }
            if (isset($test['parte1'])) {
                $test['parte1'] = json_decode($test['parte1'], true);
            }
            if (isset($test['parte2'])) {
                $test['parte2'] = json_decode($test['parte2'], true);
            }
        }
        
        return $tests;
    }

    public function obtenerTodosLosTests() {
        $tests = [];
        $tests['poms'] = $this->obtenerTestsPorTipoTodos('poms');
        $tests['confianza'] = $this->obtenerTestsPorTipoTodos('confianza');
        $tests['importancia'] = $this->obtenerTestsPorTipoTodos('importancia');
        return $tests;
    }

    private function obtenerTestsPorTipoTodos($tipo) {
        $tabla = "test_" . strtolower($tipo);
        $stmt = $this->pdo->query("SELECT * FROM $tabla");
        $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tests as &$test) {
            if (isset($test['respuestas'])) {
                $test['respuestas'] = json_decode($test['respuestas'], true);
            }
            if (isset($test['parte1'])) {
                $test['parte1'] = json_decode($test['parte1'], true);
            }
            if (isset($test['parte2'])) {
                $test['parte2'] = json_decode($test['parte2'], true);
            }
        }
        return $tests;
    }

    private function obtenerInfoPaciente($id_paciente) {
        $stmt = $this->pdo->prepare("SELECT * FROM paciente WHERE id_paciente = ?");
        $stmt->execute([$id_paciente]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function mapearDatosTest($datos, $tipo) {
        $this->setId($datos['id'])
             ->setIdPaciente($datos['id_paciente'])
             ->setFecha($datos['fecha'])
             ->setEdad(isset($datos['edad']) ? $datos['edad'] : null);

        switch($tipo) {
            case 'poms':
                $this->setDeporte($datos['deporte'] ?? null)
                     ->setRespuestas(isset($datos['respuestas']) ? json_decode($datos['respuestas'], true) : []);
                break;
                
            case 'confianza':
                $this->setRespuestas(isset($datos['respuestas']) ? json_decode($datos['respuestas'], true) : []);
                break;
                
            case 'importancia':
                $this->setParte1(isset($datos['parte1']) ? json_decode($datos['parte1'], true) : [])
                     ->setParte2(isset($datos['parte2']) ? json_decode($datos['parte2'], true) : []);
                break;
        }
    }

    private function getDatosTest() {
        return [
            'id' => $this->getId(),
            'id_paciente' => $this->getIdPaciente(),
            'fecha' => $this->getFecha(),
            'deporte' => $this->getDeporte(),
            'edad' => $this->getEdad(),
            'respuestas' => $this->getRespuestas(),
            'parte1' => $this->getParte1(),
            'parte2' => $this->getParte2()
        ];
    }
}
?>