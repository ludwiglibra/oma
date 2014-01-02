<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php";
	
	$bateria = (isset($_POST["bateria"]) && $_POST["bateria"] != "") ? $_POST["bateria"] : "";
	$titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != "") ? $_POST["titulo"] : "";
	$descripcion = (isset($_POST["descripcion"]) && $_POST["descripcion"] != "") ? $_POST["descripcion"] : "";
	$area = (isset($_POST["area"]) && $_POST["area"] != "") ? $_POST["area"] : "";
	$activo = (isset($_POST["activo"]) && $_POST["activo"] == "X") ? "X" : "";
	
	if ($bateria != "" && $titulo != "" && $descripcion != "" && $area != "") {
		
		$core["baterias"]->setBateria($bateria);
		$core["baterias"]->Cargar();
		
		$core["baterias"]->setTitulo($titulo);
		$core["baterias"]->setDescripcion($descripcion);
		$core["baterias"]->setArea($area);
		$core["baterias"]->setActivo($activo);
						
		if ($core["baterias"]->Actualizar()) {
			
			$core["sesion"]->setMensaje("Batería de Evaluaciones (" . $bateria . ") actualizada exitosamente");
			
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar actualizar la Batería de Evaluaciones (" . $bateria . "), consulte al administrador.");	
		}	
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar los datos de la Batería de Evaluaciones.");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>