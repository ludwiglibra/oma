<?PHP

class preguntas {
	
	/************************************************** Propiedades */
	
	private $funciones;
	private $conexion;
	
	private $evaluacion;
	private $pregunta;
	private $texto;
	private $abierta;
	private $activo;
	
	/************************************************** Constructor */
	
	public function preguntas() {
		
		$this->funciones = new funciones();
		$this->conexion = new conexion();
		
	}
	
	/************************************************** Métodos SET */
	
	public function setEvaluacion($evaluacion) {
		$this->evaluacion = $evaluacion;
	}
	
	public function setPregunta($pregunta) {
		$this->pregunta = $pregunta;
	}
	
	public function setTexto($texto) {
		$this->texto = mysql_real_escape_string($texto);
	}
	
	public function setAbierta($abierta) {
		$this->abierta = ($abierta == "X") ? "X" : "";
	}
		
	public function setActivo($activo) {
		$this->activo = $activo;
	}
	
	/*
	** Métodos GET
	*/
	
	public function getEvaluacion() {
		return $this->evaluacion;
	}
	
	public function getPregunta() {
		return $this->pregunta;
	}
	
	public function getTexto() {
		return nl2br($this->texto);
	}
	
	public function getAbierta() {
		return $this->abierta;
	}
	
	public function getActivo() {
		return $this->activo;
	}
	
	/*
	** Método ListadoTotal
	*/
	
	public function ListadoTotal() {
		
		$listado = array();
		
		if ($this->evaluacion != "") {
			
			$sql = "
					select a.evaluacion, a.pregunta, a.texto, a.abierta, a.activo
					from eva_preguntas a
					where a.evaluacion = '%evaluacion%'
					order by a.pregunta asc
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			while ($registro = $this->conexion->recorrer($tabla)) {
				
				$elemento = array();
				
				$elemento["evaluacion"] = $registro["evaluacion"];
				$elemento["pregunta"] = $registro["pregunta"];
				$elemento["texto"] = $registro["texto"];
				$elemento["abierta"] = $registro["abierta"];
				$elemento["activo"] = $registro["activo"];
				
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
		
		if ($this->evaluacion != "" && $this->texto != "") {
			
			$sql = "
					select count(*) + 1 as siguiente
					from eva_preguntas a
					where a.evaluacion = '%evaluacion%'
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			$this->pregunta = $registro["siguiente"];
			$this->activo = "X";
			
			$sql = "
					insert into eva_preguntas
					values ('%evaluacion%', '%pregunta%', '%texto%', '%abierta%', '%activo%') 
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			$sql = str_replace("%texto%", $this->texto, $sql);
			$sql = str_replace("%abierta%", $this->abierta, $sql);
			$sql = str_replace("%activo%", $this->activo, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			} 
			
		}
		
		return $resultado;
		
	}
	
	/*
	** Método Cargar
	*/
	
	public function Cargar() {
		
		if ($this->evaluacion != "" && $this->pregunta != "") {
			
			$sql = "
					select a.evaluacion, a.pregunta, a.texto, a.abierta, a.activo
					from eva_preguntas a
					where a.evaluacion = '%evaluacion%'
					and a.pregunta = '%pregunta%'
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->evaluacion = $registro["evaluacion"];
			$this->pregunta = $registro["pregunta"];
			$this->texto = $registro["texto"];
			$this->abierta = $registro["abierta"];
			$this->activo = $registro["activo"];
			
		}
		
	}
	
	/*
	** Método Subir
	*/
	
	public function Subir() {
		
		$resultado = false;
		
		$anterior = $this->pregunta - 1;
			
		$sql = "
				update eva_preguntas
				set pregunta = 0
				where evaluacion = '%evaluacion%'
				and pregunta = %anterior%
		";
		
		$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
		$sql = str_replace("%anterior%", $anterior, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			
			$sql = "
					update eva_preguntas
					set pregunta = %anterior%
					where evaluacion = '%evaluacion%'
					and pregunta = %pregunta%
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			$sql = str_replace("%anterior%", $anterior, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				
				$sql = "
						update eva_preguntas
						set pregunta = %pregunta%
						where evaluacion = '%evaluacion%'
						and pregunta = 0
				";
				
				$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
				$sql = str_replace("%pregunta%", $this->pregunta, $sql);
				
				//die($sql);
				
				if ($this->conexion->ejecutar($sql)) {

					$resultado = true;
					
				}
				
			}
			
		} 
		
		return $resultado;
		
	}
	
	/*
	** Método Bajar
	*/
	
	public function Bajar() {
		
		$resultado = false;
		
		$siguiente = $this->pregunta + 1;
			
		$sql = "
				update eva_preguntas
				set pregunta = 0
				where evaluacion = '%evaluacion%'
				and pregunta = %siguiente%
		";
		
		$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
		$sql = str_replace("%siguiente%", $siguiente, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			
			$sql = "
					update eva_preguntas
					set pregunta = %siguiente%
					where evaluacion = '%evaluacion%'
					and pregunta = %pregunta%
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			$sql = str_replace("%siguiente%", $siguiente, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				
				$sql = "
						update eva_preguntas
						set pregunta = %pregunta%
						where evaluacion = '%evaluacion%'
						and pregunta = 0
				";
				
				$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
				$sql = str_replace("%pregunta%", $this->pregunta, $sql);
				
				//die($sql);
				
				if ($this->conexion->ejecutar($sql)) {

					$resultado = true;
					
				}
				
			}
			
		} 
		
		return $resultado;
		
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($evaluacion, $pregunta) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from eva_preguntas a
				where a.evaluacion = '%evaluacion%'
				and a.pregunta = %pregunta%
		";
		
		$sql = str_replace("%evaluacion%", $evaluacion, $sql);
		$sql = str_replace("%pregunta%", $pregunta, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) > 0) {
			$salida = true;
		}
		
		return $salida;
		
	}
	
	/*
	** Método Actualizar
	*/
	
	public function Actualizar() {
		
		$resultado = false;
		
		if ($this->evaluacion != "" && $this->pregunta != "" && $this->texto != "") {
			
			$sql = "
					update eva_preguntas set
					texto = '%texto%',
					abierta = '%abierta%',
					activo = '%activo%'
					where evaluacion = '%evaluacion%'
					and pregunta = %pregunta%
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			$sql = str_replace("%texto%", $this->texto, $sql);
			$sql = str_replace("%abierta%", $this->abierta, $sql);
			$sql = str_replace("%activo%", $this->activo, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			} 
			
		}
		
		return $resultado;
		
	}
	
}

?>