<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "./";
	
	$evaluacion = (isset($_GET["evaluacion"]) && $_GET["evaluacion"] != "") ? $_GET["evaluacion"] : "";
	$pregunta = (isset($_GET["pregunta"]) && $_GET["pregunta"] != "") ? $_GET["pregunta"] : "";
	
	if ($evaluacion != "" && $pregunta != "") {
			
		if ($core["evaluaciones"]->Existe($evaluacion)) {
			
			if ($core["preguntas"]->Existe($evaluacion, $pregunta)) {
			
				$core["evaluaciones"]->setEvaluacion($evaluacion);
				$core["evaluaciones"]->Cargar();	
				
				$core["preguntas"]->setEvaluacion($evaluacion);
				$core["preguntas"]->setPregunta($pregunta);
				$core["preguntas"]->Cargar();
				
			} else {
				$core["sesion"]->setMensaje("La Pregunta de la Evaluación Técnica indicada no existe.");
				header("location: " . $pagina);
				exit;
			}
			
		} else {
			$core["sesion"]->setMensaje("La Evaluación Técnica indicada no existe.");
			header("location: " . $pagina);
			exit;
		}
			
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para agregar una respuesta a la pregunta indicada.");
		header("location: " . $pagina);
		exit;
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Privadas.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>OMA Reclutamiento</title>
<!-- InstanceEndEditable -->

<link rel="shortcut icon" href="../../../../imgs/icono/favicon.ico" />
<link rel="stylesheet" href="../../../../css/main.css" type="text/css">
<link rel="stylesheet" href="../../../../css/flexslider.css" type="text/css">
<link rel="stylesheet" href="../../../../css/reveal.css" type="text/css">
<link rel="stylesheet" href="../../../../css/default.css" type="text/css">

<script src="../../../../js/jquery-1.7.2.min.js"></script>
<script src="../../../../js/jquery-ui-1.8.22.custom.min.js"></script>
<script src="../../../../js/hoverintent.js" type="text/javascript"></script>
<script src="../../../../js/easing.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../../js/cycle.min.js"></script>
<script src="../../../../js/nav.js" type="text/javascript"></script>
<script src="../../../../js/jquery.reveal.js"></script>
<script src="../../../../js/jquery.flexslider-min.js"></script>
<script type="text/javascript" charset="utf-8">
  $(window).load(function() {
    $('.flexslider').flexslider();
  });
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('.vhs').click(function() { 
		$('#cargaVideo').html('<iframe frameborder="0" allowtransparency="true" style="filter:chromacolor=#F5FAFD" scrolling="no" width="600" height="400" src="http://www.youtube.com/embed/8Y6Xza55pAo"></iframe>');
	});
	
	$('.close-reveal-modal').click(function() {
		$('#cargaVideo').html('');
	});
});
</script>
<script language="javascript" src="../../../../js/md5.js"></script>
<script language="javascript" src="../../../../js/funciones.js"></script>
<script language="javascript" src="cadenero.js"></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body <?PHP if ($sesion_registrada) { ?> style="background:url(../../../../imgs/logotipo/yosoyoma.png) no-repeat top right fixed" <?PHP } ?>>

<a name="Inicio" id="Inicio"></a>
<div class="header-wrap">
	
    <!-- INICIO CABECERA -->
    <div class="header">
		<a href="../../../../index.php"><img src="../../../../imgs/logotipo/logotipo.png"/></a>
		<div class="wel-nav">
			<div class="welcome">
            	
                <?PHP if ($sesion_registrada) { ?>
					<span>Bienvenido</span> <?PHP echo $sesion_usuario; ?>
                <?PHP } else { ?>
                	&nbsp;
                <?PHP } ?>
                
				<div class="fecha">
					<script languaje="JavaScript">
						var mydate=new Date()
						var year=mydate.getYear()
						if (year < 1000)
						year+=1900
						var day=mydate.getDay()
						var month=mydate.getMonth()
						var daym=mydate.getDate()
						if (daym<10)
						daym="0"+daym
						var dayarray=new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado")
						var montharray=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")
						document.write(dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year)
					</script>
				</div>
			</div>
            
            <?PHP if ($sesion_registrada) { ?>
            
            	<?PHP if($sesion_nivel == 0) { ?>
            
                    <!-- nav -->
                    <div class="nav">
                        
                        <div class="inicioHover">
                            <a href="../../../../index.php" class="btnInicio">Inicio</a>
                            <div class="inicioSubmenu navSub">
                                <a href="../../../autoservicio/generales/">Mis Datos Generales</a>
                                <a href="../../../autoservicio/candidato/">Mis Datos de Candidato</a>
                                <a href="../../../autoservicio/cambio/">Cambio de Contraseña</a>
                                <a href="../../../autoservicio/accesos/">Mis Accesos al Sistema</a>
                                <a href="../../../../logout.php">Cerrar Sesión</a>
                            </div>
                        </div>
                        
                        <div class="formatosHover">
                            <a href="#" class="btnFormatos">&nbsp;&nbsp;&nbsp;&nbsp;Admin&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <div class="formatosSubmenu navSub subnormal">
                            	<a href="../../../administracion/parametros/">Parámetros del Sistema</a>
                                <a href="../../../administracion/areas/">Áreas de la Organización</a>
                                <a href="../../../administracion/usuarios/">Control de Usuarios</a>
                                <a href="../../../administracion/accesos/">Registro de Accesos</a>
                                <a href="../../../administracion/imagenes/">Imágenes de Banner</a>
                                <a href="../../../administracion/informatica/">Conocimientos Informática</a>
                                <a href="../../../administracion/industrias/">Catálogo Industrias</a>
                                <a href="../../../administracion/errores/">Monitor Errores SQL</a>
                            </div>
                        </div>
                        
                        <div class="centroHover">
                            <a href="#" class="btnCentro">&nbsp;&nbsp;&nbsp;&nbsp;Bolsa de Trabajo&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <div class="centroSubmenu navSub subnormal">
                                <a href="../../../bolsa/vacantes/agregar/">Creación de Vacante</a>
                                <a href="../../../bolsa/vacantes/">Administración de Vacantes</a>
                                <a href="../../../bolsa/candidatos/">Control de Candidatos</a>
                            </div>
                        </div>
                        
                        <div class="sitiosHover">
                            <a href="#" class="btnSitios">&nbsp;&nbsp;Evaluaciones&nbsp;&nbsp;</a>
                            <div class="sitiosSubmenu navSub subnormal">
                            	<a href="../agregar/">Crear Evaluación Técnica</a>
                            	<a href="../../baterias/agregar/">Crear Batería de Evaluaciones</a>
                                <a href="../../evaluaciones/">Administrar Evaluaciones</a>
                                <a href="../../baterias/">Administrar Baterías de Evaluaciones</a>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                    <!-- nav -->
                    
				<?PHP } elseif($sesion_nivel == 1 || $sesion_nivel == 2) { ?>
            
                    <!-- nav -->
                    <div class="nav">
                        
                        <div class="inicioHover">
                            <a href="../../../../index.php" class="btnInicio">Inicio</a>
                            <div class="inicioSubmenu navSub">
                                <a href="../../../autoservicio/generales/">Mis Datos Generales</a>
                                <a href="../../../autoservicio/candidato/">Mis Datos de Candidato</a>
                                <a href="../../../autoservicio/cambio/">Cambio de Contraseña</a>
                                <a href="../../../autoservicio/accesos/">Mis Accesos al Sistema</a>
                                <a href="../../../../logout.php">Cerrar Sesión</a>
                            </div>
                        </div>
                        
                        <div class="centroHover">
                            <a href="#" class="btnCentro">&nbsp;&nbsp;&nbsp;&nbsp;Bolsa de Trabajo&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <div class="centroSubmenu navSub subnormal">
                                <a href="../../../bolsa/vacantes/agregar/">Creación de Vacante</a>
                                <a href="../../../bolsa/vacantes/">Administración de Vacantes</a>
                                <a href="../../../bolsa/candidatos/">Control de Candidatos</a>
                            </div>
                        </div>
                        
                        <div class="sitiosHover">
                            <a href="#" class="btnSitios">&nbsp;&nbsp;Evaluaciones&nbsp;&nbsp;</a>
                            <div class="sitiosSubmenu navSub subnormal">
                            	<a href="../agregar/">Crear Evaluación Técnica</a>
                            	<a href="../../baterias/agregar/">Crear Batería de Evaluaciones</a>
                                <a href="../../evaluaciones/">Administrar Evaluaciones</a>
                                <a href="../../baterias/">Administrar Baterías de Evaluaciones</a>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                    <!-- nav -->
                    
				<?PHP } elseif($sesion_nivel == 3) { ?>
            
                    <!-- nav -->
                    <div class="nav">
                        
                        <div class="inicioHover">
                            <a href="../../../../index.php" class="btnInicio">Inicio</a>
                            <div class="inicioSubmenu navSub">
                                <a href="../../../autoservicio/generales/">Mis Datos Generales</a>
                                <a href="../../../autoservicio/candidato/">Mis Datos de Candidato</a>
                                <a href="../../../autoservicio/accesos/">Mis Accesos al Sistema</a>
                                <a href="../../../../logout.php">Cerrar Sesión</a>
                            </div>
                        </div>
                        
                        <div class="sitiosHover">
                            <a href="../../../candidatos/vacantes/" class="btnSitios">&nbsp;&nbsp;&nbsp;&nbsp;Vacantes&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                    <!-- nav -->
                    
				<?PHP } ?>
            
            <?PHP } else { ?>
            
            	<div class="nav">
                
                	<div class="centroHover">
                        <a href="../../../../registro/" class="btnCentro">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registrarme&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    </div>
                    
                    <div class="sitiosHover">
                        <a href="../../../../recuperar/" class="btnSitios">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recuperar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    </div>
                
                </div>
            
            <?PHP } ?>
            
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="wrap">
	<div class="homeCont">
    	
        <?PHP if (count($sesion_mensajes) > 0) { ?>
            <div class="mensajes">
                <?PHP foreach ($sesion_mensajes as $indice => $mensaje) { ?>
                    <div class="mensaje">
                        <?PHP echo $mensaje["instante"] . " :: " . $mensaje["mensaje"]; ?>
                    </div>
                <?PHP } ?>
            </div>
        <?PHP } ?>
        
    	<?PHP if ($sesion_registrada) { ?>
			
            <div class="izquierda">                
                <div class="contenido">
                  <!-- InstanceBeginEditable name="Contenido" -->
                <h1>Agregar Pregunta a la Evaluación <strong><?PHP echo strtoupper($evaluacion); ?></strong></h1>
                <form name="frmAgregar" method="post" action="respuesta_insertar.php">
				<table class="detalles">
                    <tbody>
                        <tr>
                            <td class="obligatorio">* ID Evaluación</td>
                            <td class="campo"><input type="text" name="evaluacion" value="<?PHP echo $core["evaluaciones"]->getEvaluacion(); ?>" size="50" maxlength="100" readonly="readonly" class="llave" /></td>
                        </tr>
                        <tr>
                            <td class="obligatorio">* Título Evaluación</td>
                            <td class="campo"><input type="text" name="titulo_evaluacion" value="<?PHP echo $core["evaluaciones"]->getTitulo(); ?>" size="50" maxlength="100" readonly="readonly" class="llave" /></td>
                        </tr>
                        <tr>
                            <td class="obligatorio">* ID Pregunta</td>
                            <td class="campo"><input type="text" name="pregunta" value="<?PHP echo $core["preguntas"]->getPregunta(); ?>" size="50" maxlength="100" readonly="readonly" class="llave" /></td>
                        </tr>
                        <tr>
                            <td class="obligatorio">* Texto Pregunta</td>
                            <td class="campo"><input type="text" name="texto_pregunta" value="<?PHP echo $core["preguntas"]->getTexto(); ?>" size="50" maxlength="100" readonly="readonly" class="llave" /></td>
                        </tr>
                        <tr>
                            <td class="obligatorio">* Texto de la Respuesta</td>
                            <td class="campo"><textarea name="texto" cols="60" rows="8"></textarea></td>
                        </tr>
                        <tr>
                            <td class="obligatorio">* Valor de la Respuesta</td>
                            <td class="campo">
                            	<select name="valor">
                                	<?PHP
										for ($x=0; $x<=100; $x++) {
									?>
                                    	<option value="<?PHP echo $x; ?>"><?PHP echo $x; ?></option>
                                    <?PHP
										}
									?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                    	<tr>
                        	<td colspan="2">
                            	<input type="submit" name="btnAgregar" value="Agregar" />
                                <input type="button" name="btnCancelar" value="Cancelar" onclick=Cancelar(this.form); />
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </form>
				  <!-- InstanceEndEditable -->
                </div>
            </div>
            <div class="derecha">
            	<div class="opciones">
                    <!-- InstanceBeginEditable name="Opciones" -->
                    <h1>Instrucciones</h1>
                    <ol>
                        <li>Introduzca el título y la descripción de la Evaluación Técnica.</li>
                        <li>haga click en el botón <strong>ACTUALIZAR</strong> para almacenar los cambios o en <strong>VOLVER</strong>, para regresar al listado general.</li>
                    </ol>
					<!-- InstanceEndEditable -->
                </div>
            </div>
            <div class="clear"></div>
        
        <?PHP } else { ?>
        
        	<!-- FORMULARIO DE LOGIN -->
            	<div align="center">
                    <div class="login">
                        <h1>Ingreso de Usuarios</h1>
                        <form name="frmLogin" method="post" action="../../../../login.php">
                            <fieldset class="campos">
                                <label>Correo Electrónico</label>
                                <input type="text" name="usuario" size="36" maxlength="50" />
                                <label>Contraseña</label>
                                <input type="password" name="clave" size="36" maxlength="50" />
                            </fieldset>
                            <fieldset class="botones">
                                <input type="submit" name="btnIngresar" value="Ingresar" />
                            </fieldset>
                        </form>
                    </div>
				</div>
        
        <?PHP } ?>
	</div> 
	<div class="clear"></div>

</div>

<div class="footer-wrap">
	<div class="footer">
    	<div class="izquierda">
        	<div class="logotipos">
            	<img src="../../../../imgs/logotipos/gptw.png" alt="Greate Place To Work" />
				<img src="../../../../imgs/logotipos/ambiental.png" alt="Calidad Ambiental" />
                <img src="../../../../imgs/logotipos/bolsa.png" alt="Bolsa Mexicana de Valores" />
                <img src="../../../../imgs/logotipos/ica.png" alt="ICA" />
                <img src="../../../../imgs/logotipos/iso.png" alt="ISO" />
                <img src="../../../../imgs/logotipos/lrqa.png" alt="LRQA" />
                <img src="../../../../imgs/logotipos/ohsas.png" alt="OHSAS" />
                <img src="../../../../imgs/logotipos/sustentable.png" alt="Empresa Sustentable" />
                <img src="../../../../imgs/logotipos/nasdaq.png" alt="Nasdaq" />
                <img src="../../../../imgs/logotipos/esr.png" alt="Empresa Socialmente Responsable" />
                <img src="../../../../imgs/logotipos/paris.png" alt="Paris" />
            </div>
        </div>
        <div class="derecha">
        	<?PHP echo $core["parametros"]->getMensaje(); ?>
        </div>
        <div class="reset"></div>
    </div>
</div>

<div id="video" class="reveal-modal large">
	<div id="cargaVideo"></div>
	<a class="close-reveal-modal">&#215;</a>
</div>

    <script language="javascript">
		CursorInicial();
	</script>

</body>
<!-- InstanceEnd --></html>
