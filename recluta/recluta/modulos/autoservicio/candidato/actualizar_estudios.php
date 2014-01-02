<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	if ($vacante != "") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "./mant_estudios.php";
	}
	
	$candidato = $sesion_usuario;
	$secuencia = (isset($_POST["secuencia"]) && $_POST["secuencia"] != "") ? $_POST["secuencia"] : "";
	$titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != "") ? $_POST["titulo"] : "";
	$pais = (isset($_POST["pais"]) && $_POST["pais"] != "") ? $_POST["pais"] : "";
	$institucion = (isset($_POST["institucion"]) && $_POST["institucion"] != "") ? $_POST["institucion"] : "";
	$mes_inicio = (isset($_POST["mes_inicio"]) && $_POST["mes_inicio"] != "") ? $_POST["mes_inicio"] : "";
	$ano_inicio = (isset($_POST["ano_inicio"]) && $_POST["ano_inicio"] != "") ? $_POST["ano_inicio"] : "";
	$mes_fin = (isset($_POST["mes_fin"]) && $_POST["mes_fin"] != "") ? $_POST["mes_fin"] : "";
	$ano_fin = (isset($_POST["ano_fin"]) && $_POST["ano_fin"] != "") ? $_POST["ano_fin"] : "";
	$presente = (isset($_POST["presente"]) && $_POST["presente"] == "X") ? "X" : "";
	$escolaridad = (isset($_POST["escolaridad"]) && $_POST["escolaridad"] != "") ? $_POST["escolaridad"] : "";
	
	if ($candidato != "" && $titulo != "") {
	
		if ($secuencia == 0) {
			$secuencia = $core["estudios"]->SecuenciaSiguiente($candidato);
		}
		
		$core["estudios"]->setCandidato($candidato);
		$core["estudios"]->setSecuencia($secuencia);
		
		$core["estudios"]->Cargar();
		
		$core["estudios"]->setTitulo($titulo);
		$core["estudios"]->setPais($pais);
		$core["estudios"]->setInstitucion($institucion);
		$core["estudios"]->setMes_Inicio($mes_inicio);
		$core["estudios"]->setAno_Inicio($ano_inicio);
		$core["estudios"]->setMes_Fin($mes_fin);
		$core["estudios"]->setAno_Fin($ano_fin);
		$core["estudios"]->setPresente($presente);
		$core["estudios"]->setEscolaridad($escolaridad);	
		
		if ($core["estudios"]->Existe($candidato, $secuencia)) {
			
			if ($core["estudios"]->Actualizar()) {
				$core["sesion"]->setMensaje("Los datos de estudio de su usuario fueron actualizados exitosamente.");
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información de estudio, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
			}
			
		} else {
			
			if ($core["estudios"]->Agregar()) {
				$core["sesion"]->setMensaje("Los datos de estudio de su usuario fueron agregados exitosamente.");
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar la información de estudio, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
			}
			
		}
	
	} else {
		$core["sesion"]->setMensaje("El título del registro de estudios es un campo requerido");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>