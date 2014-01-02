<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = (isset($_POST["vacante"]) && $_POST["vacante"] != "") ? $_POST["vacante"] : "";
	
	if ($vacante == "X") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "./#Estudios";
	}
	
	$candidato = $sesion_usuario;
	$titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != "") ? $_POST["titulo"] : "";
	$pais = (isset($_POST["pais"]) && $_POST["pais"] != "") ? $_POST["pais"] : "";
	$institucion = (isset($_POST["institucion"]) && $_POST["institucion"] != "") ? $_POST["institucion"] : "";
	$inicio = (isset($_POST["inicio"]) && $_POST["inicio"] != "") ? $_POST["inicio"] : "";
	$fin = (isset($_POST["fin"]) && $_POST["fin"] != "") ? $_POST["fin"] : "";
	$presente = (isset($_POST["presente"]) && $_POST["presente"] == "X") ? "X" : "";
	$escolaridad = (isset($_POST["escolaridad"]) && $_POST["escolaridad"] != "") ? $_POST["escolaridad"] : "";
			
	$core["estudios"]->setCandidato($candidato);
	$core["estudios"]->Cargar();
	
	$core["estudios"]->setTitulo($titulo);
	$core["estudios"]->setPais($pais);
	$core["estudios"]->setInstitucion($institucion);
	$core["estudios"]->setInicio($inicio);
	$core["estudios"]->setFin($fin);
	$core["estudios"]->setPresente($presente);
	$core["estudios"]->setEscolaridad($escolaridad);	
	
	if ($core["estudios"]->Existe($candidato)) {
		
		if ($core["estudios"]->Actualizar()) {
			$core["sesion"]->setMensaje("Los datos de estudio de su usuario fueron actualizados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información de estudio, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	} else {
		
		if ($core["estudios"]->Agregar()) {
			$core["sesion"]->setMensaje("Los datos de estudio de su usuario fueron agregados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar la información de estudio, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	}
	
	header("Location: " . $pagina);
	exit;
	
?>