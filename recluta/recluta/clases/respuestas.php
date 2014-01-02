<?PHP

class respuestas {
	
	/************************************************** Propiedades */
	
	private $funciones;
	private $conexion;
	
	private $evaluacion;
	private $pregunta;
	private $respuesta;
	private $texto;
	private $valor;
	private $activo;
	
	/************************************************** Constructor */
	
	public function respuestas() {
		
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
	
	public function setRespuesta($respuesta) {
		$this->respuesta = $respuesta;
	}
	
	public function setTexto($texto) {
		$this->texto = mysql_real_escape_string($texto);
	}
	
	public function setValor($valor) {
		$this->valor = ($valor >= 1 && $valor <= 100) ? $valor : 0;
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
	
	public function getRespuesta() {
		return $this->respuesta;
	}
	
	public function getTexto() {
		return $this->texto;
	}
	
	public function getValor() {
		return $this->valor;
	}
	
	public function getActivo() {
		return $this->activo;
	}
	
	/*
	** Método ListadoTotal
	*/
	
	public function ListadoTotal() {
		
		$listado = array();
		
		if ($this->evaluacion != "" && $this->pregunta != "") {
			
			$sql = "
					select a.evaluacion, a.pregunta, a.respuesta, a.texto, a.valor, a.activo
					from eva_respuestas a
					where a.evaluacion = '%evaluacion%'
					and a.pregunta = '%pregunta%'
					order by a.pregunta asc, a.respuesta asc
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			while ($registro = $this->conexion->recorrer($tabla)) {
				
				$elemento = array();
				
				$elemento["evaluacion"] = $registro["evaluacion"];
				$elemento["pregunta"] = $registro["pregunta"];
				$elemento["respuesta"] = $registro["respuesta"];
				$elemento["texto"] = $registro["texto"];
				$elemento["valor"] = $registro["valor"];
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
		
		if ($this->evaluacion != "" && $this->pregunta != "" && $this->texto && $this->valor >= 0 && $this->valor <= 100) {
			
			$sql = "
					select count(*) + 1 as siguiente
					from eva_respuestas a
					where a.evaluacion = '%evaluacion%'
					and a.pregunta = '%pregunta%'
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			$this->respuesta = $registro["siguiente"];
			$this->activo = "X";
			
			$sql = "
					insert into eva_respuestas
					values ('%evaluacion%', %pregunta%, %respuesta%, '%texto%', %valor%, '%activo%') 
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			$sql = str_replace("%respuesta%", $this->respuesta, $sql);
			$sql = str_replace("%texto%", $this->texto, $sql);
			$sql = str_replace("%valor%", $this->valor, $sql);
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
		
		if ($this->evaluacion != "" && $this->pregunta != "" && $this->respuesta) {
			
			$sql = "
					select a.evaluacion, a.pregunta, a.respuesta, a.texto, a.valor, a.activo
					from eva_respuestas a
					where a.evaluacion = '%evaluacion%'
					and a.pregunta = %pregunta%
					and a.respuesta = %respuesta%
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			$sql = str_replace("%respuesta%", $this->respuesta, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->evaluacion = $registro["evaluacion"];
			$this->pregunta = $registro["pregunta"];
			$this->respuesta = $registro["respuesta"];
			$this->texto = $registro["texto"];
			$this->valor = $registro["valor"];
			$this->activo = $registro["activo"];
			
		}
		
	}
	
	/*
	** Método Subir
	*/
	
	public function Subir() {
		
		$resultado = false;
		
		$anterior = $this->respuesta - 1;
			
		$sql = "
				update eva_respuestas
				set respuesta = 0
				where evaluacion = '%evaluacion%'
				and pregunta = %pregunta%
				and respuesta = %anterior%
		";
		
		$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
		$sql = str_replace("%pregunta%", $this->pregunta, $sql);
		$sql = str_replace("%anterior%", $anterior, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			
			$sql = "
					update eva_respuestas
					set respuesta = %anterior%
					where evaluacion = '%evaluacion%'
					and pregunta = %pregunta%
					and respuesta = %respuesta%
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			$sql = str_replace("%respuesta%", $this->respuesta, $sql);
			$sql = str_replace("%anterior%", $anterior, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				
				$sql = "
						update eva_respuestas
						set respuesta = %respuesta%
						where evaluacion = '%evaluacion%'
						and pregunta = %pregunta%
						and respuesta = 0
				";
				
				$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
				$sql = str_replace("%pregunta%", $this->pregunta, $sql);
				$sql = str_replace("%respuesta%", $this->respuesta, $sql);
				
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
		
		$siguiente = $this->respuesta + 1;
			
		$sql = "
				update eva_respuestas
				set respuesta = 0
				where evaluacion = '%evaluacion%'
				and pregunta = %pregunta%
				and respuesta = '%siguiente%'
		";
		
		$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
		$sql = str_replace("%pregunta%", $this->pregunta, $sql);
		$sql = str_replace("%siguiente%", $siguiente, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			
			$sql = "
					update eva_respuestas
					set respuesta = %siguiente%
					where evaluacion = '%evaluacion%'
					and pregunta = %pregunta%
					and respuesta = %respuesta%
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			$sql = str_replace("%respuesta%", $this->respuesta, $sql);
			$sql = str_replace("%siguiente%", $siguiente, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				
				$sql = "
						update eva_respuestas
						set respuesta = %respuesta%
						where evaluacion = '%evaluacion%'
						and pregunta = %pregunta%
						and respuesta = 0
				";
				
				$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
				$sql = str_replace("%pregunta%", $this->pregunta, $sql);
				$sql = str_replace("%respuesta%", $this->respuesta, $sql);
				
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
		
		if ($this->evaluacion != "" && $this->pregunta != "" && $this->respuesta != "" && $this->texto != "" && $this->valor >= 0 && $this->valor <= 100) {
			
			
			$sql = "
					update eva_respuestas set
					texto = '%texto%',
					valor = '%valor%',
					activo = '%activo%'
					where evaluacion = '%evaluacion%'
					and pregunta = %pregunta%
					and respuesta = %respuesta%
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%pregunta%", $this->pregunta, $sql);
			$sql = str_replace("%respuesta%", $this->respuesta, $sql);
			$sql = str_replace("%texto%", $this->texto, $sql);
			$sql = str_replace("%valor%", $this->valor, $sql);
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