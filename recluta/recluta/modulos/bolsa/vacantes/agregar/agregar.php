<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
		
	$pagina = "index.php";
	
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
	
	$core["sesion"]->setVariable("campo_tipo", $tipo);
	$core["sesion"]->setVariable("campo_ubicacion", $ubicacion);
	$core["sesion"]->setVariable("campo_area", $area);
	$core["sesion"]->setVariable("campo_titulo", $titulo);
	$core["sesion"]->setVariable("campo_descripcion", $descripcion);
	$core["sesion"]->setVariable("campo_formacion", $formacion);
	$core["sesion"]->setVariable("campo_conocimientos", $conocimientos);
	$core["sesion"]->setVariable("campo_experiencia", $experiencia);
	$core["sesion"]->setVariable("campo_funciones", $funciones);
	$core["sesion"]->setVariable("campo_competencias", $competencias);
	$core["sesion"]->setVariable("campo_discapacidades", $discapacidades);
	$core["sesion"]->setVariable("campo_inicio", $inicio);
	$core["sesion"]->setVariable("campo_fin", $fin);
	
	if ($tipo != "" && $titulo != "" && $descripcion != "" && $area != "" && $inicio != "" && $fin != "") {
				
		if (date($fin) >= date($inicio)) {

			if ($core["vacantes"]->Reservar()) {
				
				$nombre = $_FILES["anexo"]["name"];
				$temporal = $_FILES["anexo"]["tmp_name"];
				$tipo = $_FILES["anexo"]["type"];
				$tamano = $_FILES["anexo"]["size"];
				
				$directorio = "../anexos/";
				$instante = $core["funciones"]->NuevoID();
				$nuevo = $instante . "_" . $nombre;
				$destino = $directorio . $nuevo;
				
				$anexo = "";
				
				if (is_uploaded_file($temporal)) {
					if (move_uploaded_file($temporal, $destino)) {
						$anexo = $nuevo;
					}
				}
				
				$core["vacantes"]->setTipo($tipo);
				$core["vacantes"]->setUbicacion($ubicacion);
				$core["vacantes"]->setArea($area);
				$core["vacantes"]->setTitulo($titulo);
				$core["vacantes"]->setDescripcion($descripcion);
				$core["vacantes"]->setAnexo($anexo);
				$core["vacantes"]->setFormacion($formacion);
				$core["vacantes"]->setConocimientos($conocimientos);
				$core["vacantes"]->setExperiencia($experiencia);
				$core["vacantes"]->setFunciones($funciones);
				$core["vacantes"]->setCompetencias($competencias);
				$core["vacantes"]->setDiscapacidades($discapacidades);
				$core["vacantes"]->setInicio($inicio);
				$core["vacantes"]->setFin($fin);
				$core["vacantes"]->setActivo("X");
								
				if ($core["vacantes"]->Actualizar()) {
					
					$core["sesion"]->setVariable("vacante_seleccionada", $core["vacantes"]->getVacante());
					$pagina = "../detalles/";
					
					$core["sesion"]->setVariable("campo_tipo", "");
					$core["sesion"]->setVariable("campo_ubicacion", "");
					$core["sesion"]->setVariable("campo_area", "");
					$core["sesion"]->setVariable("campo_titulo", "");
					$core["sesion"]->setVariable("campo_descripcion", "");
					$core["sesion"]->setVariable("campo_formacion", "");
					$core["sesion"]->setVariable("campo_conocimientos", "");
					$core["sesion"]->setVariable("campo_experiencia", "");
					$core["sesion"]->setVariable("campo_funciones", "");
					$core["sesion"]->setVariable("campo_competencias", "");
					$core["sesion"]->setVariable("campo_discapacidades", "");
					$core["sesion"]->setVariable("campo_inicio", "");
					$core["sesion"]->setVariable("campo_fin", "");
					
				} else {
					$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar agregar la vacante, consulte al administrador.");	
				}				
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al intentar reservar el ID de vacante, consulte al administrador.");	
			}
		} else {
			$core["sesion"]->setMensaje("La fecha final no puede ser anterior a la fecha inicial.");	
		}
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar la vacante.");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>