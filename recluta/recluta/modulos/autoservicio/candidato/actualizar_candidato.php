<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	if ($vacante != "") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "./";
	}
	
	$candidato = $sesion_usuario;
	$tipo = (isset($_POST["tipo"]) && $_POST["tipo"] != "") ? $_POST["tipo"] : "";
	$empleado = (isset($_POST["empleado"]) && $_POST["empleado"] != "") ? $_POST["empleado"] : "";
	
	if ($tipo != "") {
		
		if (($tipo == "I" && $empleado != "") || ($tipo == "E" && $empleado == "")) {
			
			$core["candidatos"]->setCandidato($candidato);
			$core["candidatos"]->Cargar();
			
			$core["candidatos"]->setTipo($tipo);
			$core["candidatos"]->setEmpleado($empleado);
			
			if ($core["candidatos"]->Existe($candidato)) {
				
				if ($core["candidatos"]->Actualizar()) {
					$core["sesion"]->setMensaje("Los datos de contacto de su usuario fueron actualizados exitosamente.");
				} else {
					$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información de candidato, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
				}
				
			} else {
				
				if ($core["candidatos"]->Agregar()) {
					$core["sesion"]->setMensaje("Los datos de contacto de su usuario fueron agregados exitosamente.");
				} else {
					$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar la información de candidato, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
				}
				
			}
			
		} else {
			
			$core["sesion"]->setMensaje("Los candidatos internos deben acompañarse de clave de empleado y los externos deben carecer de ella.");
			
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar los datos del candidato.");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>