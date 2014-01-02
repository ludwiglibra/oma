<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$usuario_seleccionado = $core["sesion"]->getVariable("usuario_seleccionado");
	
	$pagina = "index.php";

	$imagen = (isset($_POST["imagen"]) && $_POST["imagen"] != "") ? $_POST["imagen"] : "";
	$titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != "") ? $_POST["titulo"] : "";
	$descripcion = (isset($_POST["descripcion"]) && $_POST["descripcion"] != "") ? $_POST["descripcion"] : "";
	$liga = (isset($_POST["liga"]) && $_POST["liga"] != "") ? $_POST["liga"] : "";
	$activo = (isset($_POST["activo"]) && $_POST["activo"] == "X") ? "X" : "";
	
	if ($imagen != "" && $titulo != "" ) {
			
		$core["imagenes"]->setImagen($imagen);
		$core["imagenes"]->Cargar();
		
		$core["imagenes"]->setTitulo($titulo);
		$core["imagenes"]->setDescripcion($descripcion);
		$core["imagenes"]->setLiga($liga);
		$core["imagenes"]->setActivo($activo);
		
		if ($core["imagenes"]->Actualizar()) {
			$core["sesion"]->setMensaje("Datos de imagen actualizados exitosamente.");
		} else {
			$core["sesion"]->setMensaje("Error de base de datos, contactar al administrador.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para actualizar los datos de la imagen");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>