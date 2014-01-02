<?PHP

class salarial {
	
	/*
	** Propiedades
	*/
	
	private $funciones;
	private $conexion;
	
	private $candidato;
	private $actual;
	private $expectativas;
	
	/*
	** Constructor
	*/
	
	public function salarial() {
		
		$this->funciones = new funciones();
		$this->conexion = new conexion();
		
	}
	
	/*
	** Métodos SET
	*/
	
	public function setCandidato($candidato) {
		$this->candidato = $candidato;
	}
	
	public function setActual($actual) {
		$this->actual = $actual;
	}
	
	public function setExpectativas($expectativas) {
		$this->expectativas = $expectativas;
	}
	
	/*
	** Métodos GET
	*/
	
	public function getCandidato() {
		return $this->candidato;
	}
	
	public function getActual() {
		return $this->actual;
	}
	
	public function getExpectativas() {
		return $this->expectativas;
	}
		
	/*
	** Método Existe
	*/
	
	public function Existe($candidato) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from can_salarial a
				where a.candidato = '%candidato%'
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
			
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
		
		if ($this->candidato != "") {
			
			$sql = "
					select a.actual, a.expectativas
					from can_salarial a
					where a.candidato = '%candidato%'
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->actual = $registro["actual"];
			$this->expectativas = $registro["expectativas"];
			
		}
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
		
		if ($this->candidato != "") {
			
			$sql = "
					insert into can_salarial (candidato, actual, expectativas)
					values ('%candidato%', '%actual%', '%expectativas%')
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%actual%", $this->actual, $sql);
			$sql = str_replace("%expectativas%", $this->expectativas, $sql);
			
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
		
		if ($this->candidato != "") {
			
			$sql = "
					update can_salarial set
					actual = '%actual%',
					expectativas = '%expectativas%'
					where candidato = '%candidato%'
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%actual%", $this->actual, $sql);
			$sql = str_replace("%expectativas%", $this->expectativas, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			} 
			
		}
		
		return $resultado;
		
	}

}

?>