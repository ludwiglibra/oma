<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$bateria = (isset($_GET["bateria"]) && $_GET["bateria"] != "") ? $_GET["bateria"] : "";
	
	$pagina = "index.php";
	
	if ($bateria != "" && $core["baterias"]->Existe($bateria)) {
		$pagina = "./detalles/";
		$core["sesion"]->setVariable("bateria_seleccionada", $bateria);
	} else {
		$core["sesion"]->setMensaje("ID de Batería de Evaluaciones no válida");
	}
	
	header("Location: " . $pagina);
	exit;

?>