<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php#Notas";
	
	$bateria = (isset($_POST["bateria"]) && $_POST["bateria"] != "") ? $_POST["bateria"] : "";
	$nota = (isset($_POST["nota"]) && $_POST["nota"] != "") ? $_POST["nota"] : "";
			
	if ($bateria != "" && $nota != "") {
			
		$core["notas"]->setTabla("baterias");
		$core["notas"]->setValor1($bateria);
		$core["notas"]->setNota($nota);

		if ($core["notas"]->Agregar()) {
			$core["sesion"]->setMensaje("Se agregó exitosamente la nota a la Batería de Evaluaciones.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error al intentar agregar la nota en la base de datos, favor de contactar al administrador.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar una nota a la Batería de Evaluaciones.");
	}
	
	header("Location: " . $pagina);
	exit;

?>