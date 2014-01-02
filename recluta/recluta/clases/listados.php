<?PHP

class listados {
	
	/************************************************** Propiedades */
	
	private $funciones;
	private $sesion;
	private $conexion;
	
	/************************************************** Constructor */
	
	public function listados() {
		
		$this->funciones = new funciones();
		$this->sesion = new sesion();
		$this->conexion = new conexion();
		
	}
	
	/************************************************** Método ListadoModulos */
	
	public function ModulosUsuario($usuario) {
		
		$listado = array();
		
		if ($usuario != "") {
			
			$sql = "
					select d.modulo, d.descripcion
					from sys_usuarios a, sys_niveles_usuarios b, sys_niveles_modulos c, sys_modulos d
					where a.usuario = '%usuario%'
					and a.activo = 'X'
					and b.nivel = a.nivel
					and b.activo = 'X'
					and c.nivel = b.nivel
					and d.modulo = c.modulo
					and d.activo = 'X'
					order by d.secuencia asc
			";
			
			$sql = str_replace("%usuario%", $usuario, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			while ($registro = $this->conexion->recorrer($tabla)) {
				
				$elemento = array();
				
				$elemento["modulo"] = $registro["modulo"];
				$elemento["descripcion"] = $registro["descripcion"];
				
				$listado[] = $elemento;
				
			}
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoAccesosUsuario
	*/
	
	public function ListadoAccesosUsuario($usuario) {
		
		$listado = array();
		
		$sql = "
				select instante, ip, navegador
				from sys_accesos
				where usuario = '%usuario%'
				order by instante desc
				limit 0, 100
		";
		
		$sql = str_replace("%usuario%", $usuario, $sql);
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["instante"] = $registro["instante"];
			$elemento["ip"] = $registro["ip"];
			$elemento["navegador"] = $registro["navegador"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método NivelesActivos
	*/
	
	public function NivelesActivos() {
		
		$listado = array();
		
		$sql = "
				select a.nivel, a.descripcion
				from sys_niveles_usuarios a
				where a.activo = 'X'
				order by a.nivel desc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["nivel"] = $registro["nivel"];
			$elemento["descripcion"] = $registro["descripcion"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método UsuariosActivos
	*/
	
	public function UsuariosActivos() {
		
		$listado = array();
		
		$sql = "
				select a.usuario, concat(a1.nombres, ' ' ,a1.apellidos) as nombre, b.descripcion as nivel
				from (sys_usuarios a)
					left outer join
					sys_generales a1
					on a1.usuario = a.usuario, 
				sys_niveles_usuarios b
				where a.activo = 'X'
				and b.nivel = a.nivel
				order by a.usuario
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["usuario"] = $registro["usuario"];
			$elemento["nombre"] = $registro["nombre"];
			$elemento["nivel"] = $registro["nivel"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoPaises
	*/
	
	public function ListadoPaises() {
		
		$listado = array();
		
		$sql = "
				select pais, descripcion
				from cat_paises
				order by pais asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["pais"] = $registro["pais"];
			$elemento["descripcion"] = $registro["descripcion"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoGeneros
	*/
	
	public function ListadoGeneros() {
		
		$listado = array();
		
		$sql = "
				select genero, descripcion
				from cat_generos
				order by genero asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["genero"] = $registro["genero"];
			$elemento["descripcion"] = $registro["descripcion"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoCiviles
	*/
	
	public function ListadoCiviles() {
		
		$listado = array();
		
		$sql = "
				select civil, descripcion
				from cat_civiles
				order by civil asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["civil"] = $registro["civil"];
			$elemento["descripcion"] = $registro["descripcion"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoTipos
	*/
	
	public function ListadoTipos() {
		
		$listado = array();
		$elemento = array();
		
		$elemento["tipo"] = "";
		$elemento["descripcion"] = "";
		$listado[] = $elemento;
		
		$elemento["tipo"] = "E";
		$elemento["descripcion"] = "Candidato Externo";
		$listado[] = $elemento;
		
		$elemento["tipo"] = "I";
		$elemento["descripcion"] = "Candidato Interno";
		$listado[] = $elemento;
		
		return $listado;
		
	}
	
	/*
	** Método ListadoEscolaridades
	*/
	
	public function ListadoEscolaridades() {
		
		$listado = array();
		
		$sql = "
				select escolaridad, descripcion
				from cat_escolaridades
				order by escolaridad asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["escolaridad"] = $registro["escolaridad"];
			$elemento["descripcion"] = $registro["descripcion"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoIdiomas
	*/
	
	public function ListadoIdiomas() {
		
		$listado = array();
		
		$sql = "
				select idioma, descripcion
				from cat_idiomas
				order by idioma asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["idioma"] = $registro["idioma"];
			$elemento["descripcion"] = $registro["descripcion"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoAreas
	*/
	
	public function ListadoAreas() {
		
		$listado = array();
		
		$sql = "
				select distinct area
				from cat_informatica
				order by area asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["area"] = $registro["area"];
			$elemento["descripcion"] = $registro["area"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoConocimientos
	*/
	
	public function ListadoConocimientos() {
		
		$listado = array();
		
		$sql = "
				select concat(area, ' - ', conocimiento) as conocimiento
				from cat_informatica
				order by area asc, conocimiento asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["conocimiento"] = $registro["conocimiento"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoNiveles
	*/
	
	public function ListadoNiveles() {
		
		$listado = array();
		
		$sql = "
				select nivel, descripcion
				from cat_niveles
				order by nivel asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["nivel"] = $registro["nivel"];
			$elemento["descripcion"] = $registro["descripcion"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoSenioritys
	*/
	
	public function ListadoSenioritys() {
		
		$listado = array();
		
		$sql = "
				select seniority, descripcion
				from cat_senioritys
				order by seniority asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["seniority"] = $registro["seniority"];
			$elemento["descripcion"] = $registro["descripcion"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoMeses
	*/
	
	public function ListadoMeses() {
		
		$listado = array();
		
		$sql = "
				select mes, descripcion
				from cat_meses
				order by mes asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["mes"] = $registro["mes"];
			$elemento["descripcion"] = $registro["descripcion"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoIndustrias
	*/
	
	public function ListadoIndustrias() {
		
		$listado = array();
		
		$sql = "
				select industria
				from cat_industrias
				order by industria asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["industria"] = $registro["industria"];
			$elemento["descripcion"] = $registro["industria"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoSalarios
	*/
	
	public function ListadoSalarios() {
		
		$listado = array();
		
		$sql = "
				select salario, descripcion
				from cat_salarios
				order by salario asc
		";
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["salario"] = $registro["salario"];
			$elemento["descripcion"] = $registro["descripcion"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ListadoInformatica
	*/
	
	public function ListadoInformatica($busqueda = "") {
		
		$listado = array();
		
		if ($busqueda != "") {
			
			$sql = "
					select a.area, a.conocimiento
					from cat_informatica a
					where a.area like '%%busqueda%%'
					or a.conocimiento like '%%busqueda%%'
					order by a.area asc, a.conocimiento asc
			";
			
			$sql = str_replace("%busqueda%", $busqueda, $sql);
			
		} else {
			
			$sql = "
					select a.area, a.conocimiento
					from cat_informatica a
					order by a.area asc, a.conocimiento asc
			";
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["area"] = $registro["area"];
			$elemento["conocimiento"] = $registro["conocimiento"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método AreasInformatica
	*/
	
	public function AreasInformatica() {
		
		$listado = array();
		
		$sql = "
				select distinct a.area
				from cat_informatica a
				order by a.area asc
		";
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["area"] = $registro["area"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método CatalogoIndustrias
	*/
	
	public function CatalogoIndustrias($busqueda = "") {
		
		$listado = array();
		
		if ($busqueda != "") {
			
			$sql = "
					select industria
					from cat_industrias
					where industria like '%%busqueda%%'
					order by industria asc
			";
			
			$sql = str_replace("%busqueda%", $busqueda, $sql);
			
		} else {
			
			$sql = "
					select industria
					from cat_industrias
					order by industria asc
			";
			
		}
		
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["industria"] = $registro["industria"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método ErroresSQL
	*/
	
	public function ErroresSQL() {
		
		$listado = array();
		
		$sql = "
				select instante, error, sentencia
				from sys_errores a
				order by instante desc
				limit 0, 100
		";
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["instante"] = $registro["instante"];
			$elemento["error"] = $registro["error"];
			$elemento["sentencia"] = $registro["sentencia"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
}

?>