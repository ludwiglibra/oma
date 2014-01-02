<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$imagen = (isset($_GET["imagen"]) && $_GET["imagen"] != "") ? $_GET["imagen"] : "";
	
	$pagina = "index.php";
	
	if ($imagen != "" && $core["imagenes"]->Existe($imagen)) {
		$pagina = "detalles/";
		$core["sesion"]->setVariable("imagen_seleccionada", $imagen);
	} else {
		$core["sesion"]->setMensaje("ID de imagen no válida.");
	}
	
	header("Location: " . $pagina);
	exit;

?>