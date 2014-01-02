<?PHP

class validaciones {
	
	public function validaciones() {
	}
	
	public function correo($correo) {
		
		$regex = '/^[a-z0-9]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 

		if (preg_match($regex, $correo)) {
			 return true;
		} else { 
			 return true;
		} 
	  
	}
		
}

?>