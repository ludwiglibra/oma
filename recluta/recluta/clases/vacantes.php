<?PHP

class vacantes {
	
	/************************************************** Propiedades */
	
	private $conexion;
	private $funciones2;
	private $correo;
	private $candidatos;
	
	private $vacante;
	private $tipo; 
	private $ubicacion;
	private $area;
	private $titulo;
	private $descripcion;
	private $anexo;
	private $formacion;
	private $conocimientos;
	private $experiencia;
	private $funciones;
	private $competencias;
	private $discapacidades;
	private $inicio;
	private $fin;
	private $creador;
	private $activo;
	
	/************************************************** Constructor */
	
	public function vacantes() {
		
		$this->conexion = new conexion();
		$this->funciones2 = new funciones();
		$this->correo = new correo();
		$this->candidatos = new candidatos();
		
	}
	
	/************************************************** Métodos SET */
	
	public function setVacante($vacante) {
		$this->vacante = $vacante;
	}
	
	public function setTipo($tipo) {
		$this->tipo = ($tipo == "I") ? "I" : "E";
	}
	
	public function setUbicacion($ubicacion) {
		$this->ubicacion = $ubicacion;
	}
	
	public function setArea($area) {
		$this->area = $area;
	}
	
	public function setTitulo($titulo) {
		$this->titulo = mysql_real_escape_string($titulo);
	}
	
	public function setDescripcion($descripcion) {
		$this->descripcion = mysql_real_escape_string($descripcion);
	}
	
	public function setAnexo($anexo) {
		$this->anexo = $anexo;
	}
	
	public function setFormacion($formacion) {
		$this->formacion = $formacion;
	}
	
	public function setConocimientos($conocimientos) {
		$this->conocimientos = $conocimientos;
	}
	
	public function setExperiencia($experiencia) {
		$this->experiencia = $experiencia;
	}
	
	public function setFunciones($funciones) {
		$this->funciones = $funciones;
	}
	
	public function setCompetencias($competencias) {
		$this->competencias = $competencias;
	}
	
	public function setDiscapacidades($discapacidades) {
		$this->discapacidades = $discapacidades;
	}
	
	public function setInicio($inicio) {
		$this->inicio = $inicio;
	}
	
	public function setFin($fin) {
		$this->fin = $fin;
	}
	
	public function setActivo($activo) {
		$this->activo = $activo;
	}
	
	/*
	** Métodos GET
	*/
	
	public function getVacante() {
		return $this->vacante;
	}
	
	public function getTipo() {
		return $this->tipo;
	}
	
	public function getUbicacion() {
		return $this->ubicacion;
	}
	
	public function getArea() {
		return $this->area;
	}
	
	public function getTitulo() {
		return $this->titulo;
	}
	
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	public function getAnexo() {
		return $this->anexo;
	}
	
	public function getFormacion() {
		return $this->formacion;
	}
	
	public function getConocimientos() {
		return $this->conocimientos;
	}
	
	public function getExperiencia() {
		return $this->experiencia;
	}
	
	public function getFunciones() {
		return $this->funciones;
	}
	
	public function getCompetencias() {
		return $this->competencias;
	}
	
	public function getDiscapacidades() {
		return $this->discapacidades;
	}
	
	public function getInicio() {
		return $this->inicio;
	}
	
	public function getFin() {
		return $this->fin;
	}
	
	public function getActivo() {
		return $this->activo;
	}
	
	/*
	** Método Elegible
	*/
	
	public function Elegible($usuario, $vacante) {
		
		$resultado = false;
		
		$sql = "
				select 'X' as existe
				from sys_usuarios a, sys_areas_usuarios b, vac_vacantes c
				where a.usuario = '%usuario%'
				and b.usuario = a.usuario
				and c.area = b.area
				and c.vacante = '%vacante%'
		";
		
		$sql = str_replace("%usuario%", $usuario, $sql);
		$sql = str_replace("%vacante%", $vacante, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) > 0) {
			$resultado = true;
		}
		
		return $resultado;
		
	}
	
	/*
	** Método ListadoTotal
	*/
	
	public function ListadoTotal($usuario = "") {
		
		$listado = array();
		
		if ($usuario != "") {
			
			$sql = "
					select a.vacante, a.tipo, a.ubicacion, b.descripcion as area, a.titulo, a.descripcion, a.anexo, 
					a.formacion, a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades, 
					a.inicio, a.fin, a.activo
					from vac_vacantes a, sys_areas b
					where exists (
						select 1
						from sys_areas_usuarios z
						where z.usuario = '%usuario%'
						and z.area = a.area
					)
					and b.area = a.area
					order by a.vacante desc
					limit 0, 100
			";
			
			$sql = str_replace("%usuario%", $usuario, $sql);
			
		} else {
			
			$sql = "
					select a.vacante, a.tipo, a.ubicacion, b.descripcion as area, a.titulo, a.descripcion, a.anexo, 
					a.formacion, a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades, 
					a.inicio, a.fin, a.activo
					from vac_vacantes a, sys_areas b
					where 1 = 1
					and b.area = a.area
					order by a.vacante desc
					limit 0, 100
			";
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["vacante"] = $registro["vacante"];
			$elemento["tipo"] = $registro["tipo"];
			$elemento["ubicacion"] = $registro["ubicacion"];
			$elemento["area"] = $registro["area"];			
			$elemento["titulo"] = $registro["titulo"];
			$elemento["descripcion"] = $registro["descripcion"];
			$elemento["anexo"] = $registro["anexo"];
			$elemento["formacion"] = $registro["formacion"];
			$elemento["conocimientos"] = $registro["conocimientos"];
			$elemento["experiencia"] = $registro["experiencia"];
			$elemento["funciones"] = $registro["funciones"];
			$elemento["competencias"] = $registro["competencias"];
			$elemento["discapacidades"] = $registro["discapacidades"];
			$elemento["inicio"] = $registro["inicio"];
			$elemento["fin"] = $registro["fin"];
			$elemento["activo"] = $registro["activo"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoVigentes
	*/
	
	public function ListadoVigentes($usuario = "", $busqueda = "", $ordenamiento = "") {
		
		$listado = array();
		
		if ($usuario != "") {
			
			if ($busqueda != "") {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades, 
						a.inicio, a.fin, a.activo, 
						a.fin - date(now()) as diferencia
						from vac_vacantes a
						where date(now()) between a.inicio and a.fin
						and (a.ubicacion like '%%busqueda%%'
						or a.titulo like '%%busqueda%%'
						or a.descripcion like '%%busqueda%%'
						or a.formacion like '%%busqueda%%'
						or a.conocimientos like '%%busqueda%%'
						or a.experiencia like '%%busqueda%%'
						or a.funciones like '%%busqueda%%'
						or a.competencias like '%%busqueda%%'
						or a.discapacidades like '%%busqueda%%')
						and exists (
							select 1
							from sys_areas_usuarios z
							where z.usuario = '%usuario%'
							and z.area = a.area
						)
						%ordenamiento%
						limit 0, 100
				";
				
				$sql = str_replace("%busqueda%", $busqueda, $sql);
				
			} else {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades,
						a.inicio, a.fin, a.activo, 
						a.fin - date(now()) as diferencia
						from vac_vacantes a
						where date(now()) between a.inicio and a.fin
						and exists (
							select 1
							from sys_areas_usuarios z
							where z.usuario = '%usuario%'
							and z.area = a.area
						)
						%ordenamiento%
						limit 0, 100
				";
				
			}
			
			$sql = str_replace("%usuario%", $usuario, $sql);
			
		} else {
			
			if ($busqueda != "") {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades,
						a.inicio, a.fin, a.activo, 
						a.fin - date(now()) as diferencia
						from vac_vacantes a
						where date(now()) between a.inicio and a.fin
						and (a.ubicacion like '%%busqueda%%'
						or a.titulo like '%%busqueda%%'
						or a.descripcion like '%%busqueda%%'
						or a.formacion like '%%busqueda%%'
						or a.conocimientos like '%%busqueda%%'
						or a.experiencia like '%%busqueda%%'
						or a.funciones like '%%busqueda%%'
						or a.competencias like '%%busqueda%%'
						or a.discapacidades like '%%busqueda%%')
						%ordenamiento%
						limit 0, 100
				";
				
				$sql = str_replace("%busqueda%", $busqueda, $sql);
				
			} else {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades,
						a.inicio, a.fin, a.activo, 
						a.fin - date(now()) as diferencia
						from vac_vacantes a, sys_areas b
						where date(now()) between a.inicio and a.fin
						and b.area = a.area
						%ordenamiento%
						limit 0, 100
				";
				
			}
			
		}
		
		if ($ordenamiento != "") {
			$sql = str_replace("%ordenamiento%", "order by " . $ordenamiento . " asc", $sql);
		} else {
			$sql = str_replace("%ordenamiento%", "order by vacante desc", $sql);
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["vacante"] = $registro["vacante"];
			$elemento["tipo"] = $registro["tipo"];
			$elemento["ubicacion"] = $registro["ubicacion"];
			$elemento["area"] = $registro["area"];			
			$elemento["titulo"] = $registro["titulo"];
			$elemento["descripcion"] = $registro["descripcion"];
			$elemento["anexo"] = $registro["anexo"];
			$elemento["formacion"] = $registro["formacion"];
			$elemento["conocimientos"] = $registro["conocimientos"];
			$elemento["experiencia"] = $registro["experiencia"];
			$elemento["funciones"] = $registro["funciones"];
			$elemento["competencias"] = $registro["competencias"];
			$elemento["discapacidades"] = $registro["discapacidades"];
			$elemento["inicio"] = $registro["inicio"];
			$elemento["fin"] = $registro["fin"];
			$elemento["activo"] = $registro["activo"];
			$elemento["diferencia"] = $registro["diferencia"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoFuturas
	*/
	
	public function ListadoFuturas($usuario = "", $busqueda = "") {
		
		$listado = array();
		
		if ($usuario != "") {
			
			if ($busqueda != "") {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades,
						a.inicio, a.fin, a.activo
						from vac_vacantes a
						where a.inicio > date(now())
						and (a.titulo like '%%busqueda%%'
						or a.descripcion like '%%busqueda%%'
						or a.requisitos like '%%busqueda%%')
						and exists (
							select 1
							from sys_areas_usuarios z
							where z.usuario = '%usuario%'
							and z.area = a.area
						)
						order by a.vacante desc
						limit 0, 100
				";
				
				$sql = str_replace("%busqueda%", $busqueda, $sql);
				
			} else {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades,
						a.inicio, a.fin, a.activo
						from vac_vacantes a
						where a.inicio > date(now())
						and exists (
							select 1
							from sys_areas_usuarios z
							where z.usuario = '%usuario%'
							and z.area = a.area
						)
						order by a.vacante desc
						limit 0, 100
				";
				
			}
			
			$sql = str_replace("%usuario%", $usuario, $sql);
			
		} else {
			
			if ($busqueda != "") {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades,
						a.inicio, a.fin, a.activo
						from vac_vacantes a
						where a.inicio > date(now())
						and (a.titulo like '%%busqueda%%'
						or a.descripcion like '%%busqueda%%'
						or a.requisitos like '%%busqueda%%')
						order by a.vacante desc
						limit 0, 100
				";
				
				$sql = str_replace("%busqueda%", $busqueda, $sql);
				
			} else {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades,
						a.inicio, a.fin, a.activo
						from vac_vacantes a
						where a.inicio > date(now())
						order by a.vacante desc
						limit 0, 100
				";
				
			}
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["vacante"] = $registro["vacante"];
			$elemento["tipo"] = $registro["tipo"];
			$elemento["ubicacion"] = $registro["ubicacion"];
			$elemento["area"] = $registro["area"];			
			$elemento["titulo"] = $registro["titulo"];
			$elemento["descripcion"] = $registro["descripcion"];
			$elemento["anexo"] = $registro["anexo"];
			$elemento["formacion"] = $registro["formacion"];
			$elemento["conocimientos"] = $registro["conocimientos"];
			$elemento["experiencia"] = $registro["experiencia"];
			$elemento["funciones"] = $registro["funciones"];
			$elemento["competencias"] = $registro["competencias"];
			$elemento["discapacidades"] = $registro["discapacidades"];
			$elemento["inicio"] = $registro["inicio"];
			$elemento["fin"] = $registro["fin"];
			$elemento["activo"] = $registro["activo"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoPasadas
	*/
	
	public function ListadoPasadas($usuario = "", $busqueda = "") {
		
		$listado = array();
		
		if ($usuario != "") {
			
			if ($busqueda != "") {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades,
						a.inicio, a.fin, a.activo
						from vac_vacantes a
						where a.fin < date(now())
						and (a.titulo like '%%busqueda%%'
						or a.descripcion like '%%busqueda%%'
						or a.requisitos like '%%busqueda%%')
						and exists (
							select 1
							from sys_areas_usuarios z
							where z.usuario = '%usuario%'
							and z.area = a.area
						)
						order by a.vacante desc
						limit 0, 100
				";
				
				$sql = str_replace("%busqueda%", $busqueda, $sql);
				
			} else {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades,
						a.inicio, a.fin, a.activo
						from vac_vacantes a
						where a.fin < date(now())
						and exists (
							select 1
							from sys_areas_usuarios z
							where z.usuario = '%usuario%'
							and z.area = a.area
						)
						order by a.vacante desc
						limit 0, 100
				";
				
			}
			
			$sql = str_replace("%usuario%", $usuario, $sql);
			
		} else {
			
			if ($busqueda != "") {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades, 
						a.inicio, a.fin, a.activo
						from vac_vacantes a
						where a.fin < date(now())
						and (a.titulo like '%%busqueda%%'
						or a.descripcion like '%%busqueda%%'
						or a.requisitos like '%%busqueda%%')
						order by a.vacante desc
						limit 0, 100
				";
				
				$sql = str_replace("%busqueda%", $busqueda, $sql);
				
			} else {
				
				$sql = "
						select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
						a.conocimientos, a.experiencia, a.funciones, a.competencias,  a.discapacidades,
						a.inicio, a.fin, a.activo
						from vac_vacantes a
						where a.fin < date(now())
						order by a.vacante desc
						limit 0, 100
				";
				
			}
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["vacante"] = $registro["vacante"];
			$elemento["tipo"] = $registro["tipo"];
			$elemento["ubicacion"] = $registro["ubicacion"];
			$elemento["area"] = $registro["area"];			
			$elemento["titulo"] = $registro["titulo"];
			$elemento["descripcion"] = $registro["descripcion"];
			$elemento["anexo"] = $registro["anexo"];
			$elemento["formacion"] = $registro["formacion"];
			$elemento["conocimientos"] = $registro["conocimientos"];
			$elemento["experiencia"] = $registro["experiencia"];
			$elemento["funciones"] = $registro["funciones"];
			$elemento["competencias"] = $registro["competencias"];
			$elemento["discapacidades"] = $registro["discapacidades"];
			$elemento["inicio"] = $registro["inicio"];
			$elemento["fin"] = $registro["fin"];
			$elemento["activo"] = $registro["activo"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método Existe
	*/
	
	public function Existe($vacante) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from vac_vacantes a
				where a.vacante = '%vacante%'
		";
		
		$sql = str_replace("%vacante%", $vacante, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) > 0) {
			$salida = true;
		}
		
		return $salida;
		
	}
	
	/*
	** Método Vigente
	*/
	
	public function Vigente($vacante) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from vac_vacantes a
				where a.vacante = '%vacante%'
				and date(now()) between inicio and fin
		";
		
		$sql = str_replace("%vacante%", $vacante, $sql);
			
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
		
		if ($this->vacante != "") {
			
			$sql = "
					select a.vacante, a.tipo, a.ubicacion, a.area, a.titulo, a.descripcion, a.anexo, a.formacion, 
					a.conocimientos, a.experiencia, a.funciones, a.competencias, a.discapacidades,
					a.inicio, a.fin, a.creador, 
					a.activo
					from vac_vacantes a
					where a.vacante = '%vacante%'
			";
			
			$sql = str_replace("%vacante%", $this->vacante, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->vacante = $registro["vacante"];
			$this->tipo = $registro["tipo"];
			$this->ubicacion = $registro["ubicacion"];
			$this->area = $registro["area"];
			$this->titulo = $registro["titulo"];
			$this->descripcion = $registro["descripcion"];
			$this->anexo = $registro["anexo"];
			$this->formacion = $registro["formacion"];
			$this->conocimientos = $registro["conocimientos"];
			$this->experiencia = $registro["experiencia"];
			$this->funciones = $registro["funciones"];
			$this->competencias = $registro["competencias"];
			$this->discapacidades = $registro["discapacidades"];
			$this->inicio = $registro["inicio"];
			$this->fin = $registro["fin"];
			$this->creador = $registro["creador"];
			$this->activo = $registro["activo"];
			
		}
		
	}
	
	/*
	** Método Reservar
	*/
	
	public function Reservar() {
		
		$reservado = false;
		
		$maximo = 10;
		$contador = 0;
		$error = false;
		
		do {
			
			$sql = "
					select lpad(coalesce(max(vacante), sum(vacante), 0) + 1, 11, 0) as vacante
					from vac_vacantes
			";
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$this->vacante = $registro["vacante"];
			
			$sql = "insert into vac_vacantes (vacante, tipo, ubicacion, area, titulo, descripcion, anexo, formacion, conocimientos, experiencia, funciones, competencias, discapacidades, inicio, fin, creador, activo)
					values ('%vacante%', '%tipo%', '%ubicacion%', '%area%', '%titulo%', '%descripcion%', '%anexo%', '%formacion%', '%conocimientos%', '%experiencia%', '%funciones%', '%competencias%', '%discapacidades%', '%inicio%', '%fin%', '%creador%', '%activo%')
			";
			
			$sql = str_replace("%vacante%", $this->vacante, $sql);
			$sql = str_replace("%tipo%", "", $sql);
			$sql = str_replace("%ubicacion%", "", $sql);
			$sql = str_replace("%area%", "", $sql);
			$sql = str_replace("%titulo%", "", $sql);
			$sql = str_replace("%descripcion%", "", $sql);
			$sql = str_replace("%anexo%", "", $sql);
			$sql = str_replace("%formacion%", "", $sql);
			$sql = str_replace("%conocimientos%", "", $sql);
			$sql = str_replace("%experiencia%", "", $sql);
			$sql = str_replace("%funciones%", "", $sql);
			$sql = str_replace("%competencias%", "", $sql);
			$sql = str_replace("%discapacidades%", "", $sql);
			$sql = str_replace("%inicio%", "0000-00-00", $sql);
			$sql = str_replace("%fin%", "0000-00-00", $sql);
			$sql = str_replace("%creador%", "", $sql);
			$sql = str_replace("%activo%", "", $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$reservado = true;
			} else {
				$contador++;
			}
			
			if ($contador > $maximo) {
				$error = true;
			}
		
		} while ((!($reservado)) && (!($error)));
		
		return $reservado;
		
	}
	
	/*
	** Método Actualizar
	*/
	
	public function Actualizar() {
		
		$resultado = false;
		
		$sql = "
				update vac_vacantes set
				tipo = '%tipo%',
				ubicacion = '%ubicacion%',
				area = '%area%',
				titulo = '%titulo%',
				descripcion = '%descripcion%',
				anexo = '%anexo%',
				formacion = '%formacion%',
				conocimientos = '%conocimientos%',
				experiencia = '%experiencia%',
				funciones = '%funciones%',
				competencias = '%competencias%',
				discapacidades = '%discapacidades%',
				inicio = '%inicio%',
				fin = '%fin%',
				creador = '%creador%',
				activo = '%activo%'
				where vacante = '%vacante%'
		";
		
		$sql = str_replace("%vacante%", $this->vacante, $sql);
		$sql = str_replace("%tipo%", $this->tipo, $sql);
		$sql = str_replace("%ubicacion%", $this->ubicacion, $sql);
		$sql = str_replace("%area%", $this->area, $sql);
		$sql = str_replace("%titulo%", $this->titulo, $sql);
		$sql = str_replace("%descripcion%", $this->descripcion, $sql);
		$sql = str_replace("%anexo%", $this->anexo, $sql);
		$sql = str_replace("%formacion%", $this->formacion, $sql);
		$sql = str_replace("%conocimientos%", $this->conocimientos, $sql);
		$sql = str_replace("%experiencia%", $this->experiencia, $sql);
		$sql = str_replace("%funciones%", $this->funciones, $sql);
		$sql = str_replace("%competencias%", $this->competencias, $sql);
		$sql = str_replace("%discapacidades%", $this->discapacidades, $sql);
		$sql = str_replace("%inicio%", $this->inicio, $sql);
		$sql = str_replace("%fin%", $this->fin, $sql);
		$sql = str_replace("%creador%", $this->creador, $sql);
		$sql = str_replace("%activo%", $this->activo, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$resultado = true;
		}
		
		return $resultado;
		
	}
	
	/*
	** Método ListadoBateriasAsignadas
	*/
	
	public function ListadoBateriasAsignadas() {
		
		$listado = array();
		
		if ($this->vacante != "") {
			
			$sql = "
					select a.bateria, b.titulo, a.secuencia
					from vac_vacantes_baterias a, eva_baterias b
					where a.vacante = '%vacante%'
					and b.bateria = a.bateria
					order by a.secuencia asc, a.bateria asc
			";
			
			$sql = str_replace("%vacante%", $this->vacante, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			while ($registro = $this->conexion->recorrer($tabla)) {
				
				$elemento = array();
				
				$elemento["bateria"] = $registro["bateria"];
				$elemento["titulo"] = $registro["titulo"];
				$elemento["secuencia"] = $registro["secuencia"];
				
				$listado[] = $elemento;
				
			}
			
		}
		
		return $listado;
	}
	
	/*
	** Método ListadoBateriasDisponibles
	*/
	
	public function ListadoBateriasDisponibles() {
		
		$listado = array();
		
		if ($this->vacante != "") {
			
			$sql = "
					select a.bateria, a.titulo
					from eva_baterias a
					where a.activo = 'X'
					and not exists (
							select 1
							from vac_vacantes_baterias z
							where z.vacante = '%vacante%'
							and z.bateria = a.bateria
					)
					order by a.bateria asc
			";
			
			$sql = str_replace("%vacante%", $this->vacante, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			while ($registro = $this->conexion->recorrer($tabla)) {
				
				$elemento = array();
				
				$elemento["bateria"] = $registro["bateria"];
				$elemento["titulo"] = $registro["titulo"];
				
				$listado[] = $elemento;
				
			}
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método Asignar
	*/
	
	public function Asignar($bateria) {
		
		$resultado = false;
		
		if ($this->vacante != "" && $bateria != "") {
			
			$sql = "
					select count(*) + 1 as siguiente
					from vac_vacantes_baterias
					where vacante = '%vacante%'
			";
			
			$sql = str_replace("%vacante%", $this->vacante, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($tabla);
			
			$secuencia = $registro["siguiente"];
			
			$sql = "
					insert into vac_vacantes_baterias
					values ('%vacante%', '%bateria%', '%secuencia%')
			";
			
			$sql = str_replace("%vacante%", $this->vacante, $sql);
			$sql = str_replace("%bateria%", $bateria, $sql);
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
	
	public function Desasignar($bateria) {
		
		$resultado = false;
		
		if ($this->vacante != "" && $bateria != "") {
			
			$sql = "
					delete from vac_vacantes_baterias
					where vacante = '%vacante%'
					and bateria = '%bateria%'
			";
			
			$sql = str_replace("%vacante%", $this->vacante, $sql);
			$sql = str_replace("%bateria%", $bateria, $sql);
			
			//die($sql);
			
			if ($this->conexion->ejecutar($sql)) {
				$resultado = true;
			}
			
		} 
		
		return $resultado;
		
	}
	
	/*
	** Método ExistenEvaluacionesPendientes
	*/
	
	public function ExistenEvaluacionesPendientes($candidato, $vacante) {
		
		$resultado = false;
		
		$sql = "
				select
						b.bateria,
						b.secuencia,
						d.evaluacion,
						d.secuencia
				from
						vac_vacantes a,
						vac_vacantes_baterias b,
						eva_baterias c,
						eva_baterias_evaluaciones d,
						eva_evaluaciones e
				where
						1 = 1
						and a.vacante = '%vacante%'
						and a.activo = 'X'
						and b.vacante = a.vacante
						and c.bateria = b.bateria
						and c.activo = 'X'
						and d.bateria = c.bateria
						and e.evaluacion = d.evaluacion
						and e.activo = 'X'
						and not exists (
								select 1
								from vac_vacantes_respuestas z
								where z.candidato = '%candidato%'
								and z.vacante = a.vacante
								and z.bateria = b.bateria
								and z.evaluacion = d.evaluacion
						)
				order by
						b.secuencia asc, d.secuencia asc
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
		$sql = str_replace("%vacante%", $vacante, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) > 0) {
			$resultado = true;
		}
		
		return $resultado;
		
	}
	
	
	/*
	** Método EvaluacionPendienteSiguiente
	*/
	
	public function EvaluacionPendienteSiguiente($candidato, $vacante) {
		
		$salida = array();
		
		$sql = "
				select
						b.bateria, d.evaluacion
				from
						vac_vacantes a,
						vac_vacantes_baterias b,
						eva_baterias c,
						eva_baterias_evaluaciones d,
						eva_evaluaciones e
				where
						1 = 1
						and a.vacante = '%vacante%'
						and a.activo = 'X'
						and b.vacante = a.vacante
						and c.bateria = b.bateria
						and c.activo = 'X'
						and d.bateria = c.bateria
						and e.evaluacion = d.evaluacion
						and e.activo = 'X'
						and not exists (
								select 1
								from vac_vacantes_respuestas z
								where z.candidato = '%candidato%'
								and z.vacante = a.vacante
								and z.bateria = b.bateria
								and z.evaluacion = d.evaluacion
						)
				order by
						b.secuencia asc, d.secuencia asc
				limit
						0, 1
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
		$sql = str_replace("%vacante%", $vacante, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		$registro = $this->conexion->recorrer($tabla);
		
		$salida["bateria"] = $registro["bateria"];
		$salida["evaluacion"] = $registro["evaluacion"];
		
		return $salida;
		
	}
	
	/*
	** Método ListadoCandidatos
	*/
	
	public function ListadoCandidatos() {
		
		$listado = array();
		
		if ($this->vacante != "") {
			
			$sql = "
					select distinct
							a.candidato,
							concat(b.nombres, ' ', b.apellidos) as nombre,
							case
									when c.tipo = 'I' then 'Interno'
									else 'Externo'
							end as tipo,
							case
									when c.tipo = 'I' then c.empleado
									else ''
							end as empleado
					from vac_vacantes_candidatos a, sys_generales b, can_candidatos c
					where a.vacante = '%vacante%'
					and b.usuario = a.candidato
					and c.candidato = a.candidato
			";
			
			$sql = str_replace("%vacante%", $this->vacante, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			while ($registro = $this->conexion->recorrer($tabla)) {
				
				$elemento = array();
				
				$elemento["candidato"] = $registro["candidato"];
				$elemento["nombre"] = $registro["nombre"];
				$elemento["tipo"] = $registro["tipo"];
				$elemento["empleado"] = $registro["empleado"];
				
				$listado[] = $elemento;
				
			}
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método CandidatoAutorizado
	*/
	
	public function CandidatoAutorizado($vacante, $candidato) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from vac_vacantes_candidatos
				where vacante = '%vacante%'
				and candidato = '%candidato%'
				and autorizado = 'X'
		";
		
		$sql = str_replace("%vacante%", $vacante, $sql);
		$sql = str_replace("%candidato%", $candidato, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) == 1) {
			$salida = true;
		}
		
		return $salida;
		
	}
	
	/*
	** Método ExisteCandidato
	*/
	
	public function ExisteCandidato($vacante, $candidato) {
		
		$salida = false;
		
		$sql = "
				select 'X' as existe
				from vac_vacantes_candidatos
				where vacante = '%vacante%'
				and candidato = '%candidato%'
		";
		
		$sql = str_replace("%vacante%", $vacante, $sql);
		$sql = str_replace("%candidato%", $candidato, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		if ($this->conexion->lineas($tabla) == 1) {
			$salida = true;
		}
		
		return $salida;
		
	}
	
	/*
	** Método AgregarCandidato
	*/
	
	public function AgregarCandidato($vacante, $candidato) {
		
		$resultado = false;
		
		$sql = "
				insert into vac_vacantes_candidatos (vacante, candidato, instante, autorizado)
				values ('%vacante%', '%candidato%', '%instante%', '%autorizado%')
		";
		
		$instante = $this->funciones2->getFechaHora();
		$autorizado = "";
		
		$sql = str_replace("%vacante%", $vacante, $sql);
		$sql = str_replace("%candidato%", $candidato, $sql);
		$sql = str_replace("%instante%", $instante, $sql);
		$sql = str_replace("%autorizado%", $autorizado, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$resultado = true;
		}
		
		return $resultado;
		
	}
	
	/*
	** Método AvisarGenerador
	*/
	
	public function AvisarGenerador($vacante, $candidato) {
		
		$resultado = false;
		
		$mensaje = "
					<html>
						<head>
							<title>Candidato Interesado en Vacante</title>
						</head>
						<body>
							<p>
								El candidato %candidato% está interesado en participar en la vacante %vacante%. Favor de ingresar al sistema y autorizarlo.
							</p>
						</body>
					</html>
		";
		
		$mensaje = str_replace("%vacante%", $vacante, $mensaje);
		$mensaje = str_replace("%candidato%", $candidato, $mensaje);
		
		//die($mensaje);
		
		$this->candidatos->setCandidato($candidato);
		$this->candidatos->Cargar();
		
		$this->correo->setPara($this->creador);
		$this->correo->setAsunto("Candidato interesado en vacante");
		$this->correo->setMensaje($mensaje);
		
		if ($this->correo->Enviar()) {
			$resultado = true;
		} 
		
		return $resultado;
		
	}
	
	/*
	** Método AutorizacionCandidato
	*/
	
	public function AutorizacionCandidato($vacante, $candidato, $autorizacion) {
		
		$resultado = false;
		
		$autorizacion = ($autorizacion == "X") ? "X" : "";
		
		$sql = "
				update vac_vacantes_candidatos 
				set autorizado = '%autorizacion%'
				where vacante = '%vacante%'
				and candidato = '%candidato%'
		";
				
		$sql = str_replace("%vacante%", $vacante, $sql);
		$sql = str_replace("%candidato%", $candidato, $sql);
		$sql = str_replace("%autorizacion%", $autorizacion, $sql);
		
		//die($sql);
		
		if ($this->conexion->ejecutar($sql)) {
			$resultado = true;
		}
		
		return $resultado;
		
	}
	
	/*
	** Método ExistenManuales
	*/
	
	public function ExistenManuales($candidato, $vacante) {
		
		$resultado = false;
		
		$sql = "
				select 'X' as existe
				from vac_vacantes_respuestas
				where candidato = '%candidato%'
				and vacante = '%vacante%'
				and respuesta = '0'
				and valor = ''
		";
		
		$sql = str_replace("%candidato%", $candidato, $sql);
		$sql = str_replace("%vacante%", $vacante, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		$lineas = $this->conexion->lineas($tabla);
		
		if ($lineas > 0) {
			$resultado = true;
		}
		
		return $resultado;
		
	}
	
	/*
	** Método ListadoManuales
	*/
	
	public function ListadoManuales($vacante, $candidato) {
		
		$listado = array();
		
		$sql = "
				select vacante, candidato, bateria, bateria_sec, evaluacion, evaluacion_sec, pregunta, pregunta_txt, respuesta, respuesta_txt, valor
				from vac_vacantes_respuestas
				where vacante = '%vacante%'
				and candidato = '%candidato%'
				and respuesta = '0'
				and valor = ''
				order by bateria_sec asc, evaluacion_sec asc, pregunta asc
		";
		
		$sql = str_replace("%vacante%", $vacante, $sql);
		$sql = str_replace("%candidato%", $candidato, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["vacante"] = $registro["vacante"];
			$elemento["candidato"] = $registro["candidato"];
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
	
	public function DatosGenerales($vacante) {
		
		$elemento = array();
		
		$sql = "
				select
						a.vacante,
						case
								when a.tipo = 'E' then 'Externo'
								else 'Interno'
						end as tipo,
						a.ubicacion,
						a1.descripcion as area,
						a.titulo,
						a.descripcion,
						a.anexo,
						a.formacion,
						a.conocimientos,
						a.experiencia,
						a.funciones,
						a.competencias,
						a.discapacidades,
						date_format(a.inicio, '%d-%m-%Y') as inicio,
						date_format(a.fin, '%d-%m-%Y') as fin
				from
						vac_vacantes a
								left outer join
								sys_areas a1
								on a1.area = a.area
				
				where
						1 = 1
						and a.vacante = '%vacante%'
		";
		
		$sql = str_replace("%vacante%", $vacante, $sql);
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		$registro = $this->conexion->recorrer($tabla);
		
		$elemento["vacante"] = $registro["vacante"];
		$elemento["tipo"] = $registro["tipo"];
		$elemento["ubicacion"] = $registro["ubicacion"];
		$elemento["area"] = $registro["area"];
		$elemento["titulo"] = $registro["titulo"];
		$elemento["descripcion"] = $registro["descripcion"];
		$elemento["anexo"] = $registro["anexo"];
		$elemento["formacion"] = $registro["formacion"];
		$elemento["conocimientos"] = $registro["conocimientos"];
		$elemento["experiencia"] = $registro["experiencia"];
		$elemento["funciones"] = $registro["funciones"];
		$elemento["competencias"] = $registro["competencias"];
		$elemento["discapacidades"] = $registro["discapacidades"];
		$elemento["inicio"] = $registro["inicio"];
		$elemento["fin"] = $registro["fin"];
		
		return $elemento;
		
	}
	
}

?>