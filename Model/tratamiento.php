<?php
// Incluye el archivo de configuración de la conexión a la base de datos.
// Se asume que 'Conexion.php' contiene la clase 'Conexion' con métodos para gestionar la conexión PDO.
require_once BASE_PATH . 'Config/conexion.php';

/**
 * Clase Tratamiento
 * Esta clase representa el **Modelo** para la entidad 'Tratamiento'.
 * Hereda de la clase 'Conexion' para acceder a la conexión a la base de datos.
 * Su responsabilidad principal es realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar)
 * sobre la tabla 'tratamientos' en la base de datos.
 */
class Tratamiento extends Conexion {
    // Propiedades privadas que representan los campos de la tabla 'tratamientos'.
    // Aunque declaradas, no se usan directamente para almacenar los datos del objeto,
    // ya que los métodos operan directamente con arrays de datos.
    private $id_tratamiento;
    private $id_paciente;
    private $fecha_creacion;
    private $diagnostico_descripcion;
    private $tratamiento_tipo;
    private $estado_actual;
    private $observaciones;
    private $pdo; // Propiedad para almacenar la instancia de la conexión PDO.

    /**
     * Constructor de la clase Tratamiento.
     * Se llama cuando se crea una nueva instancia de Tratamiento.
     * Establece la conexión a la base de datos a través de la clase padre 'Conexion'.
     */
    public function __construct() {
        // Verifica si ya existe una conexión activa; si no, la crea.
        // Esto evita múltiples conexiones si el método 'conectar' ya se llamó.
        if (Conexion::getConexion() == null) {
            Conexion::conectar();
        }
        // Obtiene la instancia de la conexión PDO ya establecida.
        $this->pdo = Conexion::getConexion();
    }

    /**
     * Obtiene todos los tratamientos de la base de datos.
     * Realiza un JOIN con la tabla 'paciente' para incluir datos del paciente asociado.
     * @return array Un array de arrays asociativos con los datos de los tratamientos, o un array vacío en caso de error.
     */
    public function listarTratamientos() {
        try {
            // Consulta SQL para seleccionar todos los tratamientos y la información relevante del paciente.
            $sql = "SELECT t.*, p.nombre, p.apellido, p.cedula 
                    FROM tratamientos t 
                    JOIN paciente p ON t.id_paciente = p.id_paciente 
                    ORDER BY t.fecha_creacion DESC"; // Ordena por fecha de creación descendente.
            $stmt = $this->pdo->prepare($sql); // Prepara la consulta para su ejecución.
            $stmt->execute(); // Ejecuta la consulta.
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un array asociativo.
        } catch (PDOException $e) {
            // Registra el error en el log del servidor para depuración.
            error_log("Error al listar tratamientos: " . $e->getMessage());
            return []; // Devuelve un array vacío en caso de error.
        }
    }

    /**
     * Obtiene un tratamiento específico por su ID.
     * Realiza un JOIN con la tabla 'paciente' para incluir datos del paciente.
     * @param int $id El ID del tratamiento a obtener.
     * @return array|false Un array asociativo con los datos del tratamiento, o false si no se encuentra o hay un error.
     */
    public function obtenerTratamiento($id) {
        try {
            // Consulta SQL para obtener un tratamiento por su ID, incluyendo datos del paciente.
            $sql = "SELECT t.*, p.nombre, p.apellido, p.cedula 
                    FROM tratamientos t 
                    JOIN paciente p ON t.id_paciente = p.id_paciente 
                    WHERE t.id_tratamiento = ?"; // Uso de un placeholder '?' para el ID.
            $stmt = $this->pdo->prepare($sql); // Prepara la consulta.
            $stmt->execute([$id]); // Ejecuta la consulta, pasando el ID como parámetro seguro.
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve la primera fila encontrada como array asociativo.
        } catch (PDOException $e) {
            error_log("Error al obtener tratamiento: " . $e->getMessage());
            return false; // Devuelve false en caso de error.
        }
    }

    /**
     * Busca tratamientos por un término dado en campos de paciente o tratamiento.
     * Realiza un JOIN con 'paciente' y utiliza la cláusula LIKE para buscar coincidencias.
     * @param string $termino El término de búsqueda.
     * @return array Un array de arrays asociativos con los tratamientos que coinciden, o un array vacío en caso de error.
     */
    public function buscarTratamientos($termino) {
        try {
            // Consulta SQL para buscar tratamientos en varios campos (nombre, apellido, cédula de paciente; estado, fecha de tratamiento).
            $sql = "SELECT t.*, p.nombre, p.apellido, p.cedula 
                    FROM tratamientos t 
                    JOIN paciente p ON t.id_paciente = p.id_paciente 
                    WHERE p.nombre LIKE ? OR p.apellido LIKE ? OR p.cedula LIKE ? 
                    OR t.estado_actual LIKE ? OR t.fecha_creacion LIKE ?
                    ORDER BY t.fecha_creacion DESC";
            $stmt = $this->pdo->prepare($sql); // Prepara la consulta.
            $termino = "%$termino%"; // Añade comodines para la búsqueda LIKE (busca en cualquier parte del texto).
            // Ejecuta la consulta, pasando el término de búsqueda para cada placeholder.
            $stmt->execute([$termino, $termino, $termino, $termino, $termino]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados.
        } catch (PDOException $e) {
            error_log("Error al buscar tratamientos: " . $e->getMessage());
            return []; // Devuelve un array vacío en caso de error.
        }
    }

    /**
     * Inserta un nuevo tratamiento en la base de datos.
     * @param array $data Un array asociativo con los datos del nuevo tratamiento.
     * @return int|false El ID del último registro insertado si es exitoso, o false en caso de error.
     */
    public function crearTratamiento($data) {
        try {
            // Consulta SQL para insertar un nuevo registro en la tabla 'tratamientos'.
            $sql = "INSERT INTO tratamientos 
                    (id_paciente, fecha_creacion, diagnostico_descripcion, tratamiento_tipo, estado_actual, observaciones) 
                    VALUES (?, ?, ?, ?, ?, ?)"; // Uso de placeholders para los valores.
            $stmt = $this->pdo->prepare($sql); // Prepara la consulta.
            // Ejecuta la consulta, mapeando los valores del array $data a los placeholders.
            // Usa el operador '??' para asignar una cadena vacía si 'observaciones' no existe en $data.
            $stmt->execute([
                $data['id_paciente'],
                $data['fecha_creacion'],
                $data['diagnostico_descripcion'],
                $data['tratamiento_tipo'],
                $data['estado_actual'],
                $data['observaciones'] ?? '' // Si no se proporciona, se guarda como vacío.
            ]);
            return $this->pdo->lastInsertId(); // Devuelve el ID generado para el nuevo registro.
        } catch (PDOException $e) {
            error_log("Error al crear tratamiento: " . $e->getMessage());
            return false; // Devuelve false en caso de error.
        }
    }

    /**
     * Actualiza un tratamiento existente en la base de datos.
     * @param int $id El ID del tratamiento a actualizar.
     * @param array $data Un array asociativo con los nuevos datos del tratamiento.
     * @return bool True si la actualización fue exitosa, false en caso de error.
     */
    public function actualizarTratamiento($id, $data) {
        try {
            // Consulta SQL para actualizar un registro existente en la tabla 'tratamientos'.
            $sql = "UPDATE tratamientos SET 
                    id_paciente = ?, 
                    fecha_creacion = ?, 
                    diagnostico_descripcion = ?, 
                    tratamiento_tipo = ?, 
                    estado_actual = ?, 
                    observaciones = ? 
                    WHERE id_tratamiento = ?"; // Uso de placeholders y cláusula WHERE para el ID.
            $stmt = $this->pdo->prepare($sql); // Prepara la consulta.
            // Ejecuta la consulta, mapeando los valores del array $data y el ID al final.
            return $stmt->execute([
                $data['id_paciente'],
                $data['fecha_creacion'],
                $data['diagnostico_descripcion'],
                $data['tratamiento_tipo'],
                $data['estado_actual'],
                $data['observaciones'] ?? '', // Si no se proporciona, no cambia el valor o lo establece a vacío si no existía.
                $id // El ID del tratamiento a actualizar.
            ]);
        } catch (PDOException $e) {
            error_log("Error al actualizar tratamiento: " . $e->getMessage());
            return false; // Devuelve false en caso de error.
        }
    }

    /**
     * Elimina un tratamiento de la base de datos por su ID.
     * @param int $id El ID del tratamiento a eliminar.
     * @return bool True si la eliminación fue exitosa, false en caso de error.
     */
    public function eliminarTratamiento($id) {
        try {
            // Consulta SQL para eliminar un registro de la tabla 'tratamientos' por su ID.
            $sql = "DELETE FROM tratamientos WHERE id_tratamiento = ?"; // Uso de placeholder para el ID.
            $stmt = $this->pdo->prepare($sql); // Prepara la consulta.
            return $stmt->execute([$id]); // Ejecuta la consulta, pasando el ID.
        } catch (PDOException $e) {
            error_log("Error al eliminar tratamiento: " . $e->getMessage());
            return false; // Devuelve false en caso de error.
        }
    }
}
?>