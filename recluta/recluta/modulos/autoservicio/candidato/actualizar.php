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
	
	$candidato = (isset($_POST["candidato"]) && $_POST["candidato"] != "") ? $_POST["candidato"] : "";
	
	/* Procesar Sección de Candidatos */
	
	$candidato_tipo = (isset($_POST["candidato_tipo"]) && $_POST["candidato_tipo"] != "") ? $_POST["candidato_tipo"] : "";
	$candidato_empleado = (isset($_POST["candidato_empleado"]) && $_POST["candidato_empleado"] != "") ? $_POST["candidato_empleado"] : "";
	
	if ($candidato_tipo != "") {
		
		if (($candidato_tipo == "I" && $candidato_empleado != "") || ($candidato_tipo == "E" && $candidato_empleado == "")) {
			
			$core["candidatos"]->setCandidato($candidato);
			$core["candidatos"]->Cargar();
			
			$core["candidatos"]->setTipo($candidato_tipo);
			$core["candidatos"]->setEmpleado($candidato_empleado);
			
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
	
	/* Procesar Sección de Estudios */
	
	$estudios_secuencia = (isset($_POST["estudios_secuencia"]) && $_POST["estudios_secuencia"] != "") ? $_POST["estudios_secuencia"] : "";
	$estudios_titulo = (isset($_POST["estudios_titulo"]) && $_POST["estudios_titulo"] != "") ? $_POST["estudios_titulo"] : "";
	$estudios_pais = (isset($_POST["estudios_pais"]) && $_POST["estudios_pais"] != "") ? $_POST["estudios_pais"] : "";
	$estudios_institucion = (isset($_POST["estudios_institucion"]) && $_POST["estudios_institucion"] != "") ? $_POST["estudios_institucion"] : "";
	$estudios_mes_inicio = (isset($_POST["estudios_mes_inicio"]) && $_POST["estudios_mes_inicio"] != "") ? $_POST["estudios_mes_inicio"] : "";
	$estudios_ano_inicio = (isset($_POST["estudios_ano_inicio"]) && $_POST["estudios_ano_inicio"] != "") ? $_POST["estudios_ano_inicio"] : "";
	$estudios_mes_fin = (isset($_POST["estudios_mes_fin"]) && $_POST["estudios_mes_fin"] != "") ? $_POST["estudios_mes_fin"] : "";
	$estudios_ano_fin = (isset($_POST["estudios_ano_fin"]) && $_POST["estudios_ano_fin"] != "") ? $_POST["estudios_ano_fin"] : "";
	$estudios_presente = (isset($_POST["estudios_presente"]) && $_POST["estudios_presente"] != "") ? $_POST["estudios_presente"] : "";
	$estudios_escolaridad = (isset($_POST["estudios_escolaridad"]) && $_POST["estudios_escolaridad"] != "") ? $_POST["estudios_escolaridad"] : "";
	
	foreach ($estudios_secuencia as $indice => $registro) {
		
		if ($estudios_titulo[$registro] != "") {
	
			if ($estudios_secuencia[$registro] == 0) {
				$estudios_secuencia[$registro] = $core["estudios"]->SecuenciaSiguiente($candidato);
			}
			
			$core["estudios"]->setCandidato($candidato);
			$core["estudios"]->setSecuencia($estudios_secuencia[$registro]);
			
			$core["estudios"]->Cargar();
			
			$core["estudios"]->setTitulo($estudios_titulo[$registro]);
			$core["estudios"]->setPais($estudios_pais[$registro]);
			$core["estudios"]->setInstitucion($estudios_institucion[$registro]);
			$core["estudios"]->setMes_Inicio($estudios_mes_inicio[$registro]);
			$core["estudios"]->setAno_Inicio($estudios_ano_inicio[$registro]);
			$core["estudios"]->setMes_Fin($estudios_mes_fin[$registro]);
			$core["estudios"]->setAno_Fin($estudios_ano_fin[$registro]);
			
			if (isset($estudios_presente[$registro])) {
				$core["estudios"]->setPresente($estudios_presente[$registro]);
			}
			
			$core["estudios"]->setEscolaridad($estudios_escolaridad[$registro]);	
			
			if ($core["estudios"]->Existe($candidato, $estudios_secuencia[$registro])) {
				
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
		
	}
	
	/* Procesar Sección de Idiomas */
	
	$idiomas_secuencia = (isset($_POST["idiomas_secuencia"]) && $_POST["idiomas_secuencia"] != "") ? $_POST["idiomas_secuencia"] : "";
	$idiomas_idioma = (isset($_POST["idiomas_idioma"]) && $_POST["idiomas_idioma"] != "") ? $_POST["idiomas_idioma"] : "";
	$idiomas_escrito = (isset($_POST["idiomas_escrito"]) && $_POST["idiomas_escrito"] != "") ? $_POST["idiomas_escrito"] : "";
	$idiomas_oral = (isset($_POST["idiomas_oral"]) && $_POST["idiomas_oral"] != "") ? $_POST["idiomas_oral"] : "";
	
	foreach ($idiomas_secuencia as $indice => $registro) {
		
		if ($idiomas_secuencia[$registro] == "0") {
			$idiomas_secuencia[$registro] = $core["idiomas"]->SecuenciaSiguiente($candidato);
		}
		
		$core["idiomas"]->setCandidato($candidato);
		$core["idiomas"]->setSecuencia($idiomas_secuencia[$registro]);
		$core["idiomas"]->Cargar();
		
		$core["idiomas"]->setIdioma($idiomas_idioma[$registro]);
		$core["idiomas"]->setEscrito($idiomas_escrito[$registro]);
		$core["idiomas"]->setOral($idiomas_oral[$registro]);
		
		if ($core["idiomas"]->Existe($candidato, $idiomas_secuencia[$registro])) {
			
			if ($core["idiomas"]->Actualizar()) {
				$core["sesion"]->setMensaje("Los datos de idioma de su usuario fueron actualizados exitosamente.");
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información de idioma, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
			}
			
		} else {
			
			if ($core["idiomas"]->Agregar()) {
				$core["sesion"]->setMensaje("Los datos de idioma de su usuario fueron agregados exitosamente.");
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar la información de idioma, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
			}
			
		}
		
	}
	
	/* Procesar Sección de Informática */
	
	$informatica_secuencia = (isset($_POST["informatica_secuencia"]) && $_POST["informatica_secuencia"] != "") ? $_POST["informatica_secuencia"] : "";
	$informatica_conocimiento = (isset($_POST["informatica_conocimiento"]) && $_POST["informatica_conocimiento"] != "") ? $_POST["informatica_conocimiento"] : "";
	$informatica_nivel = (isset($_POST["informatica_nivel"]) && $_POST["informatica_nivel"] != "") ? $_POST["informatica_nivel"] : "";
	
	foreach ($informatica_secuencia as $indice => $registro) {
		
		if ($informatica_secuencia[$registro] == "0") {
			$informatica_secuencia[$registro] = $core["informatica"]->SecuenciaSiguiente($candidato);
		}
				
		$core["informatica"]->setCandidato($candidato);
		$core["informatica"]->setSecuencia($informatica_secuencia[$registro]);
		$core["informatica"]->Cargar();
		
		$core["informatica"]->setConocimiento($informatica_conocimiento[$registro]);
		$core["informatica"]->setNivel($informatica_nivel[$registro]);
		
		if ($core["informatica"]->Existe($candidato, $informatica_secuencia[$registro])) {
			
			if ($core["informatica"]->Actualizar()) {
				$core["sesion"]->setMensaje("Los datos de informática de su usuario fueron actualizados exitosamente.");
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información de informática, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
			}
			
		} else {
			
			if ($core["informatica"]->Agregar()) {
				$core["sesion"]->setMensaje("Los datos de informática de su usuario fueron agregados exitosamente.");
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar la información de informática, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
			}
			
		}
		
	}
	
	/* Procesar Sección de Experiencias */
	
	$experiencias_secuencia = (isset($_POST["experiencias_secuencia"]) && $_POST["experiencias_secuencia"] != "") ? $_POST["experiencias_secuencia"] : "";
	$experiencias_titulo = (isset($_POST["experiencias_titulo"]) && $_POST["experiencias_titulo"] != "") ? $_POST["experiencias_titulo"] : "";
	$experiencias_puesto = (isset($_POST["experiencias_puesto"]) && $_POST["experiencias_puesto"] != "") ? $_POST["experiencias_puesto"] : "";
	$experiencias_seniority = (isset($_POST["experiencias_seniority"]) && $_POST["experiencias_seniority"] != "") ? $_POST["experiencias_seniority"] : "";
	$experiencias_empresa = (isset($_POST["experiencias_empresa"]) && $_POST["experiencias_empresa"] != "") ? $_POST["experiencias_empresa"] : "";
	$experiencias_pais = (isset($_POST["experiencias_pais"]) && $_POST["experiencias_pais"] != "") ? $_POST["experiencias_pais"] : "";
	$experiencias_mes_inicio = (isset($_POST["experiencias_mes_inicio"]) && $_POST["experiencias_mes_inicio"] != "") ? $_POST["experiencias_mes_inicio"] : "";
	$experiencias_ano_inicio = (isset($_POST["experiencias_ano_inicio"]) && $_POST["experiencias_ano_inicio"] != "") ? $_POST["experiencias_ano_inicio"] : "";
	$experiencias_mes_fin = (isset($_POST["experiencias_mes_fin"]) && $_POST["experiencias_mes_fin"] != "") ? $_POST["experiencias_mes_fin"] : "";
	$experiencias_ano_fin = (isset($_POST["experiencias_ano_fin"]) && $_POST["experiencias_ano_fin"] != "") ? $_POST["experiencias_ano_fin"] : "";
	$experiencias_presente = (isset($_POST["experiencias_presente"]) && $_POST["experiencias_presente"] != "") ? $_POST["experiencias_presente"] : "";
	$experiencias_area = (isset($_POST["experiencias_area"]) && $_POST["experiencias_area"] != "") ? $_POST["experiencias_area"] : "";
	$experiencias_subarea = (isset($_POST["experiencias_subarea"]) && $_POST["experiencias_subarea"] != "") ? $_POST["experiencias_subarea"] : "";
	$experiencias_industria = (isset($_POST["experiencias_industria"]) && $_POST["experiencias_industria"] != "") ? $_POST["experiencias_industria"] : "";
	$experiencias_responsabilidades = (isset($_POST["experiencias_responsabilidades"]) && $_POST["experiencias_responsabilidades"] != "") ? $_POST["experiencias_responsabilidades"] : "";
		
	foreach ($experiencias_secuencia as $indice => $registro) {
		
		if ($experiencias_secuencia[$registro] == "0") {
			$experiencias_secuencia[$registro] = $core["experiencias"]->SecuenciaSiguiente($candidato);
		}
		
		$core["experiencias"]->setCandidato($candidato);
		$core["experiencias"]->setSecuencia($experiencias_secuencia[$registro]);
		$core["experiencias"]->Cargar();
		
		$core["experiencias"]->setTitulo($experiencias_titulo[$registro]);
		$core["experiencias"]->setPuesto($experiencias_puesto[$registro]);
		$core["experiencias"]->setSeniority($experiencias_seniority[$registro]);
		$core["experiencias"]->setEmpresa($experiencias_empresa[$registro]);
		$core["experiencias"]->setPais($experiencias_pais[$registro]);
		$core["experiencias"]->setMes_Inicio($experiencias_mes_inicio[$registro]);
		$core["experiencias"]->setAno_Inicio($experiencias_ano_inicio[$registro]);
		$core["experiencias"]->setMes_Fin($experiencias_mes_fin[$registro]);
		$core["experiencias"]->setAno_Fin($experiencias_ano_fin[$registro]);
		
		if (isset($experiencias_presente[$registro])) {
			$core["experiencias"]->setPresente($experiencias_presente[$registro]);
		}
		
		$core["experiencias"]->setArea($experiencias_area[$registro]);
		$core["experiencias"]->setSubarea($experiencias_subarea[$registro]);	
		$core["experiencias"]->setIndustria($experiencias_industria[$registro]);	
		$core["experiencias"]->setResponsabilidades($experiencias_responsabilidades[$registro]);	
		
		if ($core["experiencias"]->Existe($candidato, $experiencias_secuencia[$registro])) {
			
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
		
	}
	
	/* Procesar Sección de Experiencias */
	
	$salarial_actual = (isset($_POST["salarial_actual"]) && $_POST["salarial_actual"] != "") ? $_POST["salarial_actual"] : "";
	$salarial_expectativas = (isset($_POST["salarial_expectativas"]) && $_POST["salarial_expectativas"] != "") ? $_POST["salarial_expectativas"] : "";
	
	$core["salarial"]->setCandidato($candidato);
	$core["salarial"]->Cargar();
	
	$core["salarial"]->setActual($salarial_actual);
	$core["salarial"]->setExpectativas($salarial_expectativas);
	
	if ($core["salarial"]->Existe($candidato)) {
		
		if ($core["salarial"]->Actualizar()) {
			$core["sesion"]->setMensaje("Los datos salariales de su usuario fueron actualizados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al actualizar la información salarial, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	} else {
		
		if ($core["salarial"]->Agregar()) {
			$core["sesion"]->setMensaje("Los datos salariales de su usuario fueron agregados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error de base de datos al agregar la información salarial, favor de contactar al administrador en " . $core["parametros"]->getContacto() . ".");
		}
		
	}	
	
	/* Procesar Redireccionamiento */
	
	$temporal = $pagina;
	
	$pagina = (isset($_GET["pagina"]) && $_GET["pagina"] != "") ? $_GET["pagina"] : "";	
	$candidato = (isset($_GET["candidato"]) && $_GET["candidato"] != "") ? $_GET["candidato"] : "";	
	$secuencia = (isset($_GET["secuencia"]) && $_GET["secuencia"] != "") ? $_GET["secuencia"] : "";	
	
	switch ($pagina) {
		case "agregar_estudios.php";
			$pagina.= "?candidato=" . $candidato;
			break;
		case "eliminar_estudios.php";
			$pagina.= "?candidato=" . $candidato . "&secuencia=" . $secuencia;
			break;
		case "agregar_idiomas.php";
			$pagina.= "?candidato=" . $candidato;
			break;
		case "eliminar_idiomas.php";
			$pagina.= "?candidato=" . $candidato . "&secuencia=" . $secuencia;
			break;
		case "agregar_informatica.php";
			$pagina.= "?candidato=" . $candidato;
			break;
		case "eliminar_informatica.php";
			$pagina.= "?candidato=" . $candidato . "&secuencia=" . $secuencia;
			break;
		case "agregar_experiencia.php";
			$pagina.= "?candidato=" . $candidato;
			break;
		case "eliminar_experiencia.php";
			$pagina.= "?candidato=" . $candidato . "&secuencia=" . $secuencia;
			break;
	}
	
	if ($pagina == "") {
		$pagina = $temporal;
	}
	
	header("Location: " . $pagina);
	exit;
	
?>