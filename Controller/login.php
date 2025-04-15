<?php

//verifica si hay una sesión activa
//si es el caso, no tiene sentido meterse en el login
//por lo que redirige a la página principal
if (isset($_SESSION["usuario"]))
{ $pagina = "main"; }

//importa la vista de la página
if (is_file("View/".$pagina.".php"))
{ require_once("View/".$pagina.".php"); }
else
{ echo "page not found"; }

//importa el modelo de la página
if (is_file("Model/".$pagina.".php"))
{ require_once("Model/".$pagina.".php"); }

?>