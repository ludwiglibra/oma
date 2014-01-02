<?PHP

	require_once("clases/clases.php");
	
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: ; filename=\"" . $core["sesion"]->getVariable("sesion_reporte") . ".csv\"");
	
	$tabla = $core["sesion"]->getVariable("sesion_datos");
	
	foreach($tabla as $indice1 => $elemento) {
		
		$cabecera = array_keys($elemento);
		
		//$campo = utf8_decode($campo);
		
		$cadena = "";
		
		for ($x=0;$x<count($cabecera);$x++) {
			
			if ($cadena == "") {
				$cadena = "\"" . strtoupper($cabecera[$x]) . "\"";
			} else {
				$cadena = $cadena . ",\"" . strtoupper($cabecera[$x]) . "\"";
			}
			
		}
		
		print $cadena . "\n";
		
		break;
	
	}
	
	foreach ($tabla as $indice1 => $registro) {
		
		$cadena = "";
		
		foreach($registro as $indice2 => $campo) {
			
			//$campo = utf8_decode($campo);
			
			if ($cadena == "") {
				$cadena = "\"" . $campo . "\"";
			} else {
				$cadena = $cadena . ",\"" . $campo . "\"";
			}
		
		}
		
		print $cadena . "\n";
		
	}

?>