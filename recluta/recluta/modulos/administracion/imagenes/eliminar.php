<?PHP
	
	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$imagen = (isset($_GET["imagen"]) && $_GET["imagen"] != "") ? $_GET["imagen"] : "";
	
	$pagina = "index.php";
	
	if ($imagen != "" && $core["imagenes"]->Existe($imagen)) {
		
		$core["imagenes"]->setImagen($imagen);
		$core["imagenes"]->Cargar();
		
		$archivo = $core["imagenes"]->getArchivo();
		
		if ($core["imagenes"]->Eliminar()) {
			unlink("archivos/" . $archivo);
		}
		
		$core["sesion"]->setMensaje("Imagen eliminada exitosamente");
		
	}
	
	header("Location: " . $pagina);
	exit;

?>