<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$candidato = $sesion_usuario;
	$aviso = (isset($_POST["aviso"]) && $_POST["aviso"] != "") ? $_POST["aviso"] : "";
	$pagina = (isset($_POST["pagina"]) && $_POST["pagina"] != "") ? $_POST["pagina"] : "";
	
	if ($candidato != "" && $aviso != "") {
		
		if ($core["candidatos"]->Existe($candidato)) {
			
			$core["candidatos"]->setCandidato($candidato);
			$core["candidatos"]->Cargar();
			
			$core["candidatos"]->setAviso("X");
			$core["candidatos"]->setTexto($aviso);
			
			if ($core["candidatos"]->Actualizar()) {
				$core["sesion"]->setMensaje("Ha aceptado de forma exitosa el aviso para la protección de la privacidad.");
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error al intentar registrar su anuencia al aviso de protección de la privacidad.");
			}
			
		} else {
			
			$core["candidatos"]->setCandidato($candidato);
			$core["candidatos"]->setAviso("X");
			$core["candidatos"]->setTexto($aviso);
			
			if ($core["candidatos"]->Agregar()) {
				$core["sesion"]->setMensaje("Ha aceptado de forma exitosa el aviso para la protección de la privacidad.");
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error al intentar registrar su anuencia al aviso de protección de la privacidad.");
			}
			
		}
		
	}
	
	header("Location: " . $pagina);
	exit;

?>