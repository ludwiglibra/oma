<?PHP

class usuarios {
	
	/*
	** Propiedades
	*/
	
	private $funciones;
	private $sesion;
	private $conexion;
	
	private $usuario;
	private $clave;
	private $nivel;
	private $activo;
	
	/*
	** Constructor
	*/
	
	public function usuarios() {
		
		$this->funciones = new funciones();
		$this->sesion = new sesion();
		$this->conexion = new conexion();
		
	}
	
	/*
	** Métodos SET
	*/
	
	public function setUsuario($usuario) {
		$this->usuario = mysql_real_escape_string($usuario);
	}
	
	public function setClave($clave) {
		$this->clave = md5($clave);
	}
	
	public function setNivel($nivel) {
		$this->nivel = ($nivel >= 0 && $nivel <= 3) ? $nivel : 3;
	}
	
	public function setActivo($activo) {
		$this->activo = ($activo == "X") ? "X" : "";
	}
	
	/*
	** Métodos GET
	*/
	
	public function getUsuario() {
		return $this->usuario;
	}
	
	public function getClave() {
		return $this->clave;
	}
	
	public function getNivel() {
		return $this->nivel;
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
					select a.usuario, concat(a1.nombres, ' ', a1.apellidos) as nombre, b.descripcion as nivel, a.activo
					from (sys_usuarios a
						left outer join
						sys_generales a1
						on a1.usuario = a.usuario), 
					sys_niveles_usuarios b
					where b.nivel = a.nivel
					and (a.usuario like '%%busqueda%%'
					or a1.nombres like '%%busqueda%%'
					or a1.apellidos like '%%busqueda%%'
					or b.descripcion like '%%busqueda%%')
					order by a.usuario
			";
			
			$sql = str_replace("%busqueda%", $busqueda, $sql);
			
		} else {
		
			$sql = "
					select a.usuario, concat(a1.nombres, ' ', a1.apellidos) as nombre, b.descripcion as nivel, a.activo
					from (sys_usuarios a
						left outer join 
						sys_generales a1
						on a1.usuario = a.usuario), 
					sys_niveles_usuarios b
					where b.nivel = a.nivel
					order by a.usuario
			";
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["usuario"] = $registro["usuario"];
			$elemento["nombre"] = $registro["nombre"];
			$elemento["nivel"] = $registro["nivel"];
			$elemento["activo"] = $registro["activo"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoCandidatos
	*/
	
	public function ListadoCandidatos($busqueda = "") {
		
		$listado = array();
		
		if ($busqueda != "") {
			
			$sql = "
					select a.usuario, concat(a1.nombres, ' ', a1.apellidos) as nombre, b.descripcion as nivel, count(distinct a2.vacante) as vacantes, a.activo
					from
							((sys_usuarios a
									left outer join
									sys_generales a1
									on a1.usuario = a.usuario)
										left outer join
										vac_vacantes_candidatos a2
										on a2.candidato = a.usuario),
							sys_niveles_usuarios b
					where a.nivel = '3'
					and b.nivel = a.nivel
					and (a.usuario like '%%busqueda%%'
					or a1.nombres like '%%busqueda%%'
					or a1.apellidos like '%%busqueda%%'
					or b.descripcion like '%%busqueda%%')
					group by a.usuario, concat(a1.nombres, ' ', a1.apellidos), b.descripcion, a.activo
					order by a.usuario
			";
			
			$sql = str_replace("%busqueda%", $busqueda, $sql);
			
		} else {
		
			$sql = "
					select a.usuario, concat(a1.nombres, ' ', a1.apellidos) as nombre, b.descripcion as nivel, count(distinct a2.vacante) as vacantes, a.activo
					from
							((sys_usuarios a
									left outer join
									sys_generales a1
									on a1.usuario = a.usuario)
										left outer join
										vac_vacantes_candidatos a2
										on a2.candidato = a.usuario),
							sys_niveles_usuarios b
					where a.nivel = '3'
					and b.nivel = a.nivel
					group by a.usuario, concat(a1.nombres, ' ', a1.apellidos), b.descripcion, a.activo
					order by a.usuario
			";
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["usuario"] = $registro["usuario"];
			$elemento["nombre"] = $registro["nombre"];
			$elemento["nivel"] = $registro["nivel"];
			$elemento["vacantes"] = $registro["vacantes"];
			$elemento["activo"] = $registro["activo"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($usuario) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from sys_usuarios a
				where a.usuario = '%usuario%'
		";
		
		$sql = str_replace("%usuario%", $usuario, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) > 0) {
			$salida = true;
		}
		
		return $salida;
		
	}
	
	/*
	** HallarUsuarioConCorreo
	*/
	
	public function HallarUsuarioConCorreo($correo) {
		
		$usuario = "";
		
		if ($correo != "") {
			
			$sql = "
					select usuario
					from sys_usuarios
					where correo = '%correo%'
					order by usuario asc
			";
			
			$sql = str_replace("%correo%", $correo, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$usuario = $registro["usuario"];
			
		}
		
		return $usuario;
		
	}
	
	/*
	** HallarUsuarioConToken
	*/
	
	public function HallarUsuarioConToken($token) {
		
		$usuario = "";
		
		if ($token != "") {
			
			$sql = "
					select usuario
					from sys_usuarios
					where md5(md5(md5(usuario))) = '%token%'
					order by usuario asc
			";
			
			$sql = str_replace("%token%", $token, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$usuario = $registro["usuario"];
			
		}
		
		return $usuario;
		
	}
	
	/*
	** Método ExisteCorreo
	*/
	
	public function ExisteCorreo($correo) {
		
		$salida = true;
		
		$sql = "
				select 'X' as existe
				from sys_usuarios
				where correo = '%correo%'
		";
		
		$sql = str_replace("%correo%", $correo, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);

		if ($this->conexion->Lineas($tabla) == 0) {
			$salida = false;
		}
		
		return $salida;
		
	}
	
	/*
	** Método Cargar
	*/
	
	public function Cargar() {
		
		if ($this->usuario != "") {
			
			$sql = "
					select a.usuario, a.clave, a.nivel, a.activo
					from sys_usuarios a
					where a.usuario = '%usuario%'
			";
			
			$sql = str_replace("%usuario%", $this->usuario, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->usuario = $registro["usuario"];
			$this->clave = $registro["clave"];
			$this->nivel = $registro["nivel"];
			$this->activo = $registro["activo"];
			
		}
		
	}
	
	/*
	** Método Agregar
	*/
	
	public function Agregar() {
		
		$resultado = false;
		
		if ($this->usuario != "") {
			
			$sql = "
					insert into sys_usuarios
					values ('%usuario%', '%clave%', '%nivel%', '%activo%')
			";
			
			$this->instante = $this->funciones->getFechaHora();
			
			$sql = str_replace("%usuario%", $this->usuario, $sql);
			$sql = str_replace("%clave%", $this->clave, $sql);
			$sql = str_replace("%nivel%", $this->nivel, $sql);
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
		
		if ($this->usuario != "") {
			
			$sql = "
					update sys_usuarios set
					clave = '%clave%',
					nivel = '%nivel%',
					activo = '%activo%'
					where usuario = '%usuario%'
			";
			
			$this->instante = $this->funciones->getFechaHora();
			
			$sql = str_replace("%usuario%", $this->usuario, $sql);
			$sql = str_replace("%clave%", $this->clave, $sql);
			$sql = str_replace("%nivel%", $this->nivel, $sql);
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