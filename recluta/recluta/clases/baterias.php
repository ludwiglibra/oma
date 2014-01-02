<?PHP

class baterias {
	
	/************************************************** Propiedades */
	
	private $funciones;
	private $conexion;
	
	private $bateria;
	private $titulo;
	private $descripcion;
	private $area;
	private $activo;
	
	/************************************************** Constructor */
	
	public function baterias() {
		
		$this->funciones = new funciones();
		$this->conexion = new conexion();
		
	}
	
	/************************************************** Métodos SET */
	
	public function setBateria($bateria) {
		$this->bateria = $bateria;
	}
	
	public function setTitulo($titulo) {
		$this->titulo = mysql_real_escape_string($titulo);
	}
	
	public function setDescripcion($descripcion) {
		$this->descripcion = mysql_real_escape_string($descripcion);
	}
		
	public function setArea($area) {
		$this->area = $area;
	}
		
	public function setActivo($activo) {
		$this->activo = $activo;
	}
	
	/*
	** Métodos GET
	*/
	
	public function getBateria() {
		return $this->bateria;
	}
	
	public function getTitulo() {
		return $this->titulo;
	}
	
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	public function getArea() {
		return $this->area;
	}
	
	public function getActivo() {
		return $this->activo;
	}
	
	/*
	** Método ListadoUsuario
	*/
	
	public function ListadoUsuario($usuario, $busqueda = "") {
		
		$listado = array();
		
		if ($busqueda != "") {
			
			$sql = "
					select a.bateria, a.titulo, a.descripcion, b.descripcion as area, a.activo
					from eva_baterias a, sys_areas b
					where 1 = 1
					and b.area = a.area
					and (a.bateria like '%%busqueda%%'
					or a.titulo like '%%busqueda%%'
					or a.descripcion like '%%busqueda%%'
					or b.descripcion like '%%busqueda%%')
					and exists (
							select 1
							from sys_areas_usuarios z
							where z.area = a.area
							and z.usuario = '%usuario%'
					)
			";
			
			$sql = str_replace("%busqueda%", $busqueda, $sql);
			
		} else {
			
			$sql = "
					select a.bateria, a.titulo, a.descripcion, b.descripcion as area, a.activo
					from eva_baterias a, sys_areas b
					where 1 = 1
					and b.area = a.area
					and exists (
							select 1
							from sys_areas_usuarios z
							where z.area = a.area
							and z.usuario = '%usuario%'
					)
			";
			
		}
		
		$sql = str_replace("%usuario%", $usuario, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["bateria"] = $registro["bateria"];
			$elemento["titulo"] = $registro["titulo"];
			$elemento["descripcion"] = $registro["descripcion"];
			$elemento["area"] = $registro["area"];
			$elemento["activo"] = $registro["activo"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($bateria) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from eva_baterias a
				where a.bateria = '%bateria%'
		";
		
		$sql = str_replace("%bateria%", $bateria, $sql);
			
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
		
		if ($this->bateria != "" && $this->titulo != "" && $this->descripcion != "" && $this->area != "") {
			
			$sql = "
					insert into eva_baterias
					values ('%bateria%', '%titulo%', '%descripcion%', '%area%', '%activo%') 
			";
			
			$sql = str_replace("%bateria%", $this->bateria, $sql);
			$sql = str_replace("%titulo%", $this->titulo, $sql);
			$sql = str_replace("%descripcion%", $this->descripcion, $sql);
			$sql = str_replace("%area%", $this->area, $sql);
			$sql = str_replace("%activo%", $this->activo, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			} 
			
		}
		
		return $resultado;
		
	}
	
	/*
	** Método Elegible
	*/
	
	public function Elegible($usuario, $bateria) {
		
		$resultado = false;
		
		$sql = "
				select 'X' as existe
				from sys_usuarios a, sys_areas_usuarios b, eva_baterias c
				where a.usuario = '%usuario%'
				and b.usuario = a.usuario
				and c.area = b.area
				and c.bateria = '%bateria%'
		";
		
		$sql = str_replace("%usuario%", $usuario, $sql);
		$sql = str_replace("%bateria%", $bateria, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) > 0) {
			$resultado = true;
		}
		
		return $resultado;
		
	}
	
	/*
	** Método Cargar
	*/
	
	public function Cargar() {
		
		if ($this->bateria != "") {
			
			$sql = "
					select a.bateria, a.titulo, a.descripcion, a.area, a.activo
					from eva_baterias a, sys_areas b
					where a.bateria = '%bateria%'
			";
			
			$sql = str_replace("%bateria%", $this->bateria, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->bateria = $registro["bateria"];
			$this->titulo = $registro["titulo"];
			$this->descripcion = $registro["descripcion"];
			$this->area = $registro["area"];
			$this->activo = $registro["activo"];
			
		}
		
	}
	
	/*
	** Método Actualizar
	*/
	
	public function Actualizar() {
		
		$resultado = false;
		
		if ($this->bateria != "") {
			
			$sql = "
					update eva_baterias set
					titulo = '%titulo%',
					descripcion = '%descripcion%',
					area = '%area%',
					activo = '%activo%'
					where bateria = '%bateria%'
			";
			
			$sql = str_replace("%bateria%", $this->bateria, $sql);
			$sql = str_replace("%titulo%", $this->titulo, $sql);
			$sql = str_replace("%descripcion%", $this->descripcion, $sql);
			$sql = str_replace("%area%", $this->area, $sql);
			$sql = str_replace("%activo%", $this->activo, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			} 
			
		}
		
		return $resultado;
		
	}
	
	/*
	** Método ListadoEvaluacionesAsignadas
	*/
	
	public function ListadoEvaluacionesAsignadas() {
		
		$listado = array();
		
		if ($this->bateria != "") {
			
			$sql = "
					select a.evaluacion, b.descripcion as titulo, a.secuencia
					from eva_baterias_evaluaciones a, eva_evaluaciones b
					where a.bateria = '%bateria%'
					and b.evaluacion = a.evaluacion
					order by a.secuencia asc, a.evaluacion asc
			";
			
			$sql = str_replace("%bateria%", $this->bateria, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			while ($registro = $this->conexion->recorrer($tabla)) {
				
				$elemento = array();
				
				$elemento["evaluacion"] = $registro["evaluacion"];
				$elemento["titulo"] = $registro["titulo"];
				$elemento["secuencia"] = $registro["secuencia"];
				
				$listado[] = $elemento;
				
			}
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoEvaluacionesDisponibles
	*/
	
	public function ListadoEvaluacionesDisponibles() {
		
		$listado = array();
		
		if ($this->bateria != "") {
			
			$sql = "
					select a.evaluacion, a.titulo
					from eva_evaluaciones a
					where 1 = 1
					and a.activo = 'X'
					and not exists (
							select 1
							from eva_baterias_evaluaciones z
							where z.bateria = '%bateria%'
							and z.evaluacion = a.evaluacion
					)
			";
			
			$sql = str_replace("%bateria%", $this->bateria, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			while ($registro = $this->conexion->recorrer($tabla)) {
				
				$elemento = array();
				
				$elemento["evaluacion"] = $registro["evaluacion"];
				$elemento["titulo"] = $registro["titulo"];
				
				$listado[] = $elemento;
				
			}
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método Asignar
	*/
	
	public function Asignar($evaluacion) {
		
		$resultado = false;
		
		if ($this->bateria != "" && $evaluacion != "") {
			
			$sql = "
					select count(*) + 1 as siguiente
					from eva_baterias_evaluaciones
					where bateria = '%bateria%'
			";
			
			$sql = str_replace("%bateria%", $this->bateria, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$secuencia = $registro["siguiente"];
			
			$sql = "
					insert into eva_baterias_evaluaciones
					values ('%bateria%', '%evaluacion%', '%secuencia%')
			";
			
			$sql = str_replace("%bateria%", $this->bateria, $sql);
			$sql = str_replace("%evaluacion%", $evaluacion, $sql);
			$sql = str_replace("%secuencia%", $secuencia, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			}
			
		} 
		
		return $resultado;
		
	}
	
	/*
	** Método Desasignar
	*/
	
	public function Desasignar($evaluacion) {
		
		$resultado = false;
		
		if ($this->bateria != "" && $evaluacion != "") {
			
			$sql = "
					delete from eva_baterias_evaluaciones
					where bateria = '%bateria%'
					and evaluacion = '%evaluacion%'
			";
			
			$sql = str_replace("%bateria%", $this->bateria, $sql);
			$sql = str_replace("%evaluacion%", $evaluacion, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			}
			
		} 
		
		return $resultado;
		
	}
	
}

?>