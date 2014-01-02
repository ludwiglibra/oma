<?PHP

class archivos {
	
	/*
	** Propiedades
	*/
	
	private $funciones;
	private $conexion;
	
	private $tabla;
	private $valor1;
	private $valor2;
	private $valor3;
	private $valor4;
	private $valor5;
	private $instante;
	private $archivo;
	
	/*
	** Constructor
	*/
	
	public function archivos() {
		
		$this->funciones = new funciones();
		$this->conexion = new conexion();
		
	}
	
	/*
	** Métodos SET
	*/
	
	public function setTabla($tabla) {
		$this->tabla = $tabla;
	}
	
	public function setValor1($valor1) {
		$this->valor1 = $valor1;
	}
	
	public function setValor2($valor2) {
		$this->valor2 = $valor2;
	}
	
	public function setValor3($valor3) {
		$this->valor3 = $valor3;
	}
	
	public function setValor4($valor4) {
		$this->valor4 = $valor4;
	}
	
	public function setValor5($valor5) {
		$this->valor5 = $valor5;
	}
	
	public function setInstante($instante) {
		$this->instante = $instante;
	}
	
	public function setArchivo($archivo) {
		$this->archivo = $archivo;
	}
	
	/*
	** Métodos GET
	*/
	
	public function getTabla() {
		return $this->tabla;
	}
	
	public function getValor1() {
		return $this->valor1;
	}
	
	public function getValor2() {
		return $this->valor2;
	}
	
	public function getValor3() {
		return $this->valor3;
	}
	
	public function getValor4() {
		return $this->valor4;
	}
	
	public function getValor5() {
		return $this->valor5;
	}
	
	public function getInstante() {
		return $this->instante;
	}
	
	public function getArchivo() {
		return $this->archivo;
	}
	
	/*
	** Método Listado
	*/
	
	public function Listado() {
		
		$listado = array();
		
		if ($this->tabla != "" && $this->valor1 != "") {
			
			$sql = "
					select instante, archivo
					from sys_archivos
					where tabla = '%tabla%'
					and valor1 = '%valor1%'
					and valor2 = '%valor2%'
					and valor3 = '%valor3%'
					and valor4 = '%valor4%'
					and valor5 = '%valor5%'
					order by instante asc 
			";
			
			$sql = str_replace("%tabla%", $this->tabla, $sql);
			$sql = str_replace("%valor1%", $this->valor1, $sql);
			$sql = str_replace("%valor2%", $this->valor2, $sql);
			$sql = str_replace("%valor3%", $this->valor3, $sql);
			$sql = str_replace("%valor4%", $this->valor4, $sql);
			$sql = str_replace("%valor5%", $this->valor5, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			while ($registro = $this->conexion->recorrer($tabla)) {
				
				$elemento = array();
				
				$elemento["instante"] = $registro["instante"];
				$elemento["archivo"] = $registro["archivo"];
				
				$listado[] = $elemento;
				
			}
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
		
		if ($this->tabla != "" && $this->valor1 != "" && $this->archivo != "") {
			
			$this->instante = $this->funciones->getFechaHora();
			
			$sql = "
					insert into sys_archivos
					values ('%tabla%', '%valor1%', '%valor2%', '%valor3%', '%valor4%', '%valor5%', '%instante%', '%archivo%')
			";
			
			$sql = str_replace("%tabla%", $this->tabla, $sql);
			$sql = str_replace("%valor1%", $this->valor1, $sql);
			$sql = str_replace("%valor2%", $this->valor2, $sql);
			$sql = str_replace("%valor3%", $this->valor3, $sql);
			$sql = str_replace("%valor4%", $this->valor4, $sql);
			$sql = str_replace("%valor5%", $this->valor5, $sql);
			$sql = str_replace("%instante%", $this->instante, $sql);
			$sql = str_replace("%archivo%", $this->archivo, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			}
			
		} 
		
		return $resultado;
		
	}
	
}

?>