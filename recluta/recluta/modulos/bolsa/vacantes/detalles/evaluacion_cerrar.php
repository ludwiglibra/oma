<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "./";
		
	$core["sesion"]->setVariable("vacante_seleccionada", "");
	$core["sesion"]->setVariable("candidato_seleccionado", "");
	
	header("Location: " . $pagina);
	
?>