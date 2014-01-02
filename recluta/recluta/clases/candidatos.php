<?PHP

class candidatos {
	
	/*
	** Propiedades
	*/
	
	private $funciones;
	private $conexion;
	
	private $candidato;
	private $tipo;
	private $empleado;
	private $aviso;
	private $texto;
	
	/*
	** Constructor
	*/
	
	public function candidatos() {
		
		$this->funciones = new funciones();
		$this->conexion = new conexion();
		
	}
	
	/*
	** Métodos SET
	*/
	
	public function setCandidato($candidato) {
		$this->candidato = $candidato;
	}
	
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
	
	public function setEmpleado($empleado) {
		$this->empleado = mysql_real_escape_string($empleado);
	}
	
	public function setAviso($aviso) {
		$this->aviso = $aviso;
	}
	
	public function setTexto($texto) {
		$this->texto = mysql_real_escape_string($texto);
	}
	
	/*
	** Métodos GET
	*/
	
	public function getCandidato() {
		return $this->candidato;
	}
	
	public function getTipo() {
		return $this->tipo;
	}
	
	public function getEmpleado() {
		return $this->empleado;
	}
	
	public function getAviso() {
		return $this->aviso;
	}
	
	public function getTexto() {
		return $this->texto;
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($candidato) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from can_candidatos a
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
					select a.candidato, a.tipo, a.empleado, a.aviso, a.texto
					from can_candidatos a
					where a.candidato = '%candidato%'
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->tipo = $registro["tipo"];
			$this->empleado = $registro["empleado"];
			$this->aviso = $registro["aviso"];
			$this->texto = $registro["texto"];
			
		}
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
		
		if ($this->candidato != "") {
			
			$sql = "
					insert into can_candidatos (candidato, tipo, empleado, aviso, texto)
					values ('%candidato%', '%tipo%', '%empleado%', '%aviso%', '%texto%')
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%tipo%", $this->tipo, $sql);
			$sql = str_replace("%empleado%", $this->empleado, $sql);
			$sql = str_replace("%aviso%", $this->aviso, $sql);
			$sql = str_replace("%texto%", $this->texto, $sql);
			
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
					update can_candidatos set
					tipo = '%tipo%',
					empleado = '%empleado%',
					aviso = '%aviso%',
					texto = '%texto%'
					where candidato = '%candidato%'
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%tipo%", $this->tipo, $sql);
			$sql = str_replace("%empleado%", $this->empleado, $sql);
			$sql = str_replace("%aviso%", $this->aviso, $sql);
			$sql = str_replace("%texto%", $this->texto, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			} 
			
		}
		
		return $resultado;
		
	}
	
	/*
	** Método DatosComparativo
	*/
	
	public function DatosComparativo($candidato) {
		
		$elemento = array();
		
		$sql = "
				select
						a.usuario as candidato,
						case
								when a.nombres <> '' and a.apellidos <> '' then concat(a.nombres, ' ', a.apellidos)
								when a.nombres <> '' then a.nombres
								else ''
						end as nombre,
						floor((datediff(now(), a.nacimiento) / 365)) as edad,
						a1.descripcion as civil,
						a.dependientes,
						a.domicilio,
						case
								when b.puesto <> '' and b.empresa <> '' then concat(b.puesto, ' / ', b.empresa)
								when b.puesto <> '' and b.empresa = '' then b.puesto
								when b.puesto = '' and b.empresa <> '' then b.empresa
								else ''
						end as puesto,
						case
								when b.inicio <> '' and b.inicio <> '0000-00-00' then b.inicio
								else ''
						end as ingreso,
						b.anterior,
						b.actual,
						b.expectativa,
						case
								when c.titulo <> '' and c.institucion <> '' then concat(c.titulo, ' / ', c.institucion)
								when c.titulo <> '' then c.titulo
								when c.institucion <> '' then c.institucion
								else ''
						end as estudios,
						b.responsabilidades
				from
						(sys_generales a
								left outer join
								cat_civiles a1
								on a1.civil = a.civil),
						can_experiencias b,
						can_estudios c
				where
						1 = 1
						and a.usuario = '%candidato%'
						and b.candidato = a.usuario
						and c.candidato = a.usuario
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		$registro = $this->conexion->recorrer($tabla);
		
		$elemento["candidato"] = $registro["candidato"];
		$elemento["nombre"] = $registro["nombre"];
		$elemento["edad"] = $registro["edad"];
		$elemento["civil"] = $registro["civil"];
		$elemento["dependientes"] = $registro["dependientes"];
		$elemento["domicilio"] = $registro["domicilio"];
		$elemento["puesto"] = $registro["puesto"];
		$elemento["ingreso"] = $registro["ingreso"];
		$elemento["anterior"] = $registro["anterior"];
		$elemento["actual"] = $registro["actual"];
		$elemento["expectativa"] = $registro["expectativa"];
		$elemento["estudios"] = $registro["estudios"];
		$elemento["responsabilidades"] = $registro["responsabilidades"];
		
		return $elemento;
		
	}
	
	/*
	** Método ListadoRespuestas
	*/
	
	public function ListadoRespuestas($candidato, $vacante) {
		
		$listado = array();
		
		$sql = "
				select candidato, vacante, bateria, bateria_sec, evaluacion, evaluacion_sec, pregunta, pregunta_txt, respuesta, respuesta_txt, valor
				from vac_vacantes_respuestas
				where candidato = '%candidato%'
				and vacante = '%vacante%'
				order by bateria_sec asc, evaluacion_sec asc, pregunta asc, respuesta asc
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
		$sql = str_replace("%vacante%", $vacante, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["candidato"] = $registro["candidato"];
			$elemento["vacante"] = $registro["vacante"];
			$elemento["bateria"] = $registro["bateria"];
			$elemento["bateria_sec"] = $registro["bateria_sec"];
			$elemento["evaluacion"] = $registro["evaluacion"];
			$elemento["evaluacion_sec"] = $registro["evaluacion_sec"];
			$elemento["pregunta"] = $registro["pregunta"];
			$elemento["pregunta_txt"] = $registro["pregunta_txt"];
			$elemento["respuesta"] = $registro["respuesta"];
			$elemento["respuesta_txt"] = $registro["respuesta_txt"];
			$elemento["valor"] = $registro["valor"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método DatosGenerales
	*/
	
	public function DatosGenerales($candidato) {
		
		$elemento = array();
		
		$sql = "
				select
						a.usuario as candidato,
						a1.nombres,
						a1.apellidos,
						a1.celular,
						a1.fijo,
						a2.descripcion as nacionalidad,
						case
								when a1.nacimiento <> '0000-00-00' then date_format(a1.nacimiento, '%d-%m-%Y')
								else ''
						end as nacimiento,
						a3.descripcion as sexo,
						a4.descripcion as civil,
						a1.dependientes,
						a1.domicilio
				from
						((((sys_usuarios a
								left outer join
								sys_generales a1
								on a1.usuario = a.usuario)
										left outer join
										cat_paises a2
										on a2.pais = a1.nacionalidad)
												left outer join
												cat_generos a3
												on a3.genero = a1.genero)
														left outer join
														cat_civiles a4
														on a4.civil = a1.civil)
				where
						1 = 1
						and a.usuario = '%candidato%'
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		$registro = $this->conexion->recorrer($tabla);
			
		$elemento["candidato"] = $registro["candidato"];
		$elemento["nombres"] = $registro["nombres"];
		$elemento["apellidos"] = $registro["apellidos"];
		$elemento["celular"] = $registro["celular"];
		$elemento["fijo"] = $registro["fijo"];
		$elemento["nacionalidad"] = $registro["nacionalidad"];
		$elemento["nacimiento"] = $registro["nacimiento"];
		$elemento["sexo"] = $registro["sexo"];
		$elemento["civil"] = $registro["civil"];
		$elemento["dependientes"] = $registro["dependientes"];
		$elemento["domicilio"] = $registro["domicilio"];
		
		return $elemento;
		
	}

}

?>