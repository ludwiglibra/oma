<?PHP

	require_once("../cadenero.php");
	
	if (file_exists("../cadenero.php")) {
		require_once("../cadenero.php");
	}
	
	$pagina = "./";
	
	$login = (isset($_GET["login"]) && $_GET["login"] != "") ? $_GET["login"] : "";
	$usuario = (isset($_POST["usuario"]) && $_POST["usuario"] != "") ? $_POST["usuario"] : "";
	
	$campo_usuario = $core["sesion"]->getVariable("campo_usuario");
	
	if ($login == "X") {
		
		$core["sesion"]->setMensaje("Esta es la página de identificación de OMA Bolsa de Trabajo, ¡Bienvenido!");
		$pagina = "../";
		
	} elseif ($usuario != "") {
		
		$core["sesion"]->setVariable("campo_usuario", $usuario);
		
		if ($core["validaciones"]->correo($correo)) {
			
			if ($core["usuarios"]->Existe($usuario)) {
				
				$core["usuarios"]->setUsuario($usuario);
				$core["usuarios"]->Cargar();
				
				if ($core["usuarios"]->getActivo() != "") {
					
					$clave = $core["funciones"]->NuevoID();
				
					$core["usuarios"]->setClave($clave);
					
					if ($core["usuarios"]->Actualizar()) {
						
						$destinatario = $usuario;
						//$destinatario = "iscvlado@gmail.com";
						
						/* Obtener Nombre del Usuario */
						
						$core["generales"]->setUsuario($usuario);
						$core["generales"]->Cargar();
						$nombre_completo = $core["generales"]->getNombres() . " " . $core["generales"]->getApellidos();
						
						/* Generar URL de Recuperación */
						
						$url = $_SERVER["HTTP_REFERER"] . "?login=X";
						
						/* Enviar Correo */
						
						$mensaje = "
									<p>
									Estimado(a): %nombre_completo%
									</p>
									<p>
									Tu usuario y contraseña son:
									<p>
									Usuario: %usuario%<br>
									Clave: %clave%<br>
									Página: %url%
									</p>
									<p>
									En OMA estamos comprometidos con la igualdad de oportunidades de desarrollo.
									</p>
						";
						
						$mensaje = str_replace("%nombre_completo%", $nombre_completo, $mensaje);
						$mensaje = str_replace("%usuario%", $usuario, $mensaje);
						$mensaje = str_replace("%clave%", $clave, $mensaje);
						$mensaje = str_replace("%url%", $url, $mensaje);
						
						$core["correo"]->setPara($destinatario);
						$core["correo"]->setAsunto("Recuperación Cuenta OMA Bolsa de Trabajo");
						$core["correo"]->setMensaje($mensaje);
						
						if ($core["correo"]->Enviar()) {
							
							$core["sesion"]->setMensaje("Mensaje de recuperación correctamente enviado a su buzón de correo electrónico");
							
						} else {
							$core["sesion"]->setMensaje("Ocurrió un error al enviar el correo de recuperación, favor de contacar al administrador del sitio al correo " . $core["parametros"]->getContacto());
						}
						
					} else {
						$core["sesion"]->setMensaje("Ocurrió un error al intentar re-generar su clave de acceso, contacte al administrador al correo " . $core["parametros"]->getContacto());
					}
				} else {
					$core["sesion"]->setMensaje("Su cuenta de usuario está inactiva, contacte al administrador al correo " . $core["parametros"]->getContacto());
				}
			} else {
				$core["sesion"]->setMensaje("No existe usuario con el correo electrónico indicado.");
			}	
		} else {
			$core["sesion"]->setMensaje("El correo electrónico está en un formato incorrecto.");
		}
	} else {
		$core["sesion"]->setMensaje("El correo electrónico es un campo requerido.");
	}
	
	header("Location: " . $pagina);
	exit;

?>