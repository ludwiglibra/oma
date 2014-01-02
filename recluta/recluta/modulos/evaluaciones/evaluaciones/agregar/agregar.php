<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
		
	$pagina = "index.php";
	
	$evaluacion = (isset($_POST["evaluacion"]) && $_POST["evaluacion"] != "") ? $_POST["evaluacion"] : "";
	$titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != "") ? $_POST["titulo"] : "";
	$descripcion = (isset($_POST["descripcion"]) && $_POST["descripcion"] != "") ? $_POST["descripcion"] : "";
	
	$core["sesion"]->setVariable("campo_evaluacion", $evaluacion);
	$core["sesion"]->setVariable("campo_titulo", $titulo);
	$core["sesion"]->setVariable("campo_descripcion", $descripcion);
	
	if ($evaluacion != "" && $titulo != "" && $descripcion != "") {
		
		if (!($core["evaluaciones"]->Existe($evaluacion))) {
		
			$core["evaluaciones"]->setEvaluacion($evaluacion);
			$core["evaluaciones"]->setTitulo($titulo);
			$core["evaluaciones"]->setDescripcion($descripcion);
			$core["evaluaciones"]->setActivo("X");
							
			if ($core["evaluaciones"]->Agregar()) {
				
				$core["sesion"]->setVariable("campo_evaluacion", "");
				$core["sesion"]->setVariable("campo_titulo", "");
				$core["sesion"]->setVariable("campo_descripcion", "");
				
				$core["sesion"]->setVariable("evaluacion_seleccionada", $evaluacion);
				$core["sesion"]->setMensaje("La evaluación técnica (" . $evaluacion . ") fue creada exitosamente");
				$pagina = "../detalles/";
				
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar agregar la evaluación técnicas (" . $evaluacion . "), consulte al administrador.");	
			}
		} else {
			$core["sesion"]->setMensaje("El ID de Evaluación Técnica (" . $evaluacion . ") ya existe en el sistema, favor de corregir.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar la evaluación técnica (" . $evaluacion . ").");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>