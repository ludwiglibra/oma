<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	if ($vacante != "") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "./index.php#SeccionInformatica";
	}
	
	$candidato = (isset($_GET["candidato"]) && $_GET["candidato"] != "") ? $_GET["candidato"] : "";
	$secuencia = $core["informatica"]->SecuenciaSiguiente($candidato);
		
	$core["informatica"]->setCandidato($candidato);
	$core["informatica"]->setSecuencia($secuencia);
	
	if ($core["informatica"]->Agregar()) {
		$core["sesion"]->setMensaje("Registro de informática agregado correctamente");
	} else {
		$core["sesion"]->setMensaje("Ocurrió un error al intentar agregar el registro de informática, contacte al administrador al correo " . $core["parametros"]->getContacto());
	}
	
	header("Location: " . $pagina);
	exit;
	
?>