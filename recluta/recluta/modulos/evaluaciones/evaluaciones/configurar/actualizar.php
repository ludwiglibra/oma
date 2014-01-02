<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php";
	
	$evaluacion = (isset($_POST["evaluacion"]) && $_POST["evaluacion"] != "") ? $_POST["evaluacion"] : "";
	$titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != "") ? $_POST["titulo"] : "";
	$descripcion = (isset($_POST["descripcion"]) && $_POST["descripcion"] != "") ? $_POST["descripcion"] : "";
	$activo = (isset($_POST["activo"]) && $_POST["activo"] == "X") ? "X" : "";
	
	if ($evaluacion != "" && $titulo != "" && $descripcion != "") {
		
		$core["evaluaciones"]->setEvaluacion($evaluacion);
		$core["evaluaciones"]->Cargar();
		
		$core["evaluaciones"]->setTitulo($titulo);
		$core["evaluaciones"]->setDescripcion($descripcion);
		$core["evaluaciones"]->setActivo($activo);
						
		if ($core["evaluaciones"]->Actualizar()) {
			
			$core["sesion"]->setMensaje("Evaluación Técnica (" . $evaluacion . ") actualizada exitosamente");
			
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar actualizar la Evaluación Técnica (" . $evaluacion . "), consulte al administrador.");	
		}	
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar los datos de la evaluación (" . $evaluacion . ").");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>