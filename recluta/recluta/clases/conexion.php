<?PHP

class conexion {
	
	/*
	** Propiedades
	*/
	
	private $conexion;
	private $error;
	
	private $funciones;
	private $sesion;
	
	/*
	** Constructor
	*/

	public function conexion() {  
		
		$this->funciones = new funciones();
		
		if ($_SERVER["HTTP_HOST"] != "localhost") {
			
			/*
			$servidor["equipo"] = "localhost";
			$servidor["usuario"] = "oma_recluta";
			$servidor["password"] = "oma_reclutapass";
			$servidor["base"] = "oma_recluta";
			*/
			
			$servidor["equipo"] = "localhost";
			$servidor["usuario"] = "kriosof1";
			$servidor["password"] = "Futbol0192#";
			$servidor["base"] = "kriosof1_omarecluta";
			
		} else {
			
			$servidor["equipo"] = "localhost";
			$servidor["usuario"] = "oma_recluta";
			$servidor["password"] = "oma_reclutapass";
			$servidor["base"] = "oma_recluta";
			
		}
		
		/* Localhost */
		/*$servidor["equipo"] = "localhost";
		$servidor["usuario"] = "oma_recluta";
		$servidor["password"] = "oma_reclutapass";
		$servidor["base"] = "oma_recluta";*/
		
		/* Servidor Kriosoft */
		$servidor["equipo"] = "localhost";
		$servidor["usuario"] = "kriosof1";
		$servidor["password"] = "Futbol0192#";
		$servidor["base"] = "kriosof1_omarecluta";
				
		if (!isset($this->conexion)) {  
			$this->conexion = (mysql_connect($servidor["equipo"], $servidor["usuario"], $servidor["password"])) or die(mysql_error());  
			mysql_select_db($servidor["base"], $this->conexion) or die(mysql_error());  
  		}
		
	}  
	
	/*
	** Propiedads GET
	*/
		
	public function getError() {
		return $this->error;
	}
	
	/*
	** Método Consultar
	*/

	public function Consultar($sql) {
		
		$resultado = mysql_query($sql, $this->conexion);  
		
		if(!$resultado){  
			
			$this->error = mysql_error();
			
			/* Registrar error */
			
			$instante = $this->funciones->getFechaHora();
			$error = mysql_real_escape_string($this->error);
			$sentencia = mysql_real_escape_string($sql);
			
			$sql = "
					insert into sys_errores(instante, error, sentencia)
					values ('%instante%', '%error%', '%sentencia%')
			";
			
			$sql = str_replace("%instante%", $instante, $sql);
			$sql = str_replace("%error%", $error, $sql);
			$sql = str_replace("%sentencia%", $sentencia, $sql);
			
			//die($sql);
			
			mysql_query($sql, $this->conexion);
			
		}
		
		return $resultado;
	}
	
	/*
	** Método Ejecutar
	*/
	
	public function Ejecutar($sentencia, $auditoria = true) {
		
		if (!(mysql_query($sentencia, $this->conexion))) {
			
			$this->error = mysql_error();
			
			/* Registrar error */
			
			$instante = $this->funciones->getFechaHora();
			$error =mysql_real_escape_string($this->error);
			$sentencia = mysql_real_escape_string($sentencia);
			
			$sql = "
					insert into sys_errores(instante, error, sentencia)
					values ('%instante%', '%error%', '%sentencia%')
			";
			
			$sql = str_replace("%instante%", $instante, $sql);
			$sql = str_replace("%error%", $error, $sql);
			$sql = str_replace("%sentencia%", $sentencia, $sql);
			
			//die($sql);
			
			mysql_query($sql, $this->conexion);
			
			return false;
			
		} else {		
			return true;
		}

		exit; 
		
	}
	
	/*
	** Método Recorrer
	*/
	
	public function Recorrer($consulta) {
		return mysql_fetch_array($consulta);
	}
	
	/*
	** Método Lineas
	*/
	
	public function Lineas($consulta) {   
		return mysql_num_rows($consulta);  
	}
	
}

?>