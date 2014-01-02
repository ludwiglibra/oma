<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php#Candidatos";
	
	$vacante = (isset($_GET["vacante"]) && $_GET["vacante"] != "") ? $_GET["vacante"] : "";
	$candidato = (isset($_GET["candidato"]) && $_GET["candidato"] != "") ? $_GET["candidato"] : "";
	
	if ($vacante != "" && $candidato != "") {
		
		if ($core["vacantes"]->AutorizacionCandidato($vacante, $candidato, "")) {
			$core["sesion"]->setMensaje("El candidato " . $candidato . " ha sido desautorizado a participar en ésta vacante.");
		}
		
	}
	
	header("Location: " . $pagina);
	exit;
	
?>