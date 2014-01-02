<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	if ($vacante != "") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "./mant_salarial.php";
	}
	
	$candidato = (isset($_POST["candidato"]) && $_POST["candidato"] != "") ? $_POST["candidato"] : "";
	$actual = (isset($_POST["actual"]) && $_POST["actual"] != "") ? $_POST["actual"] : "";
	$expectativas = (isset($_POST["expectativas"]) && $_POST["expectativas"] != "") ? $_POST["expectativas"] : "";
				
	$core["salarial"]->setCandidato($candidato);
	$core["salarial"]->Cargar();
	
	$core["salarial"]->setActual($actual);
	$core["salarial"]->setExpectativas($expectativas);
	
	if ($core["salarial"]->Existe($candidato)) {
		
		if ($core["salarial"]->Actualizar()) {
			$core["sesion"]->setMensaje("Los datos salariales de su usuario fueron actualizados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información salarial, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	} else {
		
		if ($core["salarial"]->Agregar()) {
			$core["sesion"]->setMensaje("Los datos salariales de su usuario fueron agregados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar la información salarial, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	}
	
	header("Location: " . $pagina);
	exit;
	
?>