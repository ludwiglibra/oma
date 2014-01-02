<?PHP

	require_once("../cadenero.php");
	
	if (file_exists("../cadenero.php")) {
		require_once("../cadenero.php");
	}
	
	$pagina = "./";
	
	$usuario = (isset($_POST["usuario"]) && $_POST["usuario"] != "") ? $_POST["usuario"] : "";
	$nombres = (isset($_POST["nombres"]) && $_POST["nombres"] != "") ? $_POST["nombres"] : "";
	$apellidos = (isset($_POST["apellidos"]) && $_POST["apellidos"] != "") ? $_POST["apellidos"] : "";
	
	$core["sesion"]->setVariable("campo_usuario", $usuario);
	$core["sesion"]->setVariable("campo_nombres", $nombres);
	$core["sesion"]->setVariable("campo_apellidos", $apellidos);
	
	if ($usuario != "" && $nombres != "" && $apellidos != "") {
		
		if (!($core["usuarios"]->Existe($usuario))) {
			
			$clave = $core["funciones"]->$this->Aleatorio(1);
			$clave.= $core["funciones"]->$this->Aleatorio(1);
			$clave.= $core["funciones"]->$this->Aleatorio(1);
			$clave.= $core["funciones"]->$this->Aleatorio(1);
			
			$core["usuarios"]->setUsuario($usuario);
			$core["usuarios"]->setClave($clave);
			$core["usuarios"]->setNivel("3");
			$core["usuarios"]->setActivo("X");
			
			/* Agregar Usuario */
			
			if ($core["usuarios"]->Agregar()) {
				
				$resultado = false;
				
				/* Agregar Nombres y Apellidos */
				
				if ($core["generales"]->Existe($usuario)) {
					
					$core["generales"]->setUsuario($usuario);
					$core["generales"]->Cargar();
					
					$core["generales"]->setNombres($nombres);
					$core["generales"]->setApellidos($apellidos);
					
					if ($core["generales"]->Actualizar()) {
						$resultado = true;
					}
					
				} else {
					
					$core["generales"]->setUsuario($usuario);
					$core["generales"]->setNombres($nombres);
					$core["generales"]->setApellidos($apellidos);
					
					if ($core["generales"]->Agregar()) {
						$resultado = true;
					}
					
				}
				
				if ($resultado) {
					
					$core["sesion"]->setVariable("campo_usuario", "");
					$core["sesion"]->setVariable("campo_nombres", "");
					$core["sesion"]->setVariable("campo_apellidos", "");
					
					/* Generar Aviso por Correo */
					
					$nombre_completo = $nombres . " " . $apellidos;
					$url = $_SERVER["HTTP_REFERER"] . "?login=X";
					
					$destinatario = $usuario;
					//$destinatario = "iscvlado@gmail.com";					
					
					$asunto = "Cuenta OMA Bolsa de Trabajo";
					
					$mensaje = "
					<p>
					Estimado(a): %nombre_completo%
					</p>
					<p>
					Bienvenido a la Bolsa de Trabajo de OMA. Su cuenta fue creada con éxito. 
					</p>
					<p>
					Te invitamos a consultar las oportunidades de desarrollo que OMA ofrece para ti.
					</p>
					<p>
					Usuario: %usuario%<br>
					Clave: %clave%<br>
					Página: %url%<br>
					</p>
					<p>
					En OMA estamos comprometidos con la igualdad de oportunidades de desarrollo.
					</p>
					";
					
					$mensaje = str_replace("%nombre_completo%", $nombre_completo, $mensaje);
					$mensaje = str_replace("%usuario%", $usuario, $mensaje);
					$mensaje = str_replace("%clave%", $clave, $mensaje);
					$mensaje = str_replace("%url%", $url, $mensaje);
					$mensaje = str_replace("%nombre_completo%", $nombre_completo, $mensaje);
					
					$core["correo"]->setPara($destinatario);
					$core["correo"]->setAsunto($asunto);
					$core["correo"]->setMensaje($mensaje);
					
					if ($core["correo"]->Enviar()) {
						
						$pagina = "../";
						$core["sesion"]->setMensaje("Registro correcto. Tu usuario y contraseña serán enviados vía e-mail.");
						
					} else {
						$core["sesion"]->setMensaje("Ocurrió un error al enviar por correo electrónico los datos de tu cuenta, favor de contactar a " . $core["parametros"]->getContacto());
						$core["sesion"]->setMensaje($core["correo"]->getError());
					}
					
				} else {
					/* No se pudo agregar nombre a la base */
					$core["sesion"]->setMensaje("Ocurrió un error al agregar su nombre a los datos generales de su usuario, favor de contactar a " . $core["parametros"]->getContacto());
				}
				
			} else {
				/* No se pudo agregar el usuario */
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar agregar el usuario, favor de reportar al administrador del sistema, al correo " . $core["parametros"]->getContacto());
			}
			
		} else {
			/* Ya existe el usuario */
			$pagina = "../recuperar/";
			$core["sesion"]->setMensaje("El correo electrónico introducido ya existe en el sistema. Para recuperar su cuenta, favor de ingresar su correo electrónico y dar click en el botón <strong>RECUPERAR</strong>.");
		}
		
	} else {
		/* Falta información requerida */
		$core["sesion"]->setMensaje("El correo electrónico, el(los) nombre(s) y el(los) apellido(s) son valores requeridos.");
	}
	
	header("Location: " . $pagina);
	exit;

?>