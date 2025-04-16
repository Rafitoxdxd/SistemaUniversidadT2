<?php
  
//llamada al archivo que contiene la clase
//usuarios, en ella estara el codigo que me //permitirá
//guardar, consultar y modificar dentro de mi base //de datos


//lo primero que se debe hacer es verificar al //igual que en la vista que exista el archivo
if (!is_file("Model/".$pagina.".php")){
	//alli pregunte que si no es archivo se niega //con !
	//si no existe envio mensaje y me salgo
	echo "Falta definir la clase ".$pagina;
	exit;
}  
require_once("Model/".$pagina.".php");  
  if(is_file("View/".$pagina.".php")){
	  
	  //bien si estamos aca es porque existe la //vista y la clase
	  //por lo que lo primero que debemos hace es //realizar una instancia de la clase
	  //instanciar es crear una variable local, //que contiene los metodos de la clase
	  //para poderlos usar
	  
	  
	  $o = new historial(); //ahora nuestro objeto //se llama $o y es una copia en memoria de la
	  //clase personasht
	  
	  if(!empty($_POST)){
		  
		  //como ya sabemos si estamos aca es //porque se recibio alguna informacion
		  //de la vista, por lo que lo primero que //debemos hacer ahora que tenemos una 
		  //clase es guardar esos valores en ella //con los metodos set
		  $accion = $_POST['accion'];
		  $o->set_nombre($_POST['nombre']);
		  $o->set_apellido($_POST['apellido']);
          $o->set_cedula($_POST['cedula']);
		  $o->set_edad($_POST['edad']);
          $o->set_telefono($_POST['telefono']);
		  $o->set_localidad($_POST['localidad']);
          $o->set_email($_POST['gmail']);
          $o->set_estado_civil($_POST['estado_civil']);
          $o->set_profesion($_POST['profesion']);
          $o->set_estudios($_POST['estudios']);
          $o->set_como_conocio($_POST['como_conocio']);
          $o->set_sistomas($_POST['sistomas']);
          $o->set_otros_sistomas($_POST['otros_sistomas']);
          $o->set_convives($_POST['convives']);
          $o->set_cambiarias($_POST['cambiarias']);
          $o->set_destacarias($_POST['destacarias']);
		  $o->set_fortalezas($_POST['fortalezas']);
          $o->set_alcohol($_POST['alcohol']);
          $o->set_frecuencia1($_POST['frecuencia1']);
          $o->set_fumas($_POST['fumas']);
          $o->set_frecuencia2($_POST['frecuencia2']);
          $o->set_sustancia($_POST['sustacia']);
          $o->set_frecuencia3($_POST['frecuencia3']);
          $o->set_otro_psicologo($_POST['otro_psicologo']);
          $o->set_finalizaste_tratamiento($_POST['finalizaste_tratamiento']);
          $o->set_personas_significativas($_POST['personas_significativas']);
          $o->set_ayudarte($_POST['ayudarte']);
          $o->set_que_conseguir($_POST['que_conseguir']);
          $o->set_compromiso($_POST['compromiso']);
          $o->set_tiempo($_POST['tiempo']);
          $o->set_reflejar($_POST['reflejar']);

          if(isset($_POST['incluir'])){
			$mensaje =  $o->incluir();
		  }
		  elseif(isset($_POST['modificar'])){
			$mensaje =  $o->modificar();
			
		  }
		  elseif(isset($_POST['eliminar'])){
			$mensaje =  $o->eliminar();
			
		  }
	  };
	  
	  require_once("vista/".$pagina.".php"); 
  }
  else{
	  echo "pagina en construccion";
  }
?>