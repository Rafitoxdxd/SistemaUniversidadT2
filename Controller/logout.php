<?php

//importa el modelo de la página
if (is_file("Model/".$pagina.".php"))
{ require_once("Model/".$pagina.".php"); }

//redirige a la página principal
if (is_file("View/main.php"))
{ require_once("View/main.php"); }
else
{ echo "page not found"; }

?>