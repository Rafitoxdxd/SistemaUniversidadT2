<?php

if (!isset($_SESSION["name"]))
{ $page = "main"; }

if (is_file("View/".$page.".php"))
{ require_once("View/".$page.".php"); }
else
{ echo "page not found"; }

if (is_file("Model/".$page.".php"))
{ require_once("Model/".$page.".php"); }

?>