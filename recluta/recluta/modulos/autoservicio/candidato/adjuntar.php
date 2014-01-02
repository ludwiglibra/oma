<?PHP

	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	if ($vacante != "") {
		$pagina = "../../candidatos/vacantes/participar/";
	} else {
		$pagina = "./index.php#SeccionAdjuntos";
	}
	
	$candidato = (isset($_POST["candidato"]) && $_POST["candidato"] != "") ? $_POST["candidato"] : "";
	
	$nombre = $_FILES["archivo"]["name"];
	$temporal = $_FILES["archivo"]["tmp_name"];
	$tipo = $_FILES["archivo"]["type"];
	$tamano = $_FILES["archivo"]["size"];
	
	$directorio = "archivos/";
	$instante = $core["funciones"]->NuevoID();
	$nuevo = $instante . "_" . $nombre;
	$destino = $directorio . $nuevo;
		
	if ($candidato != "" && is_uploaded_file($temporal)) {
		
		if (move_uploaded_file($temporal, $destino)) {
			
			$core["archivos"]->setTabla("candidatos");
			$core["archivos"]->setValor1($candidato);
			$core["archivos"]->setArchivo($nuevo);

			if ($core["archivos"]->Agregar()) {
				$core["sesion"]->setMensaje("Se adjuntó exitosamente el archivo " . $nombre . ".");
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error al intentar registrar el archivo adjunto en la base de datos, favor de contactar al administrador.");
			}
			
		} else {
			$core["sesion"]->setMensaje("Ocurrió un error al intentar almacenar el archivo en el repositorio, favor de contactar al administrador.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para adjuntar un archivo a la vacante.");
	}
	
	header("Location: " . $pagina);
	exit;

?>