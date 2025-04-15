<?php

if (!isset($_SESSION["usuario"]))
{ $pagina = "main"; }

if (is_file("View/".$pagina.".php"))
{ require_once("View/".$pagina.".php"); }
else
{ echo "page not found"; }

if (is_file("Model/".$pagina.".php"))
{ require_once("Model/".$pagina.".php"); }

?>