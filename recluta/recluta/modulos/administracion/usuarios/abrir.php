<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$usuario = (isset($_GET["usuario"]) && $_GET["usuario"] != "") ? $_GET["usuario"] : "";
	
	$pagina = "index.php";
	
	if ($usuario != "" && $core["usuarios"]->Existe($usuario)) {
		$pagina = "detalles/";
		$core["sesion"]->setVariable("usuario_seleccionado", $usuario);
	} else {
		$core["sesion"]->setMensaje("ID de usuario no válido");
	}
	
	header("Location: " . $pagina);
	exit;

?>