<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = (isset($_POST["vacante"]) && $_POST["vacante"] != "") ? $_POST["vacante"] : "";
	$core["sesion"]->setVariable("campo_vacante", $vacante);
	
	if ($vacante == "X") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "./";
	}
	
	$usuario = $sesion_usuario;
	$nombres = (isset($_POST["nombres"]) && $_POST["nombres"] != "") ? $_POST["nombres"] : "";
	$apellidos = (isset($_POST["apellidos"]) && $_POST["apellidos"] != "") ? $_POST["apellidos"] : "";
	$prefcelular = (isset($_POST["prefcelular"]) && $_POST["prefcelular"] != "") ? $_POST["prefcelular"] : "";
	$celular = (isset($_POST["celular"]) && $_POST["celular"] != "") ? $_POST["celular"] : "";
	$preffijo = (isset($_POST["preffijo"]) && $_POST["preffijo"] != "") ? $_POST["preffijo"] : "";
	$fijo = (isset($_POST["fijo"]) && $_POST["fijo"] != "") ? $_POST["fijo"] : "";
	$nacionalidad = (isset($_POST["nacionalidad"]) && $_POST["nacionalidad"] != "") ? $_POST["nacionalidad"] : "";
	$nacimiento = (isset($_POST["nacimiento"]) && $_POST["nacimiento"] != "") ? $_POST["nacimiento"] : "";
	$genero = (isset($_POST["genero"]) && $_POST["genero"] != "") ? $_POST["genero"] : "";
	$civil = (isset($_POST["civil"]) && $_POST["civil"] != "") ? $_POST["civil"] : "";
	$dependientes = (isset($_POST["dependientes"]) && $_POST["dependientes"] != "") ? $_POST["dependientes"] : "";
	$domicilio = (isset($_POST["domicilio"]) && $_POST["domicilio"] != "") ? $_POST["domicilio"] : "";
	
	if ($usuario != "" && $nombres != "" && $apellidos != "") {
			
		$core["generales"]->setUsuario($usuario);
		$core["generales"]->Cargar();
		
		$core["generales"]->setNombres($nombres);
		$core["generales"]->setApellidos($apellidos);
		$core["generales"]->setPrefcelular($prefcelular);
		$core["generales"]->setCelular($celular);
		$core["generales"]->setPreffijo($preffijo);
		$core["generales"]->setFijo($fijo);
		$core["generales"]->setNacionalidad($nacionalidad);
		$core["generales"]->setNacimiento($nacimiento);
		$core["generales"]->setGenero($genero);
		$core["generales"]->setCivil($civil);
		$core["generales"]->setDependientes($dependientes);
		$core["generales"]->setDomicilio($domicilio);
		
		if ($core["generales"]->Existe($usuario)) {
			
			if ($core["generales"]->Actualizar()) {
				$core["sesion"]->setMensaje("Los datos generales de su usuario fueron actualizados correctamente.");
			} else {
				$core["sesion"]->setMensaje("Error de base de datos al intentar actualizar sus datos generales.");
			}
			
		} else {
			
			if ($core["generales"]->Agregar()) {
				$core["sesion"]->setMensaje("Los datos generales de su usuario fueron agregados correctamente.");
			} else {
				$core["sesion"]->setMensaje("Error de base de datos al intentar agregar sus datos generales.");
			}
			
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar los datos generales de su usuario");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>