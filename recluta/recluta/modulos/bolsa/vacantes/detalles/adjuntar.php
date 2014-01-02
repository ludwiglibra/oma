<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "index.php#Adjuntos";
	
	$vacante = (isset($_POST["vacante"]) && $_POST["vacante"] != "") ? $_POST["vacante"] : "";
	
	$nombre = $_FILES["archivo"]["name"];
	$temporal = $_FILES["archivo"]["tmp_name"];
	$tipo = $_FILES["archivo"]["type"];
	$tamano = $_FILES["archivo"]["size"];
	
	$directorio = "../../../../archivos/";
	$instante = $core["funciones"]->NuevoID();
	$nuevo = $instante . "_" . $nombre;
	$destino = $directorio . $nuevo;
		
	if ($vacante != "" && is_uploaded_file($temporal)) {
		
		if (move_uploaded_file($temporal, $destino)) {
			
			$core["archivos"]->setTabla("vacantes");
			$core["archivos"]->setValor1($vacante);
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