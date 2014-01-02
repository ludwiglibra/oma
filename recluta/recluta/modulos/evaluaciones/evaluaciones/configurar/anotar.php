<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php#Notas";
	
	$evaluacion = (isset($_POST["evaluacion"]) && $_POST["evaluacion"] != "") ? $_POST["evaluacion"] : "";
	$nota = (isset($_POST["nota"]) && $_POST["nota"] != "") ? $_POST["nota"] : "";
			
	if ($evaluacion != "" && $nota != "") {
			
		$core["notas"]->setTabla("evaluaciones");
		$core["notas"]->setValor1($evaluacion);
		$core["notas"]->setNota($nota);

		if ($core["notas"]->Agregar()) {
			$core["sesion"]->setMensaje("Se agregó exitosamente la nota a la Evaluación Técnica (" . $evaluacion . ").");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error al intentar agregar la nota en la base de datos, favor de contactar al administrador.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar una nota a la Evaluación Técnica (" . $evaluacion . ").");
	}
	
	header("Location: " . $pagina);
	exit;

?>