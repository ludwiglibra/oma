<?PHP
	
	require_once("phpmailer/class.phpmailer.php");
	
	require_once("sesion.php");
	require_once("accesos.php");
	require_once("funciones.php");
	require_once("validaciones.php");
	require_once("correo.php");
	require_once("conexion.php");
	require_once("accesos.php");
	require_once("parametros.php");
	require_once("listados.php");
	require_once("modulos.php");
	
	/* Usuarios */
	require_once("usuarios.php");
	require_once("generales.php");
	
	/* Candidatos */
	require_once("candidatos.php");
	require_once("estudios.php");
	require_once("idiomas.php");
	require_once("areas.php");
	require_once("informatica.php");
	require_once("experiencias.php");
	require_once("salarial.php");
	
	/* Imágenes, Archivos y Notas */
	require_once("imagenes.php");
	require_once("archivos.php");
	require_once("notas.php");
	
	/* Transaccionales */
	require_once("vacantes.php");
	require_once("evaluaciones.php");
	require_once("preguntas.php");
	require_once("respuestas.php");
	require_once("baterias.php");
	
	
	$core = array();
	
	$core["sesion"] = new sesion();
	$core["sesion"]->Iniciar();
	
	$core["funciones"] = new funciones();
	$core["validaciones"] = new validaciones();
	$core["correo"] = new correo();
	$core["conexion"] = new conexion();
	$core["accesos"] = new accesos();
	$core["parametros"] = new parametros();
	$core["listados"] = new listados();
	$core["modulos"] = new modulos();
	$core["usuarios"] = new usuarios();
	$core["generales"] = new generales();
	$core["candidatos"] = new candidatos();
	$core["estudios"] = new estudios();
	$core["idiomas"] = new idiomas();
	$core["areas"] = new areas();
	$core["informatica"] = new informatica();
	$core["experiencias"] = new experiencias();
	$core["salarial"] = new salarial();
	
	$core["imagenes"] = new imagenes();
	$core["archivos"] = new archivos();
	$core["notas"] = new notas();
	$core["vacantes"] = new vacantes();
	$core["evaluaciones"] = new evaluaciones();
	$core["preguntas"] = new preguntas();
	$core["respuestas"] = new respuestas();
	$core["baterias"] = new baterias();
	

?>