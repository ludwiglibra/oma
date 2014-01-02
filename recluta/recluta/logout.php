<?PHP

	require_once("cadenero.php");
	
	$core["sesion"]->Terminar();
	$core["sesion"]->Iniciar();
	$core["sesion"]->setMensaje("Sesión cerrada correctamente.");
	
	$pagina = $_SERVER["HTTP_REFERER"];
	header("Location: " . $pagina);
	exit;

?>