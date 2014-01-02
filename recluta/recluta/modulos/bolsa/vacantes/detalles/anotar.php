<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php#Notas";
	
	$vacante = (isset($_POST["vacante"]) && $_POST["vacante"] != "") ? $_POST["vacante"] : "";
	$nota = (isset($_POST["nota"]) && $_POST["nota"] != "") ? $_POST["nota"] : "";
			
	if ($vacante != "" && $nota != "") {
			
		$core["notas"]->setTabla("vacantes");
		$core["notas"]->setValor1($vacante);
		$core["notas"]->setNota($nota);

		if ($core["notas"]->Agregar()) {
			$core["sesion"]->setMensaje("Se agregó exitosamente la nota a la vacante.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error al intentar agregar la nota en la base de datos, favor de contactar al administrador.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar una nota a la vacante.");
	}
	
	header("Location: " . $pagina);
	exit;

?>