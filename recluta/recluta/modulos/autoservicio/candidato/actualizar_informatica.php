<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	if ($vacante != "") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "mant_informatica.php";
	}
	
	$candidato = $sesion_usuario;;
	$secuencia = (isset($_POST["secuencia"]) && $_POST["secuencia"] != "") ? $_POST["secuencia"] : "";
	$area = (isset($_POST["area"]) && $_POST["area"] != "") ? $_POST["area"] : "";
	$conocimiento = (isset($_POST["conocimiento"]) && $_POST["conocimiento"] != "") ? $_POST["conocimiento"] : "";
	$nivel = (isset($_POST["nivel"]) && $_POST["nivel"] != "") ? $_POST["nivel"] : "";
			
	if ($secuencia == "0") {
		
		$secuencia = $core["informatica"]->SecuenciaSiguiente($candidato);
		
	}
			
	$core["informatica"]->setCandidato($candidato);
	$core["informatica"]->setSecuencia($secuencia);
	$core["informatica"]->Cargar();
	
	$core["informatica"]->setArea($area);
	$core["informatica"]->setConocimiento($conocimiento);
	$core["informatica"]->setNivel($nivel);
	
	if ($core["informatica"]->Existe($candidato, $secuencia)) {
		
		if ($core["informatica"]->Actualizar()) {
			$core["sesion"]->setMensaje("Los datos de informática de su usuario fueron actualizados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información de informática, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	} else {
		
		if ($core["informatica"]->Agregar()) {
			$core["sesion"]->setMensaje("Los datos de informática de su usuario fueron agregados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar la información de informática, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	}
	
	header("Location: " . $pagina);
	exit;
	
?>