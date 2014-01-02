<?PHP

class funciones {
	
	/*
	** Propiedades
	*/
	
	private $modificador;
	
	/*
	** Constructor
	*/
	
	public function funciones() {
		
		$this->AjustaModificador();
				
	}
	
	/*
	** Método AjustaModificador
	*/
	
	private function AjustaModificador() {
		
		setlocale(LC_TIME, 'es_MX');
		
		/* Obtener fecha actual */
		
		$ahora = date("Y-m-d");
		
		/* Calcular Primer Domingo de Abril (Horario de Verano) */
		
		$buscando = true;
		
		$ano = date("Y");
		$mes = "04";
		$dia = "01";
		
		while ($buscando) {
			
			$dia_semana = date("w",mktime(0, 0, 0, $mes, $dia, $ano));
			
			if ($dia_semana == 0) {
				$verano = date("Y-m-d",mktime(0, 0, 0, $mes, $dia, $ano));
				$buscando = false;
			} else {
				$dia += 1;
			}
			
		}
		
		/* Calcular Ultimo Domingo de Octubre (Horario de Invierno) */
		
		$buscando = true;
		
		$ano = date("Y");
		$mes = "10";
		$dia = "01";
		
		while ($buscando) {
			
			$dia_semana = date("w",mktime(0, 0, 0, $mes, $dia, $ano));
			
			if ($dia_semana == 0) {
				$invierno = date("Y-m-d",mktime(0, 0, 0, $mes, $dia, $ano));
				$buscando = false;
			} else {
				$dia += 1;
			}
			
		}
		
		/* Calcular Modificador de Horario de Acuerdo a la Fecha */
		
		if ($ahora < $verano) {
			$this->modificador = 6;
		} elseif ($ahora >= $verano && $ahora < $invierno) {
			$this->modificador = 5;
		} elseif ($ahora >= $invierno) {
			$this->modificador = 6;
		}
		
	}
	
	/************************************************** Método getFecha */
	
	public function getFecha() {
		$fecha = "";
		setlocale(LC_TIME, 'es_MX');
		//$fecha = date("Y-m-d", mktime(gmstrftime("%H")-6, gmstrftime("%M"), gmstrftime("%S"), gmstrftime("%m"), gmstrftime("%d"), gmstrftime("%Y")));
		$fecha = date("Y-m-d", mktime(gmstrftime("%H")-$this->modificador, gmstrftime("%M"), gmstrftime("%S"), gmstrftime("%m"), gmstrftime("%d"), gmstrftime("%Y")));
		return $fecha;
	}
	
	/************************************************** Método getHora */
	
	public function getHora() {
		$hora = "";
		setlocale(LC_TIME, 'es_MX');
		//$hora = date("H:i:s", mktime(gmstrftime("%H")-6, gmstrftime("%M"), gmstrftime("%S"), gmstrftime("%m"), gmstrftime("%d"), gmstrftime("%Y")));
		$hora = date("H:i:s", mktime(gmstrftime("%H")-$this->modificador, gmstrftime("%M"), gmstrftime("%S"), gmstrftime("%m"), gmstrftime("%d"), gmstrftime("%Y")));
		return $hora;
	}
	
	/************************************************** Método getFechaHora */
	
	public function getFechaHora() {
		
		$salida = $this->getFecha() . " " . $this->getHora();
		return $salida;
		
	}
	
	/************************************************** Método getUtf8 */
	
	public function getUtf8($cadena) {
		return utf8_encode(nl2br($cadena));
	}
	
	/************************************************** Método setUtf8 */
	
	public function setUtf8($cadena) {
		return utf8_encode(nl2br($cadena));
	}
	
	/************************************************** Método Aleatorio */
	
	public function Aleatorio($longitud) {

		$salida = rand(1, 10 * $longitud - 1);
		return $salida;
		
	}
	
	/************************************************** Método ObtenerID */
	
	public function NuevoID() {
		
		$id = Date("Y", strtotime($this->getFecha())) . Date("m", strtotime($this->getFecha())) . Date("d", strtotime($this->getFecha()));
		$id.= Date("H", strtotime($this->getHora())) . Date("i", strtotime($this->getHora())) . Date("s", strtotime($this->getHora()));
		$id.= $this->Aleatorio(1) . $this->Aleatorio(1) . $this->Aleatorio(1);
		$id.= $this->Aleatorio(1) . $this->Aleatorio(1) . $this->Aleatorio(1);
		
		return $id;
		
	}
	
	/*
	**** Método LimpiarSQL
	*/
	
	public function LimpiarSQL($cadena) {
		
		$prohibidos = array("'","\"","/","<",">",";");    
        return str_replace($prohibidos,"",$cadena);
		
	}
	
	/*
	** Calcula Edad
	*/
	
	public function Edad($fechanacimiento){
		list($ano,$mes,$dia) = explode("-",$fechanacimiento);
		$ano_diferencia  = date("Y") - $ano;
		$mes_diferencia = date("m") - $mes;
		$dia_diferencia   = date("d") - $dia;
		if ($dia_diferencia < 0 || $mes_diferencia < 0)
			$ano_diferencia--;
		return $ano_diferencia;
	}
	
	/*
	** Ordenar
	*/
	
	public function Ordenar($records, $field, $reverse=false) {
		
		$hash = array();
		
		foreach($records as $record)
		{
			$hash[$record[$field]] = $record;
		}
		
		($reverse)? krsort($hash) : ksort($hash);
		
		$records = array();
		
		foreach($hash as $record)
		{
			$records []= $record;
		}
		
		return $records;
		
	}
	
}

?>