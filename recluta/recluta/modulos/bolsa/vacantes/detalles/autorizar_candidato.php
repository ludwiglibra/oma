<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php#Candidatos";
	
	$vacante = (isset($_GET["vacante"]) && $_GET["vacante"] != "") ? $_GET["vacante"] : "";
	$candidato = (isset($_GET["candidato"]) && $_GET["candidato"] != "") ? $_GET["candidato"] : "";
	
	if ($vacante != "" && $candidato != "") {
		
		if ($core["vacantes"]->AutorizacionCandidato($vacante, $candidato, "X")) {
			
			$destinatario = $candidato;
			//$destinatario = "iscvlado@gmail.com";
			
			/* Obtener Nombre del Usuario */
			
			$core["generales"]->setUsuario($candidato);
			$core["generales"]->Cargar();
			$nombre_completo = $core["generales"]->getNombres() . " " . $core["generales"]->getApellidos();
			
			/* Generar URL de Recuperación */
			
			$url = $_SERVER["HTTP_REFERER"] . "?vacante=" . $vacante;
			
			/* Enviar Correo */
			
			$mensaje = "
						<p>
						Estimado(a): %nombre_completo%
						</p>
						<p>
						Ha sido autorizado para participar en la vacante #%vacante%. Puede ingresar a ella mediante la siguiente liga:
						</p>
						<p>
						%url%
						</p>
						<p>
						En OMA estamos comprometidos con la igualdad de oportunidades de desarrollo.
						</p>
			";
			
			$mensaje = str_replace("%nombre_completo%", $nombre_completo, $mensaje);
			$mensaje = str_replace("%vacante%", $vacante, $mensaje);
			$mensaje = str_replace("%url%", $url, $mensaje);
			
			$core["correo"]->setPara($destinatario);
			$core["correo"]->setAsunto("Autorización de Participación en Vacante #" . $vacante);
			$core["correo"]->setMensaje($mensaje);
			
			if ($core["correo"]->Enviar()) {
				
				$core["sesion"]->setMensaje("Mensaje de autorización correctamente enviado al candidato elegido.");
				
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error al enviar el correo de aviso de autorización, favor de contacar al administrador del sitio al correo " . $core["parametros"]->getContacto());
			}
		} else {
		}
		
	} else {
	}
	
	header("Location: " . $pagina);
	exit;
	
?>