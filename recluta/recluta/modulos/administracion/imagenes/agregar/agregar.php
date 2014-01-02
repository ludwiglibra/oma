<?PHP
	
	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
		
	$pagina = "./";
	
	$titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != "") ? $_POST["titulo"] : "";
	$descripcion = (isset($_POST["descripcion"]) && $_POST["descripcion"] != "") ? $_POST["descripcion"] : "";
	$liga = (isset($_POST["liga"]) && $_POST["liga"] != "") ? $_POST["liga"] : "";
	
	$core["sesion"]->setVariable("campo_titulo", $titulo);
	$core["sesion"]->setVariable("campo_descripcion", $descripcion);
	$core["sesion"]->setVariable("campo_liga", $liga);
	
	$nombre = $_FILES["archivo"]["name"];
	$temporal = $_FILES["archivo"]["tmp_name"];
	$tipo = $_FILES["archivo"]["type"];
	$tamano = $_FILES["archivo"]["size"];
	
	$directorio = "../archivos/";
	$instante = $core["funciones"]->NuevoID();
	$nuevo = $instante . "_" . $nombre;
	$destino = $directorio . $nuevo;
	$imagen = $instante;
		
	if ($titulo != "" && is_uploaded_file($temporal)) {
		
		$permitidos = array("JPG", "PNG", "JPEG", "BMP");
		$componentes = explode(".", $nombre);
		$extension = strtoupper($componentes[count($componentes) - 1]);
		
		if (in_array($extension, $permitidos)) {
			
			//die ($componentes[count($componentes) - 1]);
		
			if (move_uploaded_file($temporal, $destino)) {
				
				$core["imagenes"]->setImagen($imagen);
				$core["imagenes"]->setTitulo($titulo);
				$core["imagenes"]->setDescripcion($descripcion);
				$core["imagenes"]->setLiga($liga);
				$core["imagenes"]->setArchivo($nuevo);
				
				if ($core["imagenes"]->Agregar()) {
					
					$core["sesion"]->setMensaje("Se adjuntó exitosamente la imagen indicada.");
					
					$core["sesion"]->setVariable("campo_titulo", "");
					$core["sesion"]->setVariable("campo_descripcion", "");
					$core["sesion"]->setVariable("campo_liga", "");
					
					$core["sesion"]->setVariable("imagen_seleccionada", $imagen);
					
					$pagina = "../detalles/";
					
				} else {
					$core["sesion"]->setMensaje("Ocurrió un error al intentar agregar la imagen en la base de datos, favor de contactar al administrador.");
				}
				
			} else {
				$core["sesion"]->setMensaje("Ocurrió un error al intentar almacenar la imagen en el repositorio, favor de contactar al administrador.");
			}
			
		} else {
			$core["sesion"]->setMensaje("La extensión " . $extension . " no está soportada como imagen.");
		}
		
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para adjuntar una imagen al Catálogo de Imágenes para Banner.");
	}
	
	header("Location: " . $pagina);
	exit;
	
?>