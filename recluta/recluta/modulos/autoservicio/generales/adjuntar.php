<?PHP

	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "./";
	
	$nombre = $_FILES["archivo"]["name"];
	$temporal = $_FILES["archivo"]["tmp_name"];
	$tipo = $_FILES["archivo"]["type"];
	$tamano = $_FILES["archivo"]["size"];
	
	$directorio = "avatares/";
	$nuevo = $sesion_usuario . ".jpg";
	$destino = $directorio . $nuevo;
	
	$componentes = explode(".", $nombre);
	
	if (strtoupper($componentes[count($componentes) - 1]) == "JPG") {

		if (is_uploaded_file($temporal)) {
		
			if (file_exists($destino)) {
				unlink($destino);
			}
			
			if (move_uploaded_file($temporal, $destino)) {
				
				$core["sesion"]->setMensaje("Avatar almacenado exitosamente.");
				
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error al intentar almacenar el archivo en el repositorio, favor de contactar al administrador.");
			}
			
		} else {
			$core["sesion"]->setMensaje("No existen las condiciones mínimas para adjuntar un archivo a la vacante.");
		}
	} else {
		$core["sesion"]->setMensaje("Sólo se permiten archivos JPG.");
	}
	
	header("Location: " . $pagina);
	exit;

?>