<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	if ($vacante != "") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "./mant_experiencias.php";
	}
	
	$candidato = $sesion_usuario;
	$titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != "") ? $_POST["titulo"] : "";
	$puesto = (isset($_POST["puesto"]) && $_POST["puesto"] != "") ? $_POST["puesto"] : "";
	$seniority = (isset($_POST["seniority"]) && $_POST["seniority"] != "") ? $_POST["seniority"] : "";
	$empresa = (isset($_POST["empresa"]) && $_POST["empresa"] != "") ? $_POST["empresa"] : "";
	$pais = (isset($_POST["pais"]) && $_POST["pais"] != "") ? $_POST["pais"] : "";
	$mes_inicio = (isset($_POST["mes_inicio"]) && $_POST["mes_inicio"] != "") ? $_POST["mes_inicio"] : "";
	$ano_inicio = (isset($_POST["ano_inicio"]) && $_POST["ano_inicio"] != "") ? $_POST["ano_inicio"] : "";
	$mes_fin = (isset($_POST["mes_fin"]) && $_POST["mes_fin"] != "") ? $_POST["mes_fin"] : "";
	$ano_fin = (isset($_POST["ano_fin"]) && $_POST["ano_fin"] != "") ? $_POST["ano_fin"] : "";
	$presente = (isset($_POST["presente"]) && $_POST["presente"] == "X") ? "X" : "";
	$area = (isset($_POST["area"]) && $_POST["area"] != "") ? $_POST["area"] : "";
	$subarea = (isset($_POST["subarea"]) && $_POST["subarea"] != "") ? $_POST["subarea"] : "";
	$industria = (isset($_POST["industria"]) && $_POST["industria"] != "") ? $_POST["industria"] : "";
	$responsabilidades = (isset($_POST["responsabilidades"]) && $_POST["responsabilidades"] != "") ? $_POST["responsabilidades"] : "";
	$anterior = (isset($_POST["anterior"]) && $_POST["anterior"] != "") ? $_POST["anterior"] : "";
	$actual = (isset($_POST["actual"]) && $_POST["actual"] != "") ? $_POST["actual"] : "";
	$expectativa = (isset($_POST["expectativa"]) && $_POST["expectativa"] != "") ? $_POST["expectativa"] : "";
	
	$core["experiencias"]->setCandidato($candidato);
	$core["experiencias"]->Cargar();
	
	$core["experiencias"]->setTitulo($titulo);
	$core["experiencias"]->setPuesto($puesto);
	$core["experiencias"]->setSeniority($seniority);
	$core["experiencias"]->setEmpresa($empresa);
	$core["experiencias"]->setPais($pais);
	$core["experiencias"]->setMes_Inicio($mes_inicio);
	$core["experiencias"]->setAno_Inicio($ano_inicio);
	$core["experiencias"]->setMes_Fin($mes_fin);
	$core["experiencias"]->setAno_Fin($ano_fin);
	$core["experiencias"]->setPresente($presente);
	$core["experiencias"]->setArea($area);
	$core["experiencias"]->setSubarea($subarea);	
	$core["experiencias"]->setIndustria($industria);	
	$core["experiencias"]->setResponsabilidades($responsabilidades);	
	$core["experiencias"]->setAnterior($anterior);	
	$core["experiencias"]->setActual($actual);	
	$core["experiencias"]->setExpectativa($expectativa);	
	
	if ($core["experiencias"]->Existe($candidato)) {
		
		if ($core["experiencias"]->Actualizar()) {
			$core["sesion"]->setMensaje("Los datos de experiencias de su usuario fueron actualizados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información de experiencias, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	} else {
		
		if ($core["experiencias"]->Agregar()) {
			$core["sesion"]->setMensaje("Los datos de experiencias de su usuario fueron agregados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar la información de experiencias, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	}
	
	header("Location: " . $pagina);
	exit;
	
?>