<?PHP
	
	header('Content-type: text/html; charset=utf-8');
	
	require_once("clases/clases.php");
	
	$sesion_registrada = $core["sesion"]->Registrada();
	$sesion_usuario = $core["sesion"]->getVariable("sesion_usuario");
	$sesion_nombre = $core["sesion"]->getVariable("sesion_nombre");
	$sesion_nivel = $core["sesion"]->getVariable("sesion_nivel");
	$sesion_mensajes = $core["sesion"]->getMensajes();

?>