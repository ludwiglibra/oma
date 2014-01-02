<?PHP

class evaluaciones {
	
	/************************************************** Propiedades */
	
	private $funciones;
	private $conexion;
	
	private $evaluacion;
	private $titulo;
	private $descripcion;
	private $activo;
	
	/************************************************** Constructor */
	
	public function evaluaciones() {
		
		$this->funciones = new funciones();
		$this->conexion = new conexion();
		
	}
	
	/************************************************** Métodos SET */
	
	public function setEvaluacion($evaluacion) {
		$this->evaluacion = $evaluacion;
	}
	
	public function setTitulo($titulo) {
		$this->titulo = mysql_real_escape_string($titulo);
	}
	
	public function setDescripcion($descripcion) {
		$this->descripcion = mysql_real_escape_string($descripcion);
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
	
	public function getTitulo() {
		return $this->titulo;
	}
	
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	public function getActivo() {
		return $this->activo;
	}
	
	/*
	** Método ListadoTotal
	*/
	
	public function ListadoTotal($busqueda = "") {
		
		$listado = array();
		
		if ($busqueda != "") {
			
			$sql = "
					select a.evaluacion, a.titulo, a.descripcion, a.activo
					from eva_evaluaciones a
					where 1 = 1
					and (a.evaluacion like '%%busqueda%%'
					or a.titulo like '%%busqueda%%'
					or a.descripcion like '%%busqueda%%')
					order by a.evaluacion
			";
			
			$sql = str_replace("%busqueda%", $busqueda, $sql);
			
		} else {
			
			$sql = "
					select a.evaluacion, a.titulo, a.descripcion, a.activo
					from eva_evaluaciones a
					order by a.evaluacion
			";
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["evaluacion"] = $registro["evaluacion"];
			$elemento["titulo"] = $registro["titulo"];
			$elemento["descripcion"] = $registro["descripcion"];
			$elemento["activo"] = $registro["activo"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($evaluacion) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from eva_evaluaciones a
				where a.evaluacion = '%evaluacion%'
		";
		
		$sql = str_replace("%evaluacion%", $evaluacion, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) > 0) {
			$salida = true;
		}
		
		return $salida;
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
		
		if ($this->evaluacion != "" && $this->titulo != "" && $this->descripcion != "") {
			
			$sql = "
					insert into eva_evaluaciones
					values ('%evaluacion%', '%titulo%', '%descripcion%', '%activo%') 
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%titulo%", $this->titulo, $sql);
			$sql = str_replace("%descripcion%", $this->descripcion, $sql);
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
		
		if ($this->evaluacion != "") {
			
			$sql = "
					select a.evaluacion, a.titulo, a.descripcion, a.activo
					from eva_evaluaciones a
					where a.evaluacion = '%evaluacion%'
			";
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->evaluacion = $registro["evaluacion"];
			$this->titulo = $registro["titulo"];
			$this->descripcion = $registro["descripcion"];
			$this->activo = $registro["activo"];
			
		}
		
	}
	
	/*
	** Método Actualizar
	*/
	
	public function Actualizar() {
		
		$resultado = false;
		
		if ($this->evaluacion != "") {
			
			$sql = "
					update eva_evaluaciones set
					titulo = '%titulo%',
					descripcion = '%descripcion%',
					activo = '%activo%'
					where evaluacion = '%evaluacion%'
			";
			
			$this->instante = $this->funciones->getFechaHora();
			
			$sql = str_replace("%evaluacion%", $this->evaluacion, $sql);
			$sql = str_replace("%titulo%", $this->titulo, $sql);
			$sql = str_replace("%descripcion%", $this->descripcion, $sql);
			$sql = str_replace("%activo%", $this->activo, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			} 
			
		}
		
		return $resultado;
		
	}
	
	/*
	** Método ListadoPreguntas
	*/
	
	public function ListadoPreguntas($evaluacion) {
		
		$listado = array();
			
		$sql = "
				select a.pregunta, a.texto, a.abierta
				from eva_preguntas a
				where a.evaluacion = '%evaluacion%'
				and a.activo = 'X'
				order by a.pregunta asc
		";
		
		$sql = str_replace("%evaluacion%", $evaluacion, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["pregunta"] = $registro["pregunta"];
			$elemento["texto"] = $registro["texto"];
			$elemento["abierta"] = $registro["abierta"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoRespuestas
	*/
	
	public function ListadoRespuestas($evaluacion, $pregunta) {
		
		$listado = array();
			
		$sql = "
				select a.respuesta, a.texto, a.valor
				from eva_respuestas a
				where a.evaluacion = '%evaluacion%'
				and a.pregunta = %pregunta%
				and a.activo = 'X'
		";
		
		$sql = str_replace("%evaluacion%", $evaluacion, $sql);
		$sql = str_replace("%pregunta%", $pregunta, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["respuesta"] = $registro["respuesta"];
			$elemento["texto"] = $registro["texto"];
			$elemento["valor"] = $registro["valor"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ValorRespuesta
	*/
	
	public function ValorRespuesta($evaluacion, $pregunta, $respuesta) {
		
		$valor = "";
		
		$sql = "
				select a.valor
				from eva_respuestas a
				where a.evaluacion = '%evaluacion%'
				and a.pregunta = '%pregunta%'
				and a.respuesta = '%respuesta%'
		";
		
		$sql = str_replace("%evaluacion%", $evaluacion, $sql);
		$sql = str_replace("%pregunta%", $pregunta, $sql);
		$sql = str_replace("%respuesta%", $respuesta, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		$registro = $this->conexion->recorrer($tabla);
		
		$valor = $registro["valor"];
		
		return $valor;
		
	}
	
	/*
	** Método LimpiarEvaluacion
	*/
	
	public function LimpiarEvaluacion($candidato, $vacante, $bateria, $evaluacion) {
		
		$salida = false;
		
		$sql = "
				delete from vac_vacantes_respuestas
				where candidato = '%candidato%'
				and vacante = '%vacante%'
				and bateria = '%bateria%'
				and evaluacion = '%evaluacion%'
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
		$sql = str_replace("%vacante%", $vacante, $sql);
		$sql = str_replace("%bateria%", $bateria, $sql);
		$sql = str_replace("%evaluacion%", $evaluacion, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$salida = true;
		}
		
		return $salida;
		
	}
	
	/*
	** Método RegistrarRespuesta
	*/
	
	public function RegistrarRespuesta($candidato, $vacante, $bateria, $evaluacion, $pregunta, $respuesta, $valor) {
		
		$salida = false;
		
		/* Obtener Secuencia de Batería */
		
		$sql = "
				select secuencia
				from vac_vacantes_baterias
				where vacante = '%vacante%'
				and bateria = '%bateria%'
		";
		
		$sql = str_replace("%vacante%", $vacante, $sql);
		$sql = str_replace("%bateria%", $bateria, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		$registro = $this->conexion->recorrer($tabla);
		$bateria_sec = $registro["secuencia"];
		
		/* Obtener Secuencia de Evaluacion */
		
		$sql = "
				select secuencia
				from eva_baterias_evaluaciones
				where bateria = '%bateria%'
				and evaluacion = '%evaluacion%'
		";
		
		$sql = str_replace("%bateria%", $bateria, $sql);
		$sql = str_replace("%evaluacion%", $evaluacion, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		$registro = $this->conexion->recorrer($tabla);
		$evaluacion_sec = $registro["secuencia"];
		
		/* Obtener Texto Pregunta */
		
			$sql = "
					select texto
					from eva_preguntas
					where evaluacion = '%evaluacion%'
					and pregunta = '%pregunta%'
			";
			
			$sql = str_replace("%evaluacion%", $evaluacion, $sql);
			$sql = str_replace("%pregunta%", $pregunta, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			$pregunta_txt = $registro["texto"];
		
		/* Obtener Texto de la Respuesta */
		
		if (is_numeric($respuesta)) {
		
			$sql = "
					select texto
					from eva_respuestas
					where evaluacion = '%evaluacion%'
					and pregunta = '%pregunta%'
					and respuesta = '%respuesta%'
			";
			
			$sql = str_replace("%evaluacion%", $evaluacion, $sql);
			$sql = str_replace("%pregunta%", $pregunta, $sql);
			$sql = str_replace("%respuesta%", $respuesta, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			$respuesta_txt = $registro["texto"];
			
		} else {
			
			$respuesta_txt = $respuesta;
			
		}
		
		/* Insertar Registro */
		
		$sql = "
				insert into vac_vacantes_respuestas (candidato, vacante, bateria, bateria_sec, evaluacion, evaluacion_sec, pregunta, pregunta_txt, respuesta, respuesta_txt, valor)
				values ('%candidato%', '%vacante%', '%bateria%', '%bateria_sec%', '%evaluacion%', '%evaluacion_sec%', '%pregunta%', '%pregunta_txt%', '%respuesta%', '%respuesta_txt%', '%valor%')
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
		$sql = str_replace("%vacante%", $vacante, $sql);
		$sql = str_replace("%bateria%", $bateria, $sql);
		$sql = str_replace("%bateria_sec%", $bateria_sec, $sql);
		$sql = str_replace("%evaluacion%", $evaluacion, $sql);
		$sql = str_replace("%evaluacion_sec%", $evaluacion_sec, $sql);
		$sql = str_replace("%pregunta%", $pregunta, $sql);
		$sql = str_replace("%pregunta_txt%", $pregunta_txt, $sql);
		$sql = str_replace("%respuesta%", $respuesta, $sql);
		$sql = str_replace("%respuesta_txt%", $respuesta_txt, $sql);
		$sql = str_replace("%valor%", $valor, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$salida = true;
		}
		
		return $salida;
		
	}
	
	/*
	** Método RegistrarManual
	*/
	
	public function RegistrarManual($candidato, $vacante, $bateria, $evaluacion, $pregunta, $valor) {
		
		$salida = false;
		
		$sql = "
				update vac_vacantes_respuestas set
				valor = '%valor%'
				where candidato = '%candidato%'
				and vacante = '%vacante%'
				and bateria = '%bateria%'
				and evaluacion = '%evaluacion%'
				and pregunta = '%pregunta%'
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
		$sql = str_replace("%vacante%", $vacante, $sql);
		$sql = str_replace("%bateria%", $bateria, $sql);
		$sql = str_replace("%evaluacion%", $evaluacion, $sql);
		$sql = str_replace("%pregunta%", $pregunta, $sql);
		$sql = str_replace("%valor%", $valor, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$salida = true;
		}
		
		return $salida;
		
	}
	
}

?>