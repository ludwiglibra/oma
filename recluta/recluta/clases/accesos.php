<?PHP

class accesos {
	
	/************************************************** Propiedades */
	
	private $funciones;
	private $conexion;
	
	private $usuario;
	private $instante;
	private $ip;
	private $navegador;
	
	/************************************************** Constructor */
	
	public function accesos() {
		
		$this->funciones = new funciones();
		$this->conexion = new conexion();
		
	}
	
	/************************************************** Métodos SET */
	
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}
	
	/*
	** Método ListadoTotal
	*/
	
	public function ListadoTotal() {
		
		$listado = array();
		
		$sql = "
				select a.usuario, concat(a1.nombres, ' ', a1.apellidos) as nombre, a.instante, a.ip, a.navegador
				from sys_accesos a
					left outer join
					sys_generales a1
					on a1.usuario = a.usuario
				order by instante desc
				limit 0, 500
		";
			
		//die($sql);
		
		$tabla = $this->conexion->consultar($sql);
		
		while ($registro = $this->conexion->recorrer($tabla)) {
			
			$elemento = array();
			
			$elemento["usuario"] = $registro["usuario"];
			$elemento["nombre"] = $registro["nombre"];
			$elemento["instante"] = $registro["instante"];
			$elemento["ip"] = $registro["ip"];
			$elemento["navegador"] = $registro["navegador"];
			
			$listado[] = $elemento;
			
		}
		
		return $listado;
		
	}
	
	/*
	** Método Registrar
	*/
	
	public function Registrar() {
		
		if ($this->usuario != "") {
			
			$this->instante = $this->funciones->getFechaHora();
			$this->ip = $_SERVER["REMOTE_ADDR"];
			$this->navegador = mysql_real_escape_string($_SERVER["HTTP_USER_AGENT"]);
			
			$sql = "
					insert into sys_accesos
					values ('%usuario%', '%instante%', '%ip%', '%navegador%')
			";
			
			$sql = str_replace("%usuario%", $this->usuario, $sql);
			$sql = str_replace("%instante%", $this->instante, $sql);
			$sql = str_replace("%ip%", $this->ip, $sql);
			$sql = str_replace("%navegador%", $this->navegador, $sql);
			
			//die($sql);
			
			$this->conexion->ejecutar($sql);
			
		}
		
	}

}

?>