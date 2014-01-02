<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$area = (isset($_GET["area"]) && $_GET["area"] != "") ? $_GET["area"] : "";
	
	$pagina = "index.php";
	
	if ($area != "" && $core["areas"]->Existe($area)) {
		$pagina = "detalles/";
		$core["sesion"]->setVariable("area_seleccionada", $area);
	} else {
		$core["sesion"]->setMensaje("ID de área no válida");
	}
	
	header("Location: " . $pagina);
	exit;

?>