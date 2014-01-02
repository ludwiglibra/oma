<?PHP

class experiencias {
	
	/*
	** Propiedades
	*/
	
	private $funciones;
	private $conexion;
	
	private $candidato;
	private $secuencia;
	private $titulo;
	private $puesto;
	private $seniority;
	private $empresa;
	private $pais;
	private $inicio;
	private $fin;
	private $presente;
	private $area;
	private $subarea;
	private $industria;
	private $responsabilidades;
	private $anterior;
	private $actual;
	private $expectativas;
	
	/*
	** Constructor
	*/
	
	public function experiencias() {
		
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
		$this->secuencia = $secuencia;
	}
	
	public function setTitulo($titulo) {
		$this->titulo = mysql_real_escape_string($titulo);
	}
	
	public function setPuesto($puesto) {
		$this->puesto = mysql_real_escape_string($puesto);
	}
	
	public function setSeniority($seniority) {
		$this->seniority = mysql_real_escape_string($seniority);
	}
	
	public function setEmpresa($empresa) {
		$this->empresa = mysql_real_escape_string($empresa);
	}
	
	public function setPais($pais) {
		$this->pais = $pais;
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
	
	public function setArea($area) {
		$this->area = mysql_real_escape_string($area);
	}
	
	public function setSubarea($subarea) {
		$this->subarea = mysql_real_escape_string($subarea);
	}
	
	public function setIndustria($industria) {
		$this->industria = mysql_real_escape_string($industria);
	}
	
	public function setResponsabilidades($responsabilidades) {
		$this->responsabilidades = mysql_real_escape_string($responsabilidades);
	}
	
	public function setAnterior($anterior) {
		$this->anterior = $anterior;
	}
	
	public function setActual($actual) {
		$this->actual = $actual;
	}
	
	public function setExpectativa($expectativa) {
		$this->expectativa = $expectativa;
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
	
	public function getPuesto() {
		return $this->puesto;
	}
	
	public function getSeniority() {
		return $this->seniority;
	}
	
	public function getEmpresa() {
		return $this->empresa;
	}
	
	public function getPais() {
		return $this->pais;
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
	
	public function getArea() {
		return $this->area;
	}
	
	public function getSubarea() {
		return $this->subarea;
	}
	
	public function getIndustria() {
		return $this->industria;
	}
	
	public function getResponsabilidades() {
		return $this->responsabilidades;
	}
	
	public function getAnterior() {
		return $this->anterior;
	}
	
	public function getActual() {
		return $this->actual;
	}
	
	public function getExpectativa() {
		return $this->expectativa;
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($candidato, $secuencia = "") {
		
		$salida = false;
		
		if ($secuencia == "") {

			$sql = "
					select 'X' as existe
					from can_experiencias a
					where a.candidato = '%candidato%'
			";
		
		} else {
			
			$sql = "
					select 'X' as existe
					from can_experiencias a
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
				from can_experiencias
				where candidato = '%candidato%'
				order by secuencia asc
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
				select count(secuencia) + 1 as secuencia
				from can_experiencias
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
		
		if ($this->candidato != "") {
			
			$sql = "
					select a.titulo, a.puesto, a.seniority, a.empresa, a.pais, a.mes_inicio, a.ano_inicio, a.mes_fin, a.ano_fin, a.presente, a.area, a.subarea, a.industria, a.responsabilidades, a.anterior, a.actual, a.expectativa
					from can_experiencias a
					where a.candidato = '%candidato%'
					and a.secuencia = '%secuencia%'
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%secuencia%", $this->secuencia, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->titulo = $registro["titulo"];
			$this->puesto = $registro["puesto"];
			$this->seniority = $registro["seniority"];
			$this->empresa = $registro["empresa"];
			$this->pais = $registro["pais"];
			$this->mes_inicio = $registro["mes_inicio"];
			$this->ano_inicio = $registro["ano_inicio"];
			$this->mes_fin = $registro["mes_fin"];
			$this->ano_fin = $registro["ano_fin"];
			$this->presente = $registro["presente"];
			$this->area = $registro["area"];
			$this->subarea = $registro["subarea"];
			$this->industria = $registro["industria"];
			$this->responsabilidades = $registro["responsabilidades"];
			$this->anterior = $registro["anterior"];
			$this->actual = $registro["actual"];
			$this->expectativa = $registro["expectativa"];
			
		}
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
		
		if ($this->candidato != "") {
			
			$sql = "
					insert into can_experiencias (candidato, secuencia, titulo, puesto, seniority, empresa, pais, mes_inicio, ano_inicio, mes_fin, ano_fin, presente, area, subarea, industria, responsabilidades, anterior, actual, expectativa)
					values ('%candidato%', '%secuencia%', '%titulo%', '%puesto%', '%seniority%', '%empresa%', '%pais%', '%mes_inicio%', '%ano_inicio%', '%mes_fin%', '%ano_fin%', '%presente%', '%area%', '%subarea%', '%industria%', '%responsabilidades%', '%anterior%', '%actual%', '%expectativa%')
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%secuencia%", $this->secuencia, $sql);
			$sql = str_replace("%titulo%", $this->titulo, $sql);
			$sql = str_replace("%puesto%", $this->puesto, $sql);
			$sql = str_replace("%seniority%", $this->seniority, $sql);
			$sql = str_replace("%empresa%", $this->empresa, $sql);
			$sql = str_replace("%pais%", $this->pais, $sql);
			$sql = str_replace("%mes_inicio%", $this->mes_inicio, $sql);
			$sql = str_replace("%ano_inicio%", $this->ano_inicio, $sql);
			$sql = str_replace("%mes_fin%", $this->mes_fin, $sql);
			$sql = str_replace("%ano_fin%", $this->ano_fin, $sql);
			$sql = str_replace("%presente%", $this->presente, $sql);
			$sql = str_replace("%area%", $this->area, $sql);
			$sql = str_replace("%subarea%", $this->subarea, $sql);
			$sql = str_replace("%industria%", $this->industria, $sql);
			$sql = str_replace("%responsabilidades%", $this->responsabilidades, $sql);
			$sql = str_replace("%anterior%", $this->anterior, $sql);
			$sql = str_replace("%actual%", $this->actual, $sql);
			$sql = str_replace("%expectativa%", $this->expectativa, $sql);
			
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
					update can_experiencias set
					titulo = '%titulo%',
					puesto = '%puesto%',
					seniority = '%seniority%',
					empresa = '%empresa%',
					pais = '%pais%',
					mes_inicio = '%mes_inicio%',
					ano_inicio = '%ano_inicio%',
					mes_fin = '%mes_fin%',
					ano_fin = '%ano_fin%',
					presente = '%presente%',
					area = '%area%',
					subarea = '%subarea%',
					industria = '%industria%',
					responsabilidades = '%responsabilidades%',
					anterior = '%anterior%',
					actual = '%actual%',
					expectativa = '%expectativa%'
					where candidato = '%candidato%'
					and secuencia = '%secuencia%'
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%secuencia%", $this->secuencia, $sql);
			$sql = str_replace("%titulo%", $this->titulo, $sql);
			$sql = str_replace("%puesto%", $this->puesto, $sql);
			$sql = str_replace("%seniority%", $this->seniority, $sql);
			$sql = str_replace("%empresa%", $this->empresa, $sql);
			$sql = str_replace("%pais%", $this->pais, $sql);
			$sql = str_replace("%mes_inicio%", $this->mes_inicio, $sql);
			$sql = str_replace("%ano_inicio%", $this->ano_inicio, $sql);
			$sql = str_replace("%mes_fin%", $this->mes_fin, $sql);
			$sql = str_replace("%ano_fin%", $this->ano_fin, $sql);
			$sql = str_replace("%presente%", $this->presente, $sql);
			$sql = str_replace("%area%", $this->area, $sql);
			$sql = str_replace("%subarea%", $this->subarea, $sql);
			$sql = str_replace("%industria%", $this->industria, $sql);
			$sql = str_replace("%responsabilidades%", $this->responsabilidades, $sql);
			$sql = str_replace("%anterior%", $this->anterior, $sql);
			$sql = str_replace("%actual%", $this->actual, $sql);
			$sql = str_replace("%expectativa%", $this->expectativa, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			} 
			
		}
		
		return $resultado;
		
	}
	
	/*
	** Método Eliminar
	*/
	
	public function Eliminar() {
		
		$resultado = false;
		
		if ($this->candidato != "" && $this->secuencia != "") {
			
			$sql = "
					delete from can_experiencias 
					where candidato = '%candidato%'
					and secuencia = '%secuencia%'
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%secuencia%", $this->secuencia, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			} 
			
		}
		
		return $resultado;
		
	}
	
	/*
	** Método AgregarIndustria
	*/
	
	public function AgregarIndustria() {
		
		$resultado = false;
		
		$sql = "
				insert into cat_industrias (industria)
				values ('%industria%')
		";
		
		$sql = str_replace("%industria%", $this->industria, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$resultado = true;
		}
		
		return $resultado;
		
	}
	
	/*
	** Método EliminarIndustria
	*/
	
	public function EliminarIndustria() {
		
		$resultado = false;
		
		$sql = "
				delete from cat_industrias
				where industria = '%industria%'
		";
		
		$sql = str_replace("%industria%", $this->industria, $sql);
		
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
						a.empresa,
						a1.descripcion as pais,
						case
								when a.mes_inicio <> '' and a.ano_inicio <> '' then concat(a2.descripcion, ' / ', a.ano_inicio)
								else ''
						end as inicio,
						case
								when a.mes_fin <> '' and a.ano_fin <> '' then concat(a3.descripcion, ' / ', a.ano_fin)
								else ''
						end as fin,
						a.presente,
						a.area,
						a.subarea,
						a4.industria,
						a.responsabilidades
				from
						can_experiencias a
								left outer join
								cat_paises a1
								on a1.pais = a.pais
										left outer join
										cat_meses a2
										on a2.mes = a.mes_inicio
												left outer join
												cat_meses a3
												on a3.mes = a.mes_fin
														left outer join
														cat_industrias a4
														on a4.industria = a.industria
				where
						1 = 1
						and a.candidato = '%candidato%'
				order by
						a.candidato,
						a.secuencia
		";
		
		$sql = str_replace("%candidato%", $this->candidato, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["candidato"] = $registro["candidato"];
			$elemento["secuencia"] = $registro["secuencia"];
			
			$elemento["titulo"] = $registro["titulo"];
			$elemento["empresa"] = $registro["empresa"];
			$elemento["pais"] = $registro["pais"];
			$elemento["inicio"] = $registro["inicio"];
			$elemento["fin"] = $registro["fin"];
			$elemento["presente"] = $registro["presente"];
			$elemento["area"] = $registro["area"];
			$elemento["subarea"] = $registro["subarea"];
			$elemento["industria"] = $registro["industria"];
			$elemento["responsabilidades"] = $registro["responsabilidades"];
			
			$detalles[] = $elemento;
			
		}
		
		return $detalles;
		
	}

}

?>