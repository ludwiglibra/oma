<?PHP

class idiomas {
	
	/*
	** Propiedades
	*/
	
	private $funciones;
	private $conexion;
	
	private $candidato;
	private $secuencia;
	private $idioma;
	private $escrito;
	private $oral;
	
	/*
	** Constructor
	*/
	
	public function idiomas() {
		
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
	
	public function setIdioma($idioma) {
		$this->idioma = $idioma;
	}
	
	public function setEscrito($escrito) {
		$this->escrito = $escrito;
	}
	
	public function setOral($oral) {
		$this->oral = $oral;
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
	
	public function getIdioma() {
		return $this->idioma;
	}
	
	public function getEscrito() {
		return $this->escrito;
	}
	
	public function getOral() {
		return $this->oral;
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($candidato, $secuencia = "") {
		
		$salida = false;
		
		if ($secuencia == "") {
			
			$sql = "
					select 'X' as existe
					from can_idiomas a
					where a.candidato = '%candidato%'
			";
			
		} else {
			
			$sql = "
					select 'X' as existe
					from can_idiomas a
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
				from can_idiomas
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
				from can_idiomas
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
					select a.idioma, a.escrito, a.oral
					from can_idiomas a
					where a.candidato = '%candidato%'
					and a.secuencia = '%secuencia%'
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%secuencia%", $this->secuencia, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->idioma = $registro["idioma"];
			$this->escrito = $registro["escrito"];
			$this->oral = $registro["oral"];
			
		}
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
		
		if ($this->candidato != "" && $this->secuencia) {
			
			$sql = "
					insert into can_idiomas (candidato, secuencia, idioma, escrito, oral)
					values ('%candidato%', '%secuencia%', '%idioma%', '%escrito%', '%oral%')
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%secuencia%", $this->secuencia, $sql);
			$sql = str_replace("%idioma%", $this->idioma, $sql);
			$sql = str_replace("%escrito%", $this->escrito, $sql);
			$sql = str_replace("%oral%", $this->oral, $sql);
			
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
		
		if ($this->candidato != "" && $this->secuencia) {
			
			$sql = "
					update can_idiomas set
					idioma = '%idioma%',
					escrito = '%escrito%',
					oral = '%oral%'
					where candidato = '%candidato%'
					and secuencia = '%secuencia%'
			";
			
			$sql = str_replace("%candidato%", $this->candidato, $sql);
			$sql = str_replace("%secuencia%", $this->secuencia, $sql);
			$sql = str_replace("%idioma%", $this->idioma, $sql);
			$sql = str_replace("%escrito%", $this->escrito, $sql);
			$sql = str_replace("%oral%", $this->oral, $sql);
			
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
		
		if ($this->candidato != "" && $this->secuencia) {
			
			$sql = "
					delete from can_idiomas
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
	** Método Detalles
	*/
	
	public function Detalles($candidato) {
		
		$detalles = array();
		
		$sql = "
				select
						a.candidato,
						a.secuencia,
						a1.descripcion as idioma,
						a.escrito,
						a.oral
				from
						can_idiomas a
								left outer join
								cat_idiomas a1
								on a1.idioma = a.idioma
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
			$elemento["idioma"] = $registro["idioma"];
			$elemento["escrito"] = $registro["escrito"];
			$elemento["oral"] = $registro["oral"];
			
			$detalles[] = $elemento;
			
		}
		
		return $detalles;
		
	}

}

?>