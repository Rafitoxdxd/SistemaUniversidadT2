<?php

session_start();
$page = "main";

//session_start();
//$_SESSION["username"] = "test";

//session_destroy();

if (!empty($_GET['page']))
{ $page = $_GET['page']; }

if (is_file("Controller/".$page.".php"))
{ require_once("Controller/".$page.".php"); }
else
{ echo "page not found"; }

?>