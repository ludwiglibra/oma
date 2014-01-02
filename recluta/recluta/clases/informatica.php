<?PHP

class informatica {
	
	/*
	** Propiedades
	*/
	
	private $funciones;
	private $conexion;
	
	private $candidato;
	private $secuencia;
	private $area;
	private $conocimiento;
	private $nivel;
	
	/*
	** Constructor
	*/
	
	public function informatica() {
		
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
	
	public function setArea($area) {
		$this->area = $area;
	}
	
	public function setConocimiento($conocimiento) {
		$this->conocimiento = $conocimiento;
	}
	
	public function setNivel($nivel) {
		$this->nivel = $nivel;
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
	
	public function getArea() {
		return $this->area;
	}
	
	public function getConocimiento() {
		return $this->conocimiento;
	}
	
	public function getNivel() {
		return $this->nivel;
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($candidato, $secuencia = "") {
		
		$salida = false;
		
		if ($secuencia == "") {
			
			$sql = "
					select 'X' as existe
					from can_informatica a
					where a.candidato = '%candidato%'
			";
			
		} else {

			$sql = "
					select 'X' as existe
					from can_informatica a
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
				from can_informatica
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
				select count(secuencia) + 1 as secuencia
				from can_informatica
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
		
		if ($this->candidato != "" && $this->secuencia) {
			
			$sql = "
					select a.conocimiento, a.nivel
					from can_informatica a
					where a.candidato = '%candidato%'
					and a.secuencia = '%secuencia%'
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%secuencia%", $this->secuencia, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->conocimiento = $registro["conocimiento"];
			$this->nivel = $registro["nivel"];
			
		}
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
		
		if ($this->candidato != "") {
			
			$sql = "
					insert into can_informatica (candidato, secuencia, conocimiento, nivel)
					values ('%candidato%', '%secuencia%', '%conocimiento%', '%nivel%')
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%secuencia%", $this->secuencia, $sql);
			$sql = str_replace("%conocimiento%", $this->conocimiento, $sql);
			$sql = str_replace("%nivel%", $this->nivel, $sql);
			
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
					update can_informatica set
					conocimiento = '%conocimiento%',
					nivel = '%nivel%'
					where candidato = '%candidato%'
					and secuencia = '%secuencia%'
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%secuencia%", $this->secuencia, $sql);
			$sql = str_replace("%conocimiento%", $this->conocimiento, $sql);
			$sql = str_replace("%nivel%", $this->nivel, $sql);
			
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
					delete from can_informatica 
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
	** Método AgregarCatalogo
	*/
	
	public function AgregarCatalogo() {
		
		$resultado = false;
		
		$sql = "
				insert into cat_informatica (area, conocimiento)
				values ('%area%', '%conocimiento%')
		";
		
		$sql = str_replace("%area%", $this->area, $sql);
		$sql = str_replace("%conocimiento%", $this->conocimiento, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$resultado = true;
		}
		
		return $resultado;
		
	}
	
	/*
	** Método EliminarCatalogo
	*/
	
	public function EliminarCatalogo() {
		
		$resultado = false;
		
		$sql = "
				delete from cat_informatica 
				where area = '%area%'
				and conocimiento = '%conocimiento%'
		";
		
		$sql = str_replace("%area%", $this->area, $sql);
		$sql = str_replace("%conocimiento%", $this->conocimiento, $sql);
		
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
						a.conocimiento,
						a1.descripcion as nivel
				from
						can_informatica a
								left outer join
								cat_niveles a1
								on a1.nivel = a.nivel
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
			$elemento["conocimiento"] = $registro["conocimiento"];
			$elemento["nivel"] = $registro["nivel"];
			
			$detalles[] = $elemento;
			
		}
		
		return $detalles;
		
	}

}

?>