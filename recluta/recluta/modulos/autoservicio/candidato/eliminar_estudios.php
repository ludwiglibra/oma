<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	if ($vacante != "") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "./index.php#SeccionEstudios";
	}
	
	$candidato = (isset($_GET["candidato"]) && $_GET["candidato"] != "") ? $_GET["candidato"] : "";
	$secuencia = (isset($_GET["secuencia"]) && $_GET["secuencia"] != "") ? $_GET["secuencia"] : "";
		
	$core["estudios"]->setCandidato($candidato);
	$core["estudios"]->setSecuencia($secuencia);
	
	if ($core["estudios"]->Eliminar()) {
		$core["sesion"]->setMensaje("Registro de estudios eliminado correctamente");
	} else {
		$core["sesion"]->setMensaje("Ocurrió un error al intentar eliminar el registro de estudios, contacte al administrador al correo " . $core["parametros"]->getContacto());
	}
	
	header("Location: " . $pagina);
	exit;
	
?>