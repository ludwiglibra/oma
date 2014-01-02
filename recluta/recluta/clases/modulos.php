<?PHP

class modulos {
	
	/************************************************** Propiedades */
	
	private $funciones;
	private $sesion;
	private $conexion;
	
	/************************************************** Constructor */
	
	public function modulos() {
		
		$this->funciones = new funciones();
		$this->sesion = new sesion();
		$this->conexion = new conexion();
		
	}
	
	/*
	** Método Asignado
	*/
	
	public function Asignado($usuario, $modulo) {
		
		$resultado = false;
		
		if ($usuario != "" && $modulo != "") {
			
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
					and d.modulo = '%modulo%'
					order by d.secuencia asc
			";
			
			$sql = str_replace("%usuario%", $usuario, $sql);
			$sql = str_replace("%modulo%", $modulo, $sql);
			
			//die($sql);
			
			$tabla = $this->conexion->consultar($sql);
			
			if ($this->conexion->lineas($tabla) > 0) {
				$resultado = true;
			}
			
		}
		
		return $resultado;
		
	}

}

?>