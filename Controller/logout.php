<?php

if (is_file("Model/".$page.".php"))
{ require_once("Model/".$page.".php"); }

if (is_file("View/main.php"))
{ require_once("View/main.php"); }
else
{ echo "page not found"; }

?>