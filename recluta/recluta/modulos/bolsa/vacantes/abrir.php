<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = (isset($_GET["vacante"]) && $_GET["vacante"] != "") ? $_GET["vacante"] : "";
	
	$pagina = "index.php";
	
	if ($vacante != "" && $core["vacantes"]->Existe($vacante)) {
		$pagina = "detalles/";
		$core["sesion"]->setVariable("vacante_seleccionada", $vacante);
	} else {
		$core["sesion"]->setMensaje("ID de vacante no válida");
	}
	
	header("Location: " . $pagina);
	exit;

?>