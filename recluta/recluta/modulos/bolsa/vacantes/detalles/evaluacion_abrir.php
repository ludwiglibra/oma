<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "resultados.php";
	
	$vacante = (isset($_GET["vacante"]) && $_GET["vacante"] != "") ? $_GET["vacante"] : "";
	$candidato = (isset($_GET["candidato"]) && $_GET["candidato"] != "") ? $_GET["candidato"] : "";
	
	$core["sesion"]->setVariable("vacante_seleccionada", $vacante);
	$core["sesion"]->setVariable("candidato_seleccionado", $candidato);
	
	header("Location: " . $pagina);
	
?>