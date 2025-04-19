<?php
  
//llamada al archivo que contiene la clase
//usuarios, en ella estara el codigo que me //permitirá
//guardar, consultar y modificar dentro de mi base //de datos


//lo primero que se debe hacer es verificar al //igual que en la vista que exista el archivo
require_once("Model/historial.php"); 

//importa la vista de la página
if (is_file("View/".$pagina.".php"))
{ require_once("View/".$pagina.".php"); }
else
{ echo "page not found"; }

if(is_file("View/".$pagina.".php")){
}
else{
  echo "pagina en construccion";
}

if ($_POST["guardar"])
{
  $jsonEnc = json_encode($_POST);
  $jsArray = json_decode($jsonEnc, false);

  foreach($jsArray as $val)
  {
    echo "$val <br>";
  }
}

?>