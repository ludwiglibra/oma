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
	
	$core["sesion"]->setVariable("campo_bateria", $bateria);
	$core["sesion"]->setVariable("campo_titulo", $titulo);
	$core["sesion"]->setVariable("campo_descripcion", $descripcion);
	$core["sesion"]->setVariable("campo_area", $area);
	
	if ($bateria != "" && $titulo != "" && $descripcion != "" && $area != "") {
		
		if (!($core["baterias"]->Existe($bateria))) {
		
			$core["baterias"]->setBateria($bateria);
			$core["baterias"]->setTitulo($titulo);
			$core["baterias"]->setDescripcion($descripcion);
			$core["baterias"]->setArea($area);
			$core["baterias"]->setActivo("X");
							
			if ($core["baterias"]->Agregar()) {
				
				$core["sesion"]->setVariable("campo_bateria", "");
				$core["sesion"]->setVariable("campo_titulo", "");
				$core["sesion"]->setVariable("campo_descripcion", "");
				$core["sesion"]->setVariable("campo_area", "");
				
				$core["sesion"]->setVariable("bateria_seleccionada", $bateria);
				$core["sesion"]->setMensaje("La batería fue creada exitosamente");
				$pagina = "../detalles/";
				
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar agregar la Batería de Evaluaciones, consulte al administrador.");	
			}
		} else {
			$core["sesion"]->setMensaje("El ID de Batería de Evaluaciones ya existe en el sistema, favor de corregir.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar la Batería de Evaluaciones.");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>