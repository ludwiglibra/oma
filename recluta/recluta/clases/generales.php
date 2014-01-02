<?PHP

class generales {
	
	/*
	** Propiedades
	*/
	
	private $funciones;
	private $conexion;
	
	private $usuario;
	private $nombres;
	private $apellidos;
	private $prefcelular;
	private $celular;
	private $preffijo;
	private $fijo;
	private $nacionalidad;
	private $nacimiento;
	private $genero;
	private $civil;
	private $dependientes;
	private $domicilio;
	
	/*
	** Constructor
	*/
	
	public function generales() {
		
		$this->funciones = new funciones();
		$this->conexion = new conexion();
		
	}
	
	/*
	** Métodos SET
	*/
	
	public function setUsuario($usuario) {
		$this->usuario = mysql_real_escape_string($usuario);
	}
	
	public function setNombres($nombres) {
		$this->nombres = mysql_real_escape_string($nombres);
	}
	
	public function setApellidos($apellidos) {
		$this->apellidos = mysql_real_escape_string($apellidos);
	}
	
	public function setPrefcelular($prefcelular) {
		$this->prefcelular = $prefcelular;
	}
	
	public function setCelular($celular) {
		$this->celular = $celular;
	}
	
	public function setPreffijo($preffijo) {
		$this->preffijo = $preffijo;
	}
	
	public function setFijo($fijo) {
		$this->fijo = $fijo;
	}
	
	public function setNacionalidad($nacionalidad) {
		$this->nacionalidad = $nacionalidad;
	}
	
	public function setNacimiento($nacimiento) {
		$this->nacimiento = $nacimiento;
	}
	
	public function setGenero($genero) {
		$this->genero = $genero;
	}
	
	public function setCivil($civil) {
		$this->civil = $civil;
	}
	
	public function setDependientes($dependientes) {
		$this->dependientes = $dependientes;
	}
	
	public function setDomicilio($domicilio) {
		$this->domicilio = $domicilio;
	}
	
	/*
	** Métodos GET
	*/
	
	public function getUsuario() {
		return $this->usuario;
	}
	
	public function getNombres() {
		return $this->nombres;
	}
	
	public function getApellidos() {
		return $this->apellidos;
	}
	
	public function getPrefcelular() {
		return $this->prefcelular;
	}
	
	public function getCelular() {
		return $this->celular;
	}
	
	public function getPreffijo() {
		return $this->preffijo;
	}
	
	public function getFijo() {
		return $this->fijo;
	}
	
	public function getNacionalidad() {
		return $this->nacionalidad;
	}
	
	public function getNacimiento() {
		if ($this->nacimiento != "0000-00-00") {
			return $this->nacimiento;
		} else {
			return "";
		}
	}
	
	public function getGenero() {
		return $this->genero;
	}
	
	public function getCivil() {
		return $this->civil;
	}
	
	public function getDependientes() {
		return $this->dependientes;
	}
	
	public function getDomicilio() {
		return $this->domicilio;
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($usuario) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from sys_generales a
				where a.usuario = '%usuario%'
		";
		
		$sql = str_replace("%usuario%", $usuario, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) > 0) {
			$salida = true;
		}
		
		return $salida;
		
	}
	
	/*
	** Método Cargar
	*/
	
	public function Cargar() {
		
		if ($this->usuario != "") {
			
			$sql = "
					select a.usuario, a.nombres, a.apellidos, a.prefcelular, a.celular, a.preffijo, a.fijo, a.nacionalidad, a.nacimiento, a.genero, a.civil, a.dependientes, a.domicilio
					from sys_generales a
					where a.usuario = '%usuario%'
			";
			
			$sql = str_replace("%usuario%", $this->usuario, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->nombres = $registro["nombres"];
			$this->apellidos = $registro["apellidos"];
			$this->prefcelular = $registro["prefcelular"];
			$this->celular = $registro["celular"];
			$this->preffijo = $registro["preffijo"];
			$this->fijo = $registro["fijo"];
			$this->nacionalidad = $registro["nacionalidad"];
			$this->nacimiento = $registro["nacimiento"];
			$this->genero = $registro["genero"];
			$this->civil = $registro["civil"];
			$this->dependientes = $registro["dependientes"];
			$this->domicilio = $registro["domicilio"];
			
		}
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
		
		if ($this->usuario != "") {
			
			$sql = "
					insert into sys_generales (usuario, nombres, apellidos, prefcelular, celular, preffijo, fijo, nacionalidad, nacimiento, genero, civil, dependientes, domicilio)
					values ('%usuario%', '%nombres%', '%apellidos%', '%prefcelular%','%celular%', '%preffijo%', '%fijo%', '%nacionalidad%', '%nacimiento%', '%genero%', '%civil%', '%dependientes%', '%domicilio%')
			";
			
			$sql = str_replace("%usuario%", $this->usuario, $sql);
			$sql = str_replace("%nombres%", $this->nombres, $sql);
			$sql = str_replace("%apellidos%", $this->apellidos, $sql);
			$sql = str_replace("%prefcelular%", $this->prefcelular, $sql);
			$sql = str_replace("%celular%", $this->celular, $sql);
			$sql = str_replace("%preffijo%", $this->preffijo, $sql);
			$sql = str_replace("%fijo%", $this->fijo, $sql);
			$sql = str_replace("%nacionalidad%", $this->nacionalidad, $sql);
			$sql = str_replace("%nacimiento%", $this->nacimiento, $sql);
			$sql = str_replace("%genero%", $this->genero, $sql);
			$sql = str_replace("%civil%", $this->civil, $sql);
			$sql = str_replace("%dependientes%", $this->dependientes, $sql);
			$sql = str_replace("%domicilio%", $this->domicilio, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			} 
			
		}
		
		return $resultado;
		
	}
	
	/*
	** Método Actualizar
	*/
	
	public function Actualizar() {
		
		$resultado = false;
		
		if ($this->usuario != "") {
			
			$sql = "
					update sys_generales set
					nombres = '%nombres%',
					apellidos = '%apellidos%',
					prefcelular = '%prefcelular%',
					celular = '%celular%',
					preffijo = '%preffijo%',
					fijo = '%fijo%',
					nacionalidad = '%nacionalidad%',
					nacimiento = '%nacimiento%',
					genero = '%genero%',
					civil = '%civil%',
					dependientes = '%dependientes%',
					domicilio = '%domicilio%'
					where usuario = '%usuario%'
			";
			
			$this->instante = $this->funciones->getFechaHora();
			
			$sql = str_replace("%usuario%", $this->usuario, $sql);
			$sql = str_replace("%nombres%", $this->nombres, $sql);
			$sql = str_replace("%apellidos%", $this->apellidos, $sql);
			$sql = str_replace("%prefcelular%", $this->prefcelular, $sql);
			$sql = str_replace("%celular%", $this->celular, $sql);
			$sql = str_replace("%preffijo%", $this->preffijo, $sql);
			$sql = str_replace("%fijo%", $this->fijo, $sql);
			$sql = str_replace("%nacionalidad%", $this->nacionalidad, $sql);
			$sql = str_replace("%nacimiento%", $this->nacimiento, $sql);
			$sql = str_replace("%genero%", $this->genero, $sql);
			$sql = str_replace("%civil%", $this->civil, $sql);
			$sql = str_replace("%dependientes%", $this->dependientes, $sql);
			$sql = str_replace("%domicilio%", $this->domicilio, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			} 
			
		}
		
		return $resultado;
		
	}

}

?>