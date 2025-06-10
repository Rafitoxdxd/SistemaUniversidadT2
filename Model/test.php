<?php
// Incluye el archivo de configuración de la conexión a la base de datos.
// Se asume que 'BASE_PATH' es una constante definida previamente que apunta
// a la ruta base de la aplicación. Este archivo contiene la clase 'Conexion'
// que gestiona la conexión con la base de datos.
require_once BASE_PATH . 'Config/conexion.php';

/**
 * Clase TestModel
 *
 * Hereda de la clase 'Conexion' y se encarga de todas las operaciones
 * relacionadas con la gestión de tests (POMS, Confianza, Importancia)
 * en la base de datos. Actúa como la capa del Modelo en una arquitectura MVC.
 */
class TestModel extends Conexion {
    // Propiedad privada para almacenar la instancia de PDO (conexión a la base de datos).
    private $pdo;

    /**
     * Constructor de la clase TestModel.
     *
     * Inicializa la conexión a la base de datos. Si la conexión no está activa,
     * la establece y luego obtiene la instancia de PDO para ser utilizada
     * por los métodos de la clase.
     */
    public function __construct() {
        // Verifica si la conexión a la base de datos no ha sido establecida.
        if (Conexion::getConexion() == null) {
            // Si no hay conexión, la establece llamando al método estático 'conectar'.
            Conexion::conectar();
        }
        // Obtiene la instancia de PDO de la conexión establecida.
        $this->pdo = Conexion::getConexion();
    }

    /**
     * Obtiene todos los tests (POMS, Confianza, Importancia) asociados a un paciente específico.
     *
     * @param int $id_paciente El ID del paciente cuyos tests se desean obtener.
     * @return array Un array asociativo que contiene los tests clasificados por tipo (poms, confianza, importancia).
     */
    public function obtenerTestsPorPaciente($id_paciente) {
        // Inicializa un array para almacenar los resultados de los diferentes tipos de tests.
        $tests = [];
        
        // --- Obtener tests POMS ---
        // Prepara la consulta SQL para seleccionar todos los registros de 'test_poms' para el paciente dado.
        $stmt = $this->pdo->prepare("SELECT * FROM test_poms WHERE id_paciente = ?");
        // Ejecuta la consulta, pasando el ID del paciente como parámetro.
        $stmt->execute([$id_paciente]);
        // Almacena todos los resultados obtenidos en el índice 'poms' del array $tests.
        $tests['poms'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // --- Obtener tests Confianza ---
        // Prepara la consulta SQL para seleccionar todos los registros de 'test_confianza'.
        $stmt = $this->pdo->prepare("SELECT * FROM test_confianza WHERE id_paciente = ?");
        // Ejecuta la consulta.
        $stmt->execute([$id_paciente]);
        // Almacena los resultados en el índice 'confianza'.
        $tests['confianza'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // --- Obtener tests Importancia ---
        // Prepara la consulta SQL para seleccionar todos los registros de 'test_importancia'.
        $stmt = $this->pdo->prepare("SELECT * FROM test_importancia WHERE id_paciente = ?");
        // Ejecuta la consulta.
        $stmt->execute([$id_paciente]);
        // Almacena los resultados en el índice 'importancia'.
        $tests['importancia'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Devuelve el array que contiene todos los tests del paciente.
        return $tests;
    }

    /**
     * Crea un nuevo registro para un test POMS en la base de datos.
     *
     * @param int $id_paciente El ID del paciente al que se asocia el test.
     * @param string $fecha La fecha en que se realizó el test (formato YYYY-MM-DD).
     * @param string $deporte El deporte asociado al test POMS.
     * @param int $edad La edad del paciente en el momento del test.
     * @param array $respuestas Un array asociativo o indexado de las respuestas del test POMS.
     * @return bool True si la inserción fue exitosa, false en caso contrario.
     */
    public function crearTestPoms($id_paciente, $fecha, $deporte, $edad, $respuestas) {
        // Prepara la consulta SQL para insertar un nuevo test POMS.
        // Las respuestas se codifican a formato JSON para ser almacenadas como una cadena.
        $stmt = $this->pdo->prepare("INSERT INTO test_poms (id_paciente, fecha, deporte, edad, respuestas) VALUES (?, ?, ?, ?, ?)");
        // Ejecuta la consulta con los parámetros proporcionados.
        return $stmt->execute([$id_paciente, $fecha, $deporte, $edad, json_encode($respuestas)]);
    }

    /**
     * Crea un nuevo registro para un test de Confianza en la base de datos.
     *
     * @param int $id_paciente El ID del paciente.
     * @param string $fecha La fecha del test.
     * @param array $respuestas Un array de las respuestas del test de Confianza.
     * @return bool True si la inserción fue exitosa, false en caso contrario.
     */
    public function crearTestConfianza($id_paciente, $fecha, $respuestas) {
        // Prepara la consulta SQL para insertar un nuevo test de Confianza.
        // Las respuestas se codifican a JSON.
        $stmt = $this->pdo->prepare("INSERT INTO test_confianza (id_paciente, fecha, respuestas) VALUES (?, ?, ?)");
        // Ejecuta la consulta.
        return $stmt->execute([$id_paciente, $fecha, json_encode($respuestas)]);
    }

    /**
     * Crea un nuevo registro para un test de Importancia en la base de datos.
     *
     * @param int $id_paciente El ID del paciente.
     * @param string $fecha La fecha del test.
     * @param array $parte1 Un array de las respuestas de la primera parte del test.
     * @param array $parte2 Un array de las respuestas de la segunda parte del test.
     * @return bool True si la inserción fue exitosa, false en caso contrario.
     */
    public function crearTestImportancia($id_paciente, $fecha, $parte1, $parte2) {
        // Prepara la consulta SQL para insertar un nuevo test de Importancia.
        // Ambas partes de las respuestas se codifican a JSON.
        $stmt = $this->pdo->prepare("INSERT INTO test_importancia (id_paciente, fecha, parte1, parte2) VALUES (?, ?, ?, ?)");
        // Ejecuta la consulta.
        return $stmt->execute([$id_paciente, $fecha, json_encode($parte1), json_encode($parte2)]);
    }

    /**
     * Obtiene un test específico por su tipo y su ID.
     *
     * @param string $tipo El tipo de test ('poms', 'confianza', 'importancia').
     * @param int $id El ID único del test dentro de su tabla.
     * @return array|false Un array asociativo con los datos del test si se encuentra, o false si no.
     */
    public function obtenerTest($tipo, $id) {
        // Construye el nombre de la tabla dinámicamente, asegurando que sea en minúsculas.
        $tabla = "test_" . strtolower($tipo);
        // Prepara la consulta SQL para seleccionar el test por su ID de la tabla correspondiente.
        $stmt = $this->pdo->prepare("SELECT * FROM $tabla WHERE id = ?");
        // Ejecuta la consulta.
        $stmt->execute([$id]);
        // Devuelve la primera fila del resultado como un array asociativo.
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Actualiza un test existente en la base de datos.
     *
     * @param string $tipo El tipo de test a actualizar.
     * @param int $id El ID del test a actualizar.
     * @param array $datos Un array asociativo con los campos y nuevos valores a actualizar.
     * Los arrays dentro de $datos se codificarán a JSON.
     * @return bool True si la actualización fue exitosa, false en caso contrario.
     */
    public function actualizarTest($tipo, $id, $datos) {
        // Construye el nombre de la tabla dinámicamente.
        $tabla = "test_" . strtolower($tipo);
        // Inicializa arrays para los campos a actualizar y sus valores.
        $campos = [];
        $valores = [];
        
        // Itera sobre los datos proporcionados para construir la parte SET de la consulta SQL.
        foreach ($datos as $campo => $valor) {
            // Agrega el nombre del campo con un placeholder (?) al array de campos.
            $campos[] = "$campo = ?";
            // Agrega el valor correspondiente. Si es un array, lo codifica a JSON.
            $valores[] = is_array($valor) ? json_encode($valor) : $valor;
        }
        
        // Agrega el ID del test al final del array de valores para la cláusula WHERE.
        $valores[] = $id;
        // Construye la consulta SQL completa de actualización.
        // implode(', ', $campos) une los elementos del array $campos con ', '.
        $sql = "UPDATE $tabla SET " . implode(', ', $campos) . " WHERE id = ?";
        // Prepara la consulta.
        $stmt = $this->pdo->prepare($sql);
        // Ejecuta la consulta con todos los valores.
        return $stmt->execute($valores);
    }

    /**
     * Elimina un test de la base de datos.
     *
     * @param string $tipo El tipo de test a eliminar.
     * @param int $id El ID del test a eliminar.
     * @return bool True si la eliminación fue exitosa, false en caso contrario.
     */
    public function eliminarTest($tipo, $id) {
        // Construye el nombre de la tabla dinámicamente.
        $tabla = "test_" . strtolower($tipo);
        // Prepara la consulta SQL para eliminar el test.
        $stmt = $this->pdo->prepare("DELETE FROM $tabla WHERE id = ?");
        // Ejecuta la consulta.
        return $stmt->execute([$id]);
    }

    /**
     * Obtiene una lista de pacientes, incluyendo su ID, nombre y apellido,
     * útil para poblar un elemento select (dropdown) en la interfaz de usuario.
     * Los resultados se ordenan por apellido y luego por nombre.
     *
     * @return array Un array de arrays asociativos, cada uno representando un paciente.
     */
    public function obtenerPacientesParaSelect() {
        // Ejecuta una consulta para seleccionar el ID, nombre y apellido de la tabla 'paciente'.
        // La consulta se ordena para una presentación más legible.
        $stmt = $this->pdo->query("SELECT id_paciente, nombre, apellido FROM paciente ORDER BY apellido, nombre");
        // Devuelve todos los resultados como un array de arrays asociativos.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>