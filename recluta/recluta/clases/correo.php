<?PHP

class correo {
	
	/************************************************** Propiedades */
	
	private $funciones;
	private $parametros;
	
	private $usuario = "binninetcorp@gmail.com";
	private $password = "binni2013";
	private $de = "binnicorp@gmail.com";
	private $nombre = "OMA Reclutamiento";
	private $para;
	private $asunto;
	private $mensaje;
	
	private $error;
	
	/************************************************** Constructor */
	
	public function correo() {
		
		$this->funciones = new funciones();
		$this->parametros = new parametros();
		
	}
	
	/*
	** Métodos SET 
	*/
	
	public function setPara($para) {
		$this->para = $para;
	}
	
	public function setAsunto($asunto) {
		$this->asunto = $asunto;
	}
	
	public function setMensaje($mensaje) {
		$this->mensaje = $mensaje;
	}
	
	/*
	** Métodos GET
	*/
	
	public function getError() {
		return $this->error;
	}
	
	/*
	** Método Enviar
	*/
	
	public function Enviar() {
		
		$resultado = false;
		
		/*
		$mail = new PHPMailer(true);
		
		$mail->IsSMTP();
		
		try {
		
			//$mail->SMTPDebug  = 2;                   // enables SMTP debug information (for testing)
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			$mail->Username   = $this->usuario;  		 // GMAIL username
			$mail->Password   = $this->password;       // GMAIL password
			$mail->SetFrom($this->de, $this->nombre);
			$mail->AddReplyTo($this->de, $this->nombre);
			$mail->AddAddress($this->para, "Usuario del Sistema");
			$mail->Subject = $this->asunto;
			$mail->Body = $this->mensaje;
			$mail->AltBody = $this->mensaje; // optional - MsgHTML will create an alternate automatically
			//$mail->MsgHTML(file_get_contents('contents.html'));
			//$mail->AddAttachment('phpmailer/images/phpmailer.gif');      // attachment
			//$mail->AddAttachment('phpmailer/images/phpmailer_mini.gif'); // attachment
			$mail->Send();
			
			$resultado = true;
		
		} catch (phpmailerException $e) {
			//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			$this->error = $e;
		} catch (Exception $e) {
			//echo $e->getMessage(); //Boring error messages from anything else!
			$this->error = $e;
		}
		*/
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: OMA Bolsa de Trabajo <' . $this->parametros->getContacto() . '>' . "\r\n";
		
		if (mail($this->para, $this->asunto, $this->mensaje, $headers)) {
			$resultado = true;
		}
		
		return $resultado;
		
	}

}

?>