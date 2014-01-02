<?PHP

class estudios {
	
	/*
	** Propiedades
	*/
	
	private $funciones;
	private $conexion;
	
	private $candidato;
	private $secuencia;
	private $titulo;
	private $pais;
	private $institucion;
	private $mes_inicio;
	private $ano_inicio;
	private $mes_fin;
	private $ano_fin;
	private $presente;
	private $escolaridad;
	
	/*
	** Constructor
	*/
	
	public function estudios() {
		
		$this->funciones = new funciones();
		$this->conexion = new conexion();
		
	}
	
	/*
	** Métodos SET
	*/
	
	public function setCandidato($candidato) {
		$this->candidato = $candidato;
	}
	
	public function setSecuencia($secuencia) {
		$this->secuencia = (is_numeric($secuencia)) ? $secuencia : 0;
	}
	
	public function setTitulo($titulo) {
		$this->titulo = mysql_real_escape_string($titulo);
	}
	
	public function setPais($pais) {
		$this->pais = $pais;
	}
	
	public function setInstitucion($institucion) {
		$this->institucion = mysql_real_escape_string($institucion);
	}
	
	public function setMes_Inicio($mes_inicio) {
		$this->mes_inicio = $mes_inicio;
	}
	
	public function setAno_Inicio($ano_inicio) {
		$this->ano_inicio = $ano_inicio;
	}
	
	public function setMes_Fin($mes_fin) {
		$this->mes_fin = $mes_fin;
	}
	
	public function setAno_Fin($ano_fin) {
		$this->ano_fin = $ano_fin;
	}
	
	public function setPresente($presente) {
		$this->presente = ($presente == "X") ? "X" : "";
	}
	
	public function setEscolaridad($escolaridad) {
		$this->escolaridad = $escolaridad;
	}
	
	/*
	** Métodos GET
	*/
	
	public function getCandidato() {
		return $this->candidato;
	}
	
	public function getSecuencia() {
		return $this->secuencia;
	}
	
	public function getTitulo() {
		return $this->titulo;
	}
	
	public function getPais() {
		return $this->pais;
	}
	
	public function getInstitucion() {
		return $this->institucion;
	}
	
	public function getMes_Inicio() {
		return $this->mes_inicio;
	}
	
	public function getAno_Inicio() {
		return $this->ano_inicio;
	}
	
	public function getMes_Fin() {
		return $this->mes_fin;
	}
	
	public function getAno_Fin() {
		return $this->ano_fin;
	}
	
	public function getPresente() {
		return $this->presente;
	}
	
	public function getEscolaridad() {
		return $this->escolaridad;
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($candidato, $secuencia = "") {
		
		$salida = false;
		
		if ($secuencia == "") {
			
			$sql = "
					select 'X' as existe
					from can_estudios a
					where a.candidato = '%candidato%'
			";
			
		} else {
			
			$sql = "
					select 'X' as existe
					from can_estudios a
					where a.candidato = '%candidato%'
					and a.secuencia = '%secuencia%'
			";
			
			$sql = str_replace("%secuencia%", $secuencia, $sql);
			
		}
		
		$sql = str_replace("%candidato%", $candidato, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) > 0) {
			$salida = true;
		}
		
		return $salida;
		
	}
	
	/*
	** Método ListadoSecuencias
	*/
	
	public function ListadoSecuencias($candidato) {
		
		$listado = array();
		
		$sql = "
				select secuencia
				from can_estudios
				where candidato = '%candidato%'
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["secuencia"] = $registro["secuencia"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método SecuenciaSiguiente
	*/
	
	public function SecuenciaSiguiente($candidato) {
		
		$salida = 0;
		
		$sql = "
				select coalesce(max(secuencia), count(secuencia)) + 1 as secuencia
				from can_estudios
				where candidato = '%candidato%'
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		$registro = $this->conexion->recorrer($tabla);
		
		$salida = $registro["secuencia"];
		
		return $salida;
		
	}
	
	/*
	** Método Cargar
	*/
	
	public function Cargar() {
		
			
		$sql = "
				select a.titulo, a.pais, a.institucion, a.mes_inicio, a.ano_inicio, a.mes_fin, a.ano_fin, a.presente, a.escolaridad
				from can_estudios a
				where a.candidato = '%candidato%'
				and a.secuencia = '%secuencia%'
		";
		
		$sql = str_replace("%candidato%", $this->candidato, $sql);
		$sql = str_replace("%secuencia%", $this->secuencia, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		$registro = $this->conexion->recorrer($tabla);
		
		$this->titulo = $registro["titulo"];
		$this->pais = $registro["pais"];
		$this->institucion = $registro["institucion"];
		$this->mes_inicio = $registro["mes_inicio"];
		$this->ano_inicio = $registro["ano_inicio"];
		$this->mes_fin = $registro["mes_fin"];
		$this->ano_fin = $registro["ano_fin"];
		$this->presente = $registro["presente"];
		$this->escolaridad = $registro["escolaridad"];
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
			
		$sql = "
				insert into can_estudios (candidato, secuencia, titulo, pais, institucion, mes_inicio, ano_inicio, mes_fin, ano_fin, presente, escolaridad)
				values ('%candidato%', '%secuencia%', '%titulo%', '%pais%', '%institucion%', '%mes_inicio%', '%ano_inicio%', '%mes_fin%', '%ano_fin%', '%presente%', '%escolaridad%')
		";
		
		$sql = str_replace("%candidato%", $this->candidato, $sql);
		$sql = str_replace("%secuencia%", $this->secuencia, $sql);
		$sql = str_replace("%titulo%", $this->titulo, $sql);
		$sql = str_replace("%pais%", $this->pais, $sql);
		$sql = str_replace("%institucion%", $this->institucion, $sql);
		$sql = str_replace("%mes_inicio%", $this->mes_inicio, $sql);
		$sql = str_replace("%ano_inicio%", $this->ano_inicio, $sql);
		$sql = str_replace("%mes_fin%", $this->mes_fin, $sql);
		$sql = str_replace("%ano_fin%", $this->ano_fin, $sql);
		$sql = str_replace("%presente%", $this->presente, $sql);
		$sql = str_replace("%escolaridad%", $this->escolaridad, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$resultado = true;
		}
		
		return $resultado;
		
	}
	
	/*
	** Método Actualizar
	*/
	
	public function Actualizar() {
		
		$resultado = false;
			
		$sql = "
				update can_estudios set
				titulo = '%titulo%',
				pais = '%pais%',
				institucion = '%institucion%',
				mes_inicio = '%mes_inicio%',
				ano_inicio = '%ano_inicio%',
				mes_fin = '%mes_fin%',
				ano_fin = '%ano_fin%',
				presente = '%presente%',
				escolaridad = '%escolaridad%'
				where candidato = '%candidato%'
				and secuencia = '%secuencia%'
		";
		
		$sql = str_replace("%candidato%", $this->candidato, $sql);
		$sql = str_replace("%secuencia%", $this->secuencia, $sql);
		$sql = str_replace("%titulo%", $this->titulo, $sql);
		$sql = str_replace("%pais%", $this->pais, $sql);
		$sql = str_replace("%institucion%", $this->institucion, $sql);
		$sql = str_replace("%mes_inicio%", $this->mes_inicio, $sql);
		$sql = str_replace("%ano_inicio%", $this->ano_inicio, $sql);
		$sql = str_replace("%mes_fin%", $this->mes_fin, $sql);
		$sql = str_replace("%ano_fin%", $this->ano_fin, $sql);
		$sql = str_replace("%presente%", $this->presente, $sql);
		$sql = str_replace("%escolaridad%", $this->escolaridad, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$resultado = true;
		} 
		
		return $resultado;
		
	}
	
	/*
	** Método Eliminar
	*/
	
	public function Eliminar() {
		
		$resultado = false;
			
		$sql = "
				delete from can_estudios
				where candidato = '%candidato%'
				and secuencia = '%secuencia%'
		";
		
		$sql = str_replace("%candidato%", $this->candidato, $sql);
		$sql = str_replace("%secuencia%", $this->secuencia, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$resultado = true;
		} 
		
		return $resultado;
		
	}
	
	/*
	** Método Detalles
	*/
	
	public function Detalles($candidato) {
		
		$detalles = array();
		
		$sql = "
				select
						a.candidato,
						a.secuencia,
						a.titulo,
						a1.descripcion as pais,
						a.institucion,
						case
								when a.mes_inicio <> '' and a.ano_inicio <> '' then concat(a3.descripcion, ' / ', a.ano_inicio)
								else ''
						end as inicio,
						case
								when a.mes_fin <> '' and a.ano_fin <> '' then concat(a4.descripcion, ' / ', a.ano_fin)
								else ''
						end as fin,
						a.presente,
						a2.descripcion as escolaridad
				from
						can_estudios a
								left outer join
								cat_paises a1
								on a1.pais = a.pais
										left outer join
										cat_escolaridades a2
										on a2.escolaridad = a.escolaridad
												left outer join
												cat_meses a3
												on a3.mes = a.mes_inicio
														left outer join
														cat_meses a4
														on a4.mes = a.mes_fin
				where
						1 = 1
						and a.candidato = '%candidato%'

		";
		
		$sql = str_replace("%candidato%", $this->candidato, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["candidato"] = $registro["candidato"];
			$elemento["secuencia"] = $registro["secuencia"];
			$elemento["titulo"] = $registro["titulo"];
			$elemento["pais"] = $registro["pais"];
			$elemento["institucion"] = $registro["institucion"];
			$elemento["inicio"] = $registro["inicio"];
			$elemento["fin"] = $registro["fin"];
			$elemento["presente"] = $registro["presente"];
			$elemento["escolaridad"] = $registro["escolaridad"];
			
			$detalles[] = $elemento;
			
		}
		
		return $detalles;
		
	}

}

?>