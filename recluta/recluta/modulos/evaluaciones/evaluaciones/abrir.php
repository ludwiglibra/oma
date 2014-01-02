<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$evaluacion = (isset($_GET["evaluacion"]) && $_GET["evaluacion"] != "") ? $_GET["evaluacion"] : "";
	
	$pagina = "index.php";
	
	if ($evaluacion != "" && $core["evaluaciones"]->Existe($evaluacion)) {
		$pagina = "detalles/";
		$core["sesion"]->setVariable("evaluacion_seleccionada", $evaluacion);
	} else {
		$core["sesion"]->setMensaje("ID de Evaluación no válida");
	}
	
	header("Location: " . $pagina);
	exit;

?>