<?PHP

class parametros {
	
	/************************************************** Propiedades */
	
	private $funciones;
	private $sesion;
	private $conexion;
	
	private $mensaje;
	private $contacto;
	private $administrador;
	private $psicometrico;
	private $aviso;
	private $agradecimiento;
	
	/************************************************** Constructor */
	
	public function parametros() {
		
		$this->funciones = new funciones();
		$this->sesion = new sesion();
		$this->conexion = new conexion();
		
		$sql = "
				select a.mensaje, a.contacto, a.administrador, a.psicometrico, a.aviso, a.agradecimiento
				from sys_parametros a
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		$registro = $this->conexion->recorrer($tabla);
		
		$this->mensaje = $registro["mensaje"];
		$this->contacto = $registro["contacto"];
		$this->administrador = $registro["administrador"];
		$this->psicometrico = $registro["psicometrico"];
		$this->aviso = $registro["aviso"];
		$this->agradecimiento = $registro["agradecimiento"];
		
	}
	
	/************************************************** Métodos SET */
	
	public function setMensaje($mensaje) {
		$this->mensaje = mysql_real_escape_string($mensaje);
	}
	
	public function setContacto($contacto) {
		$this->contacto = mysql_real_escape_string($contacto);
	}
	
	public function setAdministrador($administrador) {
		$this->administrador = $administrador;
	}
	
	public function setPsicometrico($psicometrico) {
		$this->psicometrico = $psicometrico;
	}
	
	public function setAviso($aviso) {
		$this->aviso = $aviso;
	}
	
	public function setAgradecimiento($agradecimiento) {
		$this->agradecimiento = $agradecimiento;
	}
		
	/************************************************** Métodos GET */
	
	public function getMensaje() {
		return $this->mensaje;
	}
	
	public function getContacto() {
		return $this->contacto;
	}
	
	public function getAdministrador() {
		return $this->administrador;
	}
	
	public function getPsicometrico() {
		return $this->psicometrico;
	}
	
	public function getAviso() {
		return $this->aviso;
	}
	
	public function getAgradecimiento() {
		return $this->agradecimiento;
	}
	
	/*
	** Método Actualizar
	*/
	
	public function Actualizar() {
		
		$resultado = false;
		
		if ($this->mensaje != "" && $this->contacto != "") {
			
			$sql = "
					update sys_parametros set
					mensaje = '%mensaje%',
					contacto = '%contacto%',
					administrador = '%administrador%',
					psicometrico = '%psicometrico%',
					aviso = '%aviso%',
					agradecimiento = '%agradecimiento%'
					
			";
			
			$sql = str_replace("%mensaje%", $this->mensaje, $sql);
			$sql = str_replace("%contacto%", $this->contacto, $sql);
			$sql = str_replace("%administrador%", $this->administrador, $sql);
			$sql = str_replace("%psicometrico%", $this->psicometrico, $sql);
			$sql = str_replace("%aviso%", $this->aviso, $sql);
			$sql = str_replace("%agradecimiento%", $this->agradecimiento, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			}
			
		}
		
		return $resultado;
		
	}

}

?>