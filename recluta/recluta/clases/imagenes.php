<?PHP

class imagenes {
	
	/*
	** Propiedades
	*/
	
	private $funciones;
	private $conexion;
	
	private $imagen;
	private $titulo;
	private $descripcion;
	private $liga;
	private $archivo;
	private $activo;
	
	/*
	** Constructor
	*/
	
	public function imagenes() {
		
		$this->funciones = new funciones();
		$this->conexion = new conexion();
		
	}
	
	/*
	** Métodos SET
	*/
	
	public function setImagen($imagen) {
		$this->imagen = $imagen;
	}
	
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}
	
	public function setLiga($liga) {
		$this->liga = $liga;
	}
	
	public function setArchivo($archivo) {
		$this->archivo = $archivo;
	}
	
	public function setActivo($activo) {
		$this->activo = ($activo == "X") ? "X" : "";
	}
	
	/*
	** Métodos GET
	*/
	
	public function getImagen() {
		return $this->imagen;
	}
	
	public function getTitulo() {
		return $this->titulo;
	}
	
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	public function getLiga() {
		return $this->liga;
	}
	
	public function getArchivo() {
		return $this->archivo;
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
					select imagen, titulo, descripcion, liga, archivo, activo
					from sys_imagenes
					where 1 = 1
					and (titulo like '%%busqueda%%'
					or descripcion like '%%busqueda%%'
					or liga like '%%busqueda%%')
			";
			
			$sql = str_replace("%busqueda%", $busqueda, $sql);
			
		} else {
			
			$sql = "
					select imagen, titulo, descripcion, liga, archivo, activo
					from sys_imagenes
			";
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["imagen"] = $registro["imagen"];
			$elemento["titulo"] = $registro["titulo"];
			$elemento["descripcion"] = $registro["descripcion"];
			$elemento["liga"] = $registro["liga"];
			$elemento["archivo"] = $registro["archivo"];
			$elemento["activo"] = $registro["activo"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoActivos
	*/
	
	public function ListadoActivos($busqueda = "") {
		
		$listado = array();
		
		if ($busqueda != "") {
			
			$sql = "
					select imagen, titulo, descripcion, liga, archivo, activo
					from sys_imagenes
					where 1 = 1
					and (titulo like '%%busqueda%%'
					or descripcion like '%%busqueda%%'
					or liga like '%%busqueda%%')
					and activo = 'X'
			";
			
			$sql = str_replace("%busqueda%", $busqueda, $sql);
			
		} else {
			
			$sql = "
					select imagen, titulo, descripcion, liga, archivo, activo
					from sys_imagenes
					where activo = 'X'
			";
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["imagen"] = $registro["imagen"];
			$elemento["titulo"] = $registro["titulo"];
			$elemento["descripcion"] = $registro["descripcion"];
			$elemento["liga"] = $registro["liga"];
			$elemento["archivo"] = $registro["archivo"];
			$elemento["activo"] = $registro["activo"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
		
		if ($this->imagen != "" && $this->titulo != "" && $this->archivo != "") {
			
			$sql = "
					insert into sys_imagenes (imagen, titulo, descripcion, liga, archivo)
					values ('%imagen%', '%titulo%', '%descripcion%', '%liga%', '%archivo%')
			";
			
			$sql = str_replace("%imagen%", $this->imagen, $sql);
			$sql = str_replace("%titulo%", $this->titulo, $sql);
			$sql = str_replace("%descripcion%", $this->descripcion, $sql);
			$sql = str_replace("%liga%", $this->liga, $sql);
			$sql = str_replace("%archivo%", $this->archivo, $sql);
			$sql = str_replace("%activo%", $this->activo, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			}
			
		} 
		
		return $resultado;
		
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($imagen) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from sys_imagenes a
				where a.imagen = '%imagen%'
		";
		
		$sql = str_replace("%imagen%", $imagen, $sql);
			
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
		
		if ($this->imagen != "") {
			
			$sql = "
					select a.imagen, a.titulo, a.descripcion, a.liga, a.archivo, a.activo
					from sys_imagenes a
					where a.imagen = '%imagen%'
			";
			
			$sql = str_replace("%imagen%", $this->imagen, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->imagen = $registro["imagen"];
			$this->titulo = $registro["titulo"];
			$this->descripcion = $registro["descripcion"];
			$this->liga = $registro["liga"];
			$this->archivo = $registro["archivo"];
			$this->activo = $registro["activo"];
			
		}
		
	}
	
	/*
	** Método Actualizar
	*/
	
	public function Actualizar() {
		
		$resultado = false;
		
		$sql = "
				update sys_imagenes set
				titulo = '%titulo%',
				descripcion = '%descripcion%',
				liga = '%liga%',
				activo = '%activo%'
				where imagen = '%imagen%'
		";
		
		$sql = str_replace("%imagen%", $this->imagen, $sql);
		$sql = str_replace("%titulo%", $this->titulo, $sql);
		$sql = str_replace("%descripcion%", $this->descripcion, $sql);
		$sql = str_replace("%liga%", $this->liga, $sql);
		$sql = str_replace("%activo%", $this->activo, $sql);
		
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
				delete from sys_imagenes 
				where imagen = '%imagen%'
		";
		
		$sql = str_replace("%imagen%", $this->imagen, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$resultado = true;
		}
		
		return $resultado;
		
	}
	
}

?>