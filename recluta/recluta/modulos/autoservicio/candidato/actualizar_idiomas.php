<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	if ($vacante != "") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "mant_idiomas.php";
	}
	
	$candidato = $sesion_usuario;
	$secuencia = (isset($_POST["secuencia"]) && $_POST["secuencia"] != "") ? $_POST["secuencia"] : "";
	$idioma = (isset($_POST["idioma"]) && $_POST["idioma"] != "") ? $_POST["idioma"] : "";
	$escrito = (isset($_POST["escrito"]) && $_POST["escrito"] != "") ? $_POST["escrito"] : "";
	$oral = (isset($_POST["oral"]) && $_POST["oral"] != "") ? $_POST["oral"] : "";
			
	if ($secuencia == "0") {
		$secuencia = $core["idiomas"]->SecuenciaSiguiente($candidato);
	}
	
	$core["idiomas"]->setCandidato($candidato);
	$core["idiomas"]->setSecuencia($secuencia);
	$core["idiomas"]->Cargar();
	
	$core["idiomas"]->setIdioma($idioma);
	$core["idiomas"]->setEscrito($escrito);
	$core["idiomas"]->setOral($oral);
	
	if ($core["idiomas"]->Existe($candidato, $secuencia)) {
		
		if ($core["idiomas"]->Actualizar()) {
			$core["sesion"]->setMensaje("Los datos de idioma de su usuario fueron actualizados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información de idioma, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	} else {
		
		if ($core["idiomas"]->Agregar()) {
			$core["sesion"]->setMensaje("Los datos de idioma de su usuario fueron agregados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar la información de idioma, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	}
	
	header("Location: " . $pagina);
	exit;
	
?>