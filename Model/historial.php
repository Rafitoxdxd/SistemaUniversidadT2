<?php
//llamda al archivo que contiene la clase
//datos, en ella posteriormente se colcora el codigo
//para enlazar a su base de datos
require_once('Model/datos.php');

//declaracion de la clase usuarios que hereda de la clase datos
//la herencia se declara con la palabra extends y no es mas 
//que decirle a esta clase que puede usar los mismos metodos
//que estan en la clase de dodne hereda (La padre) como sir fueran de el

class historial {
	//el primer paso dentro de la clase
	//sera declarar los atributos (variables) que describen la clase
	//para nostros no es mas que colcoar los inputs (controles) de
	//la vista como variables aca
	//cada atributo debe ser privado, es decir, ser visible solo dentro de la
	//misma clase, la forma de colcoarlo privado es usando la palabra private
	
	private $nombre; //recuerden que en php, las variables no tienen tipo predefinido
	private $apellido;
	private $cedula;
	private $edad;
	private $localidad;
	private $telefono;
	private $gmail;
	private $estado_civil;
	private $profesion;
	private $estudios;
	private $como_conocio;
	private $sintomas;
	private $otro_sintomas;
	private $convives;
	private $cambiarias;
	private $destacarias;
	private $fortalezas;
	private $Debilidades;
	private $alcohol;
	private $frecuencia1;
	private $fumas;
	private $frecuencia2;
	private $sustancia;
	private $frecuencia3;
	private $otro_psicologo;
	private $finalizaste_tratamiento;
	private $personas_significativas;
	private $ayudarte;
	private $que_conseguir;
	private $compromiso;
	private $tiempo;
	private $reflejar;
	
	//getter y setter para propiedades
	public function __get($name) {
		if ($name == 'myProperty') { return $this->myProperty; }
	}
		
	public function __set($name, $value) {
		if ($name == 'myProperty') { $this->myProperty = $value; }
	}
	
	
	//Lo siguiente que demos hacer es crear los metodos para incluir, consultar y eliminar
	
	function incluir(){
		//Ok ya tenemos la base de datos y la funcion conecta dentro de la clase
		//datos, ahora debemos ejecutar las operaciones para realizar las consultas 
		
		//Lo primero que debemos hacer es consultar por el campo clave
		//en este caso la cedula, para ello se creo la funcion existe
		//que retorna true en caso de exitir el registro
		
		if(!$this->existe($this->cedula)){
			//si estamos aca es porque la cedula no existe es decir se puede incluir
			//los pasos a seguir son
			//1 Se llama a la funcion conecta 
			$co = $this->conecta();
			$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//2 Se ejecuta el sql
			try {
					$co->query("Insert into personas(
						nombre,
						cedula,
						edad,
						localidad,
						telefono,
						gmail,
						estado_civil,
						profesion,
						estudios,
						como_conocio,
						sintomas,
						otro_sintomas,
						convives,
						cambiarias,
						destacarias,
						fortalezas,
						Debilidades,
						alcohol,
						frecuencia1,
						fumas,
						frecuencia2,
						sustancia,
						frecuencia3,
						otro_psicologo,
						finalizaste_tratamiento,
						personas_significativas,
						ayudarte,
						que_conseguir,
						compromiso,
						tiempo,
						reflejar
						)
						Values(
						'$this-> nombre',
						'$this-> cedula',
						'$this->  edad',
						'$this->  localidad',
						'$this->  telefono',
						'$this->  gmail',
						'$this->  estado_civil',
						'$this->  profesion',
						'$this->  estudios',
						'$this->  como_conocio',
						'$this->  sintomas',
						'$this->  otro_sintomas',
						'$this->  convives',
						'$this->  cambiarias',
						'$this->  destacarias',
						'$this->  fortalezas',
						'$this->  Debilidades',
						'$this->  alcohol',
						'$this->  frecuencia1',
						'$this->  fumas',
						'$this->  frecuencia2',
						'$this->  sustancia',
						'$this->  frecuencia3',
						'$this->  otro_psicologo',
						'$this->  finalizaste_tratamiento',
						'$this->  personas_significativas',
						'$this->  ayudarte',
						'$this->  que_conseguir',
						'$this->  compromiso',
						'$this->  tiempo',
						'$this-> reflejar'

						)");
						return "Registro incluido";
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		else{
			return "Ya existe la cedula que desea ingresar";
		}
		
		//Listo eso es todo y es igual para el resto de las operaciones
		//incluir, modificar y eliminar
		//solo cambia para buscar
	}
	
	function modificar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if($this->existe($this->cedula)){
			try {
					$co->query("Update personas set

						nombre= '$this-> nombre',
						cedula= '$this-> cedula',
						edad= '$this->  edad',
						localidad= '$this->  localidad',
						telefono= '$this->  telefono',
						gmail= '$this->  gmail',
						estado_civil= '$this->  estado_civil',
						profesion'$this->  profesion',
						estudios= '$this->  estudios',
						como_conocio= '$this->  como_conocio',
						sintomas= '$this->  sintomas',
						otro_sintomas= '$this->  otro_sintomas',
						convives= '$this->  convives',
						cambiarias= '$this->  cambiarias',
						destacarias= '$this->  destacarias',
						fortalezas= '$this->  fortalezas',
						Debilidades= '$this->  Debilidades',
						alcohol= '$this->  alcohol',
						frecuencia1= '$this->  frecuencia1',
						fumas= '$this->  fumas',
						frecuencia2= '$this->  frecuencia2',
						sustancia= '$this->  sustancia',
						frecuencia3= '$this->  frecuencia3',
						otro_psicologo= '$this->  otro_psicologo',
						finalizaste_tratamiento= '$this->  finalizaste_tratamiento',
						personas_significativas= '$this->  personas_significativas',
						ayudarte= '$this->  ayudarte',
						que_conseguir= '$this->  que_conseguir',
						compromiso= '$this->  compromiso',
						tiempo= '$this->  tiempo',
						reflejar= '$this-> reflejar'
					   
						");
						return "Registro Modificado";
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		else{
			return "Registro no modificado";
		}
		
	}
	
	function eliminar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if($this->existe($this->cedula)){
			try {
					$co->query("delete from personas 
						where
						cedula = '$this->cedula'
						");
						return "Registro Eliminado";
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		else{
			return "Cedula no registrada";
		}
	}
	
	
	function consultar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			
			$resultado = $co->query("Select * from personas");
			
			if($resultado){
				
				$respuesta = '';
				foreach($resultado as $r){
					$respuesta = $respuesta."<tr style='cursor:pointer' onclick='coloca(this);'>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['nombre'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['cedula'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['edad'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['localidad'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['telefono'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['gmail'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['estado_civil'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['profesion'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['estudios'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['como_conocio'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['sintomas'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['otro_sintomas'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['convives'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['cambiarias'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['destacarias'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['fortalezas'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
						$respuesta = $respuesta.$r['Debilidades'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['alcohol'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['frecuencia1'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['fumas'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['frecuencia2'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['sustancia'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['frecuencia3'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['otro_psicologo'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['finalizaste_tratamiento'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['personas_significativas'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['ayudarte'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['que_conseguir'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['compromiso'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['tiempo'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
							$respuesta = $respuesta.$r['reflejar'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."</tr>";
				}
				return $respuesta;
			    
			}
			else{
				return '';
			}
			
		}catch(Exception $e){
			return $e->getMessage();
		}
		
	}
	
	
	private function existe($cedula){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			
			$resultado = $co->query("Select * from personas where cedula='$cedula'");
			
			
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if($fila){

				return true;
			    
			}
			else{
				
				return false;;
			}
			
		}catch(Exception $e){
			return false;
		}
	}
	
	function consultatr(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			
			$resultado = $co->query("Select * from personas where cedula='$this->cedula'");
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if($fila){
			    
				$envia = array('resultado'=>"encontro");
				
				$envia += $fila;
								
				return json_encode($envia);
			    
			}
			else{
				
				$envia = array('resultado'=>"noencontro");
				return json_encode($envia);
				
				
			}
			
		}catch(Exception $e){
			$envia = array('resultado'=>$e->getMessage());
			return json_encode($envia);
		}
		
	}
	
	function obtienefecha(){
		$f = date('Y-m-d');
		$f1 = strtotime ('-18 year' , strtotime($f)); 
		$f1 = date ('Y-m-d',$f1);
		return $f1;
	}

	
	
}
?>