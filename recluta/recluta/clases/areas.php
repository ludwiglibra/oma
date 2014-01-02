<?PHP

class areas {
	
	/************************************************** Propiedades */
	
	private $funciones;
	private $conexion;
	
	private $area;
	private $descripcion;
	private $activo;
	
	/************************************************** Constructor */
	
	public function areas() {
		
		$this->funciones = new funciones();
		$this->conexion = new conexion();
		
	}
	
	/************************************************** Métodos SET */
	
	public function setArea($area) {
		$this->area = mysql_real_escape_string($area);
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
	
	public function getArea() {
		return $this->area;
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
					select a.area, a.descripcion, a.activo
					from sys_areas a
					where 1 = 1
					and (a.area like '%%busqueda%%'
					or a.descripcion like '%%busqueda%%')
					order by a.area asc
			";
			
			$sql = str_replace("%busqueda%", $busqueda, $sql);
			
		} else {
		
			$sql = "
					select a.area, a.descripcion, a.activo
					from sys_areas a
					order by a.area asc
			";
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["area"] = $registro["area"];
			$elemento["descripcion"] = $registro["descripcion"];
			$elemento["activo"] = $registro["activo"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
		
	/*
	** Método Existe
	*/
	
	public function Existe($area) {
		
		$salida = true;
		
		$sql = "
				select 'X' as existe
				from sys_areas
				where area = '%area%'
		";
		
		$sql = str_replace("%area%", $area, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) == 0) {
			$salida = false;
		}
		
		return $salida;
		
	}
	
	/*
	** Método Cargar
	*/
	
	public function Cargar() {
		
		if ($this->area != "") {
			
			$sql = "
					select area, descripcion, activo
					from sys_areas
					where area = '%area%'
			";
			
			$sql = str_replace("%area%", $this->area, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->area = $registro["area"];
			$this->descripcion = $registro["descripcion"];
			$this->activo = $registro["activo"];
			
		}
		
	}
	
	/*
	** Método Asignados
	*/
	
	public function Asignados () {
		
		$listado = array();
		
		if ($this->area != "") {
			
			$sql = "
					select a.usuario,concat(d.nombres, ' ', d.apellidos) as nombre, a.usuario as correo, c.descripcion as nivel
					from sys_areas_usuarios a, sys_usuarios b, sys_niveles_usuarios c, sys_generales d
					where a.area = '%area%'
					and b.usuario = a.usuario
					and c.nivel = b.nivel
					and d.usuario = a.usuario
			";
			
			$sql = str_replace("%area%", $this->area, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			while ($registro = $this->conexion->recorrer($tabla)) {
				
				$elemento = array();
				
				$elemento["usuario"] = $registro["usuario"];
				$elemento["nombre"] = $registro["nombre"];
				$elemento["correo"] = $registro["correo"];
				$elemento["nivel"] = $registro["nivel"];
				
				$listado[] = $elemento;
				
			}
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método Disponibles
	*/
	
	public function Disponibles() {
		
		$listado = array();
		
		if ($this->area != "") {
			
			$sql = "
					select a.usuario, concat(d.nombres, ' ', d.apellidos) as nombre, a.usuario as correo, b.descripcion as nivel
					from sys_usuarios a, sys_niveles_usuarios b, sys_generales d
					where b.nivel = a.nivel
					and d.usuario = a.usuario
					and not exists (
							select 1
							from sys_areas_usuarios z
							where z.area = '%area%'
							and z.usuario = a.usuario
					)
			";
			
			$sql = str_replace("%area%", $this->area, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			while ($registro = $this->conexion->recorrer($tabla)) {
				
				$elemento = array();
				
				$elemento["usuario"] = $registro["usuario"];
				$elemento["nombre"] = $registro["nombre"];
				$elemento["correo"] = $registro["correo"];
				$elemento["nivel"] = $registro["nivel"];
				
				$listado[] = $elemento;
				
			}
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método Asignar
	*/
	
	public function Asignar($usuario) {
		
		$resultado = false;
		
		if ($this->area != "" && $usuario != "") {
			
			$sql = "
					insert into sys_areas_usuarios
					values ('%area%', '%usuario%')
			";
			
			$sql = str_replace("%area%", $this->area, $sql);
			$sql = str_replace("%usuario%", $usuario, $sql);
			
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
	
	public function Desasignar($usuario) {
		
		$resultado = false;
		
		if ($this->area != "" && $usuario != "") {
			
			$sql = "
					delete from sys_areas_usuarios
					where area = '%area%'
					and usuario = '%usuario%'
			";
			
			$sql = str_replace("%area%", $this->area, $sql);
			$sql = str_replace("%usuario%", $usuario, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			}
			
		} 
		
		return $resultado;
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
		
		if ($this->area != "") {
			
			$sql = "
					insert into sys_areas
					values ('%area%', '%descripcion%', '%activo%')
			";
			
			$this->instante = $this->funciones->getFechaHora();
			
			$sql = str_replace("%area%", $this->area, $sql);
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
	** Método Actualizar
	*/
	
	public function Actualizar() {
		
		$resultado = false;
		
		if ($this->area != "") {
			
			$sql = "
					update sys_areas set
					descripcion = '%descripcion%',
					activo = '%activo%'
					where area = '%area%'
			";
			
			$sql = str_replace("%area%", $this->area, $sql);
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
	** Método ListadoActivas
	*/
	
	public function ListadoActivas($usuario = "") {
		
		$listado = array();
		
		if ($usuario == "") {
		
			$sql = "
					select a.area, a.descripcion
					from sys_areas a
					where a.activo = 'X'
					order by a.area asc
			";
		
		} else {
			
			$sql = "
					select a.area, a.descripcion
					from sys_areas a
					where a.activo = 'X'
					and exists (
						select 1
						from sys_areas_usuarios z
						where z.area = a.area
						and z.usuario = '%usuario%'
					)
					order by a.area asc
			";
			
			$sql = str_replace("%usuario%", $usuario, $sql);
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["area"] = $registro["area"];
			$elemento["descripcion"] = $registro["descripcion"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}

}

?>