<?php
//llamda al archivo que contiene la clase
//datos, en ella posteriormente se colcora el codigo
//para enlazar a su base de datos
require_once('modelo/datos.php');

//declaracion de la clase usuarios que hereda de la clase datos
//la herencia se declara con la palabra extends y no es mas 
//que decirle a esta clase que puede usar los mismos metodos
//que estan en la clase de dodne hereda (La padre) como sir fueran de el

class personasaj extends datos{
	//el primer paso dentro de la clase
	//sera declarar los atributos (variables) que describen la clase
	//para nostros no es mas que colcoar los inputs (controles) de
	//la vista como variables aca
	//cada atributo debe ser privado, es decir, ser visible solo dentro de la
	//misma clase, la forma de colcoarlo privado es usando la palabra private
	
	private $nombre; //recuerden que en php, las variables no tienen tipo predefinido
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

	
	//Ok ya tenemos los atributos, pero como son privados no podemos acceder a ellos desde fueran
	//por lo que debemos colcoar metodos (funciones) que me permitan leer (get) y colocar (set)
	//valores en ello, esto es  muy mal llamado geters y seters por si alguien se los pregunta
	
	function set_nombre($valor){
		$this->nombre = $valor; //fijencen como se accede a los elementos dentro de una clase
		//this que singnifica esto es decir esta clase luego -> simbolo que indica que apunte
		//a un elemento de this, es decir esta clase
		//luego el nombre del elemento sin el $
	}
	//lo mismo que se hizo para cedula se hace para usuario y clave
	
	function set_edad($valor){
		$this->edad = $valor;
	}
	
	function set_localidad($valor){
		$this->localidad = $valor;
	}
	
	function set_telefono($valor){
		$this->telefono = $valor;
	}
	
	function set_gmail($valor){
		$this->gmail = $valor;
	}
	
	function set_estado_civil($valor){
		$this->estado_civil = $valor;
	}
	function set_profesion($valor){
		$this->profesion = $valor;
	}
	function set_estudios($valor){
		$this->estudios = $valor;
	}
	function set_como_conocio($valor){
		$this->como_conocio = $valor;
	}
	function set_sintomas($valor){
		$this->sintomas = $valor;
	}
	function set_otro_sintomas($valor){
		$this->otro_sintomas = $valor;
	}
	function set_convives($valor){
		$this->convives = $valor;
	}
	function set_cambiarias($valor){
		$this->cambiarias = $valor;
	}
	function set_destacarias($valor){
		$this->destacarias = $valor;
	}
	function set_fortalezas($valor){
		$this->fortalezas = $valor;
	}
	function set_alcohol($valor){
		$this->alcohol = $valor;
	}
	function set_frecuencia1($valor){
		$this->frecuencia1 = $valor;
	}
	function set_fumas($valor){
		$this->fumas = $valor;
	}
	function set_frecuencia2($valor){
		$this->frecuencia2 = $valor;
	}
	function set_sustancia($valor){
		$this->sustancia = $valor;
	}
	function set_frecuencia3($valor){
		$this->frecuencia3 = $valor;
	}
	function set_otro_psicologo($valor){
		$this->otro_psicologo = $valor;
	}
	function set_finalizaste_tratamiento($valor){
		$this->finalizaste_tratamiento = $valor;
	}
	function set_personas_significativas($valor){
		$this->personas_significativas = $valor;
	}
	function set_ayudarte($valor){
		$this->ayudarte = $valor;
	}
	function set_que_conseguir($valor){
		$this->que_conseguir = $valor;
	}
	function set_compromiso($valor){
		$this->compromiso = $valor;
	}
	function set_tiempo($valor){
		$this->tiempo = $valor;
	}
	function set_reflejar($valor){
		$this->reflejar = $valor;
	}

	
	//ahora la misma cosa pero para leer, es decir get
	
	function get_nombre(){
		return $this->nombre;
	}
	function get_edad(){
		return $this->edad;
	}
	function get_localidad(){
		return $this->localidad;
	}
	function get_telefono(){
		return $this->telefono;
	}
	function get_gmail(){
		return $this->gmail;
	}
	function get_estado_civil(){
		return $this->estado_civil;
	}
	function get_profesion(){
		return	$this->profesion;
	}
	function set_estudios(){
		return	$this->estudios;
	}
	function set_como_conocio(){
		return	$this->como_conocio;
	}
	function set_sintomas(){
		return	$this->sintomas;
	}
	function set_otro_sintomas(){
		return	$this->otro_sintomas;
	}
	function set_convives(){
		return	$this->convives;
	}
	function set_cambiarias(){
		return	$this->cambiarias;
	}
	function set_destacarias(){
		return	$this->destacarias;
	}
	function set_fortalezas(){
		return	$this->fortalezas;
	}
	function set_alcohol(){
		return	$this->alcohol;
	}
	function set_frecuencia1(){
		return	$this->frecuencia1;
	}
	function set_fumas(){
		return	$this->fumas;
	}
	function set_frecuencia2(){
		return	$this->frecuencia2;
	}
	function set_sustancia(){
		return	$this->sustancia;
	}
	function set_frecuencia3(){
		return	$this->frecuencia3;
	}
	function set_otro_psicologo(){
		return	$this->otro_psicologo;
	}
	function set_finalizaste_tratamiento(){
		return	$this->finalizaste_tratamiento;
	}
	function set_personas_significativas(){
		return	$this->personas_significativas;
	}
	function set_ayudarte(){
		return	$this->ayudarte;
	}
	function set_que_conseguir(){
		return	$this->que_conseguir;
	}
	function set_compromiso(){
		return	$this->compromiso;
	}
	function set_tiempo(){
		return	$this->tiempo;
	}
	function set_reflejar(){
		return	$this->reflejar;
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
						cedula,
						apellidos,
						nombres,
						fechadenacimiento,
						sexo,
						gradodeinstruccion
						)
						Values(
						'$this->cedula',
						'$this->apellidos',
						'$this->nombres',
						'$this->fechadenacimiento',
						'$this->sexo',
						'$this->gradodeinstruccion'
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
					    cedula = '$this->cedula',
						apellidos = '$this->apellidos',
						nombres = '$this->nombres',
						fechadenacimiento = '$this->fechadenacimiento',
						sexo = '$this->sexo',
						gradodeinstruccion = '$this->gradodeinstruccion'
						where
						cedula = '$this->cedula'
						");
						return "Registro Modificado";
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		else{
			return "Cedula no registrada";
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
							$respuesta = $respuesta.$r['cedula'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['apellidos'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['nombres'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['fechadenacimiento'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['sexo'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['gradodeinstruccion'];
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