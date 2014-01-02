<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "../";
	
	$bateria_seleccionada = $core["sesion"]->getVariable("bateria_seleccionada");
	
	if ($bateria_seleccionada != "") {
			
		if ($core["baterias"]->Elegible($sesion_usuario, $bateria_seleccionada)) {
			
			$core["baterias"]->setBateria($bateria_seleccionada);
			$core["baterias"]->Cargar();
		
			$listado_areas = $core["areas"]->ListadoActivas($sesion_usuario);
			
			/* Evaluaciones Asignadas */
			$listado_asignadas = $core["baterias"]->ListadoEvaluacionesAsignadas();
			$listado_disponibles = $core["baterias"]->ListadoEvaluacionesDisponibles();
			
			/* Cargar Notas */
			$core["notas"]->setTabla("baterias");
			$core["notas"]->setValor1($bateria_seleccionada);
			$listado_notas = $core["notas"]->Listado();
			
		} else {
			$core["sesion"]->setMensaje("La Batería de Evaluaciones indicada no es elegible por el usuario firmado al sistema.");
			header("location: " . $pagina);
			exit;
		}
			
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para ver el detalle de una Batería de Evaluaciones.");
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
<script>
	
	$(function() {
		$("#datepicker_inicio").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true
		}).val();
    });
	
	$(function() {
		$("#datepicker_fin").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true
		}).val();
    });
	
</script>
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
                            	<a href="../../evaluaciones/agregar/">Crear Evaluación Técnica</a>
                            	<a href="../agregar/">Crear Batería de Evaluaciones</a>
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
                            	<a href="../../evaluaciones/agregar/">Crear Evaluación Técnica</a>
                            	<a href="../agregar/">Crear Batería de Evaluaciones</a>
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
                  <h1>Detalles de Batería de Evaluaciones <strong><?PHP echo strtoupper($bateria_seleccionada); ?></strong></h1>
                  <form name="frmDetalles" method="post" action="actualizar.php">
                    <table class="detalles">
                        <tbody>
                        	<tr>
                                <td class="obligatorio">* ID Batería</td>
                                <td class="campo"><input type="text" name="bateria" value="<?PHP echo $core["baterias"]->getBateria(); ?>" size="50" maxlength="100" readonly="readonly" class="llave" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Título</td>
                                <td class="campo"><input type="text" name="titulo" value="<?PHP echo $core["baterias"]->getTitulo(); ?>" size="50" maxlength="100" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Descripción</td>
                                <td class="campo"><textarea name="descripcion" cols="50" rows="5"><?PHP echo $core["baterias"]->getDescripcion(); ?></textarea></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Área</td>
                                <td class="campo">
                                    <select name="area">
                                    	<option value="">Elija una área de la organización</option>
                                        <?PHP foreach ($listado_areas as $indice => $elemento) { ?>
                                        	<?PHP if ($core["baterias"]->getArea() == $elemento["area"]) { ?>
                                            	<option value="<?PHP echo $elemento["area"]; ?>" selected="selected">
                                            <?PHP } else { ?>
                                            	<option value="<?PHP echo $elemento["area"]; ?>">
                                            <?PHP } ?>
											<?PHP echo strtoupper($elemento["area"]) . " - " . $elemento["descripcion"]; ?>
                                            </option>
                                        <?PHP } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Batería Activa</td>
                                <td class="campo">
                                    <?PHP if ($core["baterias"]->getActivo() == "X") { ?>
                                        <input type="checkbox" name="activo" value="X" checked="checked" />
                                    <?PHP } else { ?>
                                        <input type="checkbox" name="activo" value="X" />
                                    <?PHP } ?>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="btnActualizar" value="Actualizar" />
                                    <input type="button" name="btnVolver" value="Volver" onclick=Volver(this.form); />
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
                <br />
                <a name="Evaluaciones" id="Evaluaciones"></a>
				<h1>Evaluaciones Asignadas</h1>
                <form name="frmEvaluaciones" method="post" action="asignar.php">
                <table class="reportes">
                	<thead>
                    	<tr>
                        	<td>#</td>
                            <td>Evaluación Técnica</td>
                            <td>Secuencia</td>
                            <td>&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                    	<?PHP foreach ($listado_asignadas as $indice => $elemento) { ?>
                    	<tr>
                        	<td><?PHP echo $indice + 1; ?></td>
                            <td><?PHP echo strtoupper($elemento["evaluacion"]) . " - " . $elemento["titulo"]; ?></td>
                            <td><?PHP echo $elemento["secuencia"]; ?></td>
                            <td><a href="desasignar.php?evaluacion=<?PHP echo $elemento["evaluacion"]; ?>"><img src="../../../../imgs/utilerias/basurero.png" alt="Desasignar" title="Desasignar" /></a></td>
                        </tr>
                        <?PHP } ?>
                    </tbody>
                    <tfoot>
                    	<tr>
                        	<td colspan="3">
                                <input type="hidden" name="bateria" value="<?PHP echo $bateria_seleccionada; ?>" />
                            	<select name="evaluacion">
                                    <option value="">Elija una Evaluación Técnica</option>
                                    <?PHP foreach ($listado_disponibles as $indice => $elemento) { ?>
                                        <option value="<?PHP echo $elemento["evaluacion"]; ?>"><?PHP echo strtoupper($elemento["evaluacion"]) . " - " . $elemento["titulo"]; ?></option>
                                    <?PHP } ?>
                                </select>
                                <input type="submit" name="btnAsignar" value="Asignar" />
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </form>
                <br />
                <a name="Notas" id="Notas"></a>
                <h1>Notas Relacionadas</h1>
                <form name="frmNotas" method="post" action="anotar.php">
                <table class="reportes">
                	<thead>
                    	<tr>
                        	<td>#</td>
                            <td>Instante</td>
                            <td>Nota</td>
                        </tr>
                    </thead>
                    <tbody>
                    	<?PHP foreach ($listado_notas as $indice => $elemento) { ?>
                    	<tr>
                        	<td><?PHP echo $indice + 1; ?></td>
                            <td><?PHP echo $elemento["instante"]; ?></td>
                            <td><?PHP echo $elemento["nota"]; ?></td>
                        </tr>
                        <?PHP } ?>
                    </tbody>
                    <tfoot>
                    	<tr>
                        	<td colspan="3">
                                <input type="hidden" name="bateria" value="<?PHP echo $bateria_seleccionada; ?>" />
                            	<textarea name="nota" cols="60" rows="5"></textarea>
                                <input type="submit" name="btnAnotar" value="Anotar" />
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
                    	<li>Indique el título y descripción de la Batería de Evaluaciones.</li>
                        <li>Elija el área de la organización donde se asignará la Batería de Evaluaciones.</li>
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
