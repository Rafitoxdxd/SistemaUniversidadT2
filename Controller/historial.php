<?php

//llamada al archivo que contiene la clase
//usuarios, en ella estara el codigo que me //permitirá
//guardar, consultar y modificar dentro de mi base //de datos

//lo primero que se debe hacer es verificar al //igual que en la vista que exista el archivo
require_once("Model/historial.php");

//importa la vista de la página
//  Verificar si la sesión está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Carga la vista ANTES de procesar el POST para que la página se muestre
// incluso si no hay envío de formulario.
if (is_file("View/".$pagina.".php")) {
    require_once("View/".$pagina.".php");
} else {
    echo "Error: View file not found."; // Mensaje de error
    exit; // Detener la ejecución si la vista no existe
}

// Ahora, procesa el formulario SI FUE ENVIADO
if(isset($_POST["guardar"])) {

    // directamente sobre $_POST. Es más directo. Usamos $key => $value para obtener tanto el nombre del campo como su valor.
    foreach ($_POST as $key => $value) {
      if ($key === 'guardar') {
        continue; // Salta a la siguiente iteración si la clave es 'guardar'
    }
        // Mostramos el nombre del campo (la clave). Es importante sanitizarla.
        echo "<b>" . htmlspecialchars($key) . ":</b> ";

        // Verificamos si el valor es un array
        if (is_array($value)) {
            // Si es un array (como 'sintoma'), lo convertimos en un string separando los elementos con ", ".

            echo htmlspecialchars(implode(', ', $value));
        } else {

            // Si no es un array (es un string simple), simplemente lo mostramos
            echo htmlspecialchars($value);
        }

        echo "<br>"; // Añadimos un salto de línea para mejor lectura
    }
}

?>
