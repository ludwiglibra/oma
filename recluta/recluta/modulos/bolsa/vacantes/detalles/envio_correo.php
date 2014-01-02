<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php#Candidatos";
	
	$vacante = (isset($_POST["vacante"]) && $_POST["vacante"] != "") ? $_POST["vacante"] : "";
	$candidato = (isset($_POST["candidato"]) && $_POST["candidato"] != "") ? $_POST["candidato"] : "";
	$mensaje = (isset($_POST["mensaje"]) && $_POST["mensaje"] != "") ? $_POST["mensaje"] : "";
	
	if ($vacante != "" && $candidato != "" && $mensaje != "") {
		
		$mensaje = nl2br($mensaje);
		
		$core["correo"]->setPara($candidato);
		$core["correo"]->setPara("iscvlado@gmail.com");
		
		$core["correo"]->setAsunto("Agradecimiento por Participación");
		$core["correo"]->setmensaje($mensaje);
		
		if ($core["correo"]->Enviar()) {
			$core["sesion"]->setMensaje("Envío exitoso del correo al candidato");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error al intentar enviar el correo al candidato");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para el envío del correo");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>