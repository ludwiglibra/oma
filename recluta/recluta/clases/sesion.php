<?PHP

	class sesion {
		
		/*
		** Propiedades de la clase
		*/
		
		private $funciones;
		private $conexion;
		private $accesos;
		private $sesion = "oma_recluta";
		private $mensaje;
		private $formulario;
		
		private $usuario;
		private $clave;
		
		/*
		** Constructor de la clase
		*/
		
		public function sesion() {
			
			$this->funciones = new funciones();
			$this->conexion = new conexion();
			$this->accesos = new accesos();
			
			session_name($this->sesion);
			
		}
		
		/*
		** Métodos SET
		*/
		
		public function setUsuario($usuario) {
			$this->usuario = mysql_real_escape_string($usuario);
		}
		
		public function setClave($clave) {
			$this->clave = md5(mysql_real_escape_string($clave));
		}
		
		/*
		** Método Iniciar
		**
		** Inicia la sesión PHP
		*/
		
		public function Iniciar() {
			session_start();
		}
		
		/*
		** Método Terminar
		**
		** Destruye la sesión PHP
		*/
		
		public function Terminar() {
			session_destroy();
		}
		
		/*
		** Método DatosValidos
		**
		** Valida que el usuario y la clave proporcionados se correspondan con un usuario y que éste
		** no esté bloqueado
		*/
		
		public function DatosValidos() {
			
			$salida = false;
			
			$usuario = $this->usuario;
			$clave = $this->clave;
			
			$sql = "
					select 'Y' as validez
					from sys_usuarios
					where usuario = '%usuario%'
					and clave = '%clave%'
					and activo = 'X'
			";
			
			$sql = str_replace("%usuario%", $usuario, $sql);
			$sql = str_replace("%clave%", $clave, $sql);
			
			//die($sql);
			
			$consulta = $this->conexion->consultar($sql);
			$registro = $this->conexion->recorrer($consulta);
			
			$validez = $registro["validez"];
			
			if ($validez == "Y") {
				$salida = true;
			}
			
			return $salida;
			
		}
		
		/*
		** Método Registrar
		**
		** Registra variable de manejo de sesión
		*/
		
		public function Registrar() {

			$usuario = $this->usuario;
			
			if ($usuario != "") {
				
				$sql = "
						select usuario, nivel
						from sys_usuarios
						where usuario = '%usuario%'
				";
				
				$sql = str_replace("%usuario%", $usuario, $sql);
				
				//die($sql);
				
				$tabla = $this->conexion->consultar($sql);
				$registro = $this->conexion->recorrer($tabla);
				
				$_SESSION["sesion_iniciada"] = "X";
				
				$_SESSION["sesion_usuario"] = $registro["usuario"];
				$_SESSION["sesion_nivel"] = $registro["nivel"];
				
				$this->accesos->setUsuario($registro["usuario"]);
				$this->accesos->Registrar();
				
			}
			
		}
		
		/*
		** Método Registrada
		**
		** Devuelve el estatus de la sesión
		*/
		
		public function Registrada() {
			
			$salida = false;
			$salida = (isset($_SESSION["sesion_iniciada"]) && $_SESSION["sesion_iniciada"] == "X") ? true : false;
			return $salida;
			
		}
		
		/*
		** Método setMensaje
		**
		** Establece mensaje del sistema
		*/
		
		public function setMensaje($mensaje) {
			
			$instante = $this->funciones->getFechaHora();
			
			$elemento = array();
			$elemento["instante"] = $instante;
			$elemento["mensaje"] = $mensaje;
			
			$_SESSION["sesion_mensaje"][] = $elemento;
			
		}
		
		/*
		** Método getMensaje
		**
		** Devuelve el mensaje almacenado en el sistema, de haberlo
		*/
		
		public function getMensajes() {
			
			$mensaje = (isset($_SESSION["sesion_mensaje"]) && $_SESSION["sesion_mensaje"] != "") ? $_SESSION["sesion_mensaje"] : array();
			$_SESSION["sesion_mensaje"] = array();
			return $mensaje;
			
		}
		
		/*
		** Método setAdvertencia
		**
		** Establece advertencia del sistema
		*/
		
		public function setAdvertencia($advertencia) {
			
			$instante = $this->funciones->getFechaHora();
			
			$elemento = array();
			$elemento["instante"] = $instante;
			$elemento["advertencia"] = $advertencia;
			
			$_SESSION["sesion_advertencia"][] = $elemento;
			
		}
		
		/*
		** Método getAdvertencia
		**
		** Devuelve la advertencia almacenado en el sistema, de haberlo
		*/
		
		public function getAdvertencia() {
			
			$advertencia = (isset($_SESSION["sesion_advertencia"]) && $_SESSION["sesion_advertencia"] != "") ? $_SESSION["sesion_advertencia"] : array();
			$_SESSION["sesion_advertencia"] = array();
			return $advertencia;
			
		}
		
		/*
		** Método SetError
		**
		** Devuelve el mensaje de error almacenado en la sesión
		**
		*/
		
		public function setError($error) {
			
			$instante = $this->funciones->getFechaHora();
			
			$elemento = array();
			$elemento["instante"] = $instante;
			$elemento["error"] = $error;
			
			$_SESSION["sesion_error"][] = $elemento;
			
		}
		
		/*
		** Método getError
		**
		** Devuelve el error almacenado en el sistema, de haberlo
		*/
		
		public function getError() {
			
			$error = (isset($_SESSION["sesion_error"]) && $_SESSION["sesion_error"] != "") ? $_SESSION["sesion_error"] : array();
			$_SESSION["sesion_error"] = array();
			return $error;
			
		}
		
		/*
		** Método setVariable
		**
		** Establece una variable de sesión y su valor correspondiente
		*/
		
		public function setVariable($variable, $valor) {
			
			$_SESSION[$variable] = $valor;
			
		}
		
		/*
		** Método getVariable
		**
		** Devuelve el valor correspondiente de una variable de sesión
		*/
		
		public function getVariable($variable) {
			
			$salida = (isset($_SESSION[$variable]) && $_SESSION[$variable] != "") ? $_SESSION[$variable] : "";
			return $salida;
			
		}
				
	}

?>