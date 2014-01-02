<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php";
	
	$vacante = (isset($_POST["vacante"]) && $_POST["vacante"] != "") ? $_POST["vacante"] : "";
	$tipo = (isset($_POST["tipo"]) && $_POST["tipo"] != "") ? $_POST["tipo"] : "";
	$ubicacion = (isset($_POST["ubicacion"]) && $_POST["ubicacion"] != "") ? $_POST["ubicacion"] : "";
	$area = (isset($_POST["area"]) && $_POST["area"] != "") ? $_POST["area"] : "";
	$titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != "") ? $_POST["titulo"] : "";
	$descripcion = (isset($_POST["descripcion"]) && $_POST["descripcion"] != "") ? $_POST["descripcion"] : "";
	$formacion = (isset($_POST["formacion"]) && $_POST["formacion"] != "") ? $_POST["formacion"] : "";
	$conocimientos = (isset($_POST["conocimientos"]) && $_POST["conocimientos"] != "") ? $_POST["conocimientos"] : "";
	$experiencia = (isset($_POST["experiencia"]) && $_POST["experiencia"] != "") ? $_POST["experiencia"] : "";
	$funciones = (isset($_POST["funciones"]) && $_POST["funciones"] != "") ? $_POST["funciones"] : "";
	$competencias = (isset($_POST["competencias"]) && $_POST["competencias"] != "") ? $_POST["competencias"] : "";
	$discapacidades = (isset($_POST["discapacidades"]) && $_POST["discapacidades"] != "") ? $_POST["discapacidades"] : "";
	$inicio = (isset($_POST["inicio"]) && $_POST["inicio"] != "") ? $_POST["inicio"] : "";
	$fin = (isset($_POST["fin"]) && $_POST["fin"] != "") ? $_POST["fin"] : "";
	$activo = (isset($_POST["activo"]) && $_POST["activo"] == "X") ? "X" : "";
	
	if ($vacante != "" && $titulo != "" && $descripcion != "" && $area != "" && $inicio != "" && $fin != "") {
		
		if (date($fin) >= date($inicio)) {
			
			$core["vacantes"]->setVacante($vacante);
			$core["vacantes"]->Cargar();
			
			$core["vacantes"]->setTipo($tipo);
			$core["vacantes"]->setUbicacion($ubicacion);
			$core["vacantes"]->setArea($area);
			$core["vacantes"]->setTitulo($titulo);
			$core["vacantes"]->setDescripcion($descripcion);
			$core["vacantes"]->setFormacion($formacion);
			$core["vacantes"]->setConocimientos($conocimientos);
			$core["vacantes"]->setExperiencia($experiencia);
			$core["vacantes"]->setFunciones($funciones);
			$core["vacantes"]->setCompetencias($competencias);
			$core["vacantes"]->setDiscapacidades($discapacidades);
			$core["vacantes"]->setInicio($inicio);
			$core["vacantes"]->setFin($fin);
			$core["vacantes"]->setActivo($activo);
			
			// Manejo de la Imagen
			
			$nombre = $_FILES["anexo"]["name"];
			$temporal = $_FILES["anexo"]["tmp_name"];
			$tipo = $_FILES["anexo"]["type"];
			$tamano = $_FILES["anexo"]["size"];
			
			$directorio = "../anexos/";
			$instante = $core["funciones"]->NuevoID();
			$nuevo = $instante . "_" . $nombre;
			$destino = $directorio . $nuevo;
			
			if (is_uploaded_file($temporal)) {
				if (move_uploaded_file($temporal, $destino)) {
					unlink($directorio . $core["vacantes"]->getAnexo());
					$core["vacantes"]->setAnexo($nuevo);
				}
			}
			
			if ($core["vacantes"]->Actualizar()) {
				
				$core["sesion"]->setMensaje("Vacante actualizada exitosamente");
				
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar agregar la vacante, consulte al administrador.");	
			}			
			
		} else {
			$core["sesion"]->setMensaje("La fecha final no puede ser anterior a la fecha inicial.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar los datos de la vacante");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>