<?php

if (is_file("View/".$page.".php"))
{ require_once("View/".$page.".php"); }
else
{ echo "page not found"; }

?>