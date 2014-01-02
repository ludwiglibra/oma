<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$pagina = "../";
	
	$vacante = (isset($_GET["vacante"]) && $_GET["vacante"] != "") ? $_GET["vacante"] : "";
	$vacante_seleccionada = $vacante;
	
	if ($vacante != "") {
		$pagina = "../../../candidatos/vacantes/detalles/?vacante=" . $vacante;
		header("Location: " . $pagina);
		exit;
	}
	
	$vacante = $core["sesion"]->getVariable("vacante_seleccionada");
	
	if ($vacante != "") {
			
		if ($core["vacantes"]->Elegible($sesion_usuario, $vacante)) {
			
			$core["vacantes"]->setVacante($vacante);
			$core["vacantes"]->Cargar();
		
			$listado_areas = $core["areas"]->ListadoActivas($sesion_usuario);
			
			/* Listado Candidatos */
			$listado_candidatos = $core["vacantes"]->ListadoCandidatos(); 
			
			/* Listado Baterías del Area */
			$listado_asignadas = $core["vacantes"]->ListadoBateriasAsignadas();
			$listado_disponibles = $core["vacantes"]->ListadoBateriasDisponibles();
			
			/* Cargar Adjuntos */
			$core["archivos"]->setTabla("vacantes");
			$core["archivos"]->setValor1($vacante);
			$listado_archivos = $core["archivos"]->Listado();
			
			/* Cargar Notas */
			$core["notas"]->setTabla("vacantes");
			$core["notas"]->setValor1($vacante);
			$listado_notas = $core["notas"]->Listado();
			
		} else {
			$core["sesion"]->setMensaje("La vacante indicada no es elegible por el usuario firmado al sistema.");
			header("location: " . $pagina);
			exit;
		}
			
	} else {
		$core["sesion"]->setMensaje("No existen las condiciones mínimas para ver el detalle de una vacante.");
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
                                <a href="../agregar/">Creación de Vacante</a>
                                <a href="../../vacantes/">Administración de Vacantes</a>
                                <a href="../../candidatos/">Control de Candidatos</a>
                            </div>
                        </div>
                        
                        <div class="sitiosHover">
                            <a href="#" class="btnSitios">&nbsp;&nbsp;Evaluaciones&nbsp;&nbsp;</a>
                            <div class="sitiosSubmenu navSub subnormal">
                            	<a href="../../../evaluaciones/evaluaciones/agregar/">Crear Evaluación Técnica</a>
                            	<a href="../../../evaluaciones/baterias/agregar/">Crear Batería de Evaluaciones</a>
                                <a href="../../../evaluaciones/evaluaciones/">Administrar Evaluaciones</a>
                                <a href="../../../evaluaciones/baterias/">Administrar Baterías de Evaluaciones</a>
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
                                <a href="../agregar/">Creación de Vacante</a>
                                <a href="../../vacantes/">Administración de Vacantes</a>
                                <a href="../../candidatos/">Control de Candidatos</a>
                            </div>
                        </div>
                        
                        <div class="sitiosHover">
                            <a href="#" class="btnSitios">&nbsp;&nbsp;Evaluaciones&nbsp;&nbsp;</a>
                            <div class="sitiosSubmenu navSub subnormal">
                            	<a href="../../../evaluaciones/evaluaciones/agregar/">Crear Evaluación Técnica</a>
                            	<a href="../../../evaluaciones/baterias/agregar/">Crear Batería de Evaluaciones</a>
                                <a href="../../../evaluaciones/evaluaciones/">Administrar Evaluaciones</a>
                                <a href="../../../evaluaciones/baterias/">Administrar Baterías de Evaluaciones</a>
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
                  <h1>Detalles de Vacante <strong><?PHP echo strtoupper($vacante_seleccionada); ?></strong></h1>
                  <form name="frmUsuario" method="post" action="actualizar.php" enctype="multipart/form-data">
                    <table class="detalles">
                        <tbody>
                        	<tr>
                                <td class="obligatorio">* ID de Vacante</td>
                                <td class="campo"><input type="text" name="vacante" value="<?PHP echo $core["vacantes"]->getVacante(); ?>" size="50" maxlength="100" readonly="readonly" class="llave" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Tipo de Vacante</td>
                                <td class="campo">
                                    <select name="tipo">
                                    	<option value=""></option>
                                        <?PHP if ($core["vacantes"]->getTipo() == "I") { ?>
                                    		<option value="I" selected="selected">Interno</option>
                                        <?PHP } else { ?>
                                        	<option value="I">Interno</option>
                                        <?PHP } ?>
                                        <?PHP if ($core["vacantes"]->getTipo() == "E") { ?>
                                    		<option value="E" selected="selected">Externo</option>
                                        <?PHP } else { ?>
                                        	<option value="E">Externo</option>
                                        <?PHP } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Ubicación</td>
                                <td class="campo"><textarea name="ubicacion" cols="50" rows="5"><?PHP echo $core["vacantes"]->getUbicacion(); ?></textarea></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Área o Departamento</td>
                                <td class="campo">
                                    <select name="area">
                                        <?PHP foreach ($listado_areas as $indice => $elemento) { ?>
                                        	<?PHP if ($core["vacantes"]->getArea() == $elemento["area"]) { ?>
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
                                <td class="obligatorio">* Título del Puesto</td>
                                <td class="campo"><input type="text" name="titulo" value="<?PHP echo $core["vacantes"]->getTitulo(); ?>" size="50" maxlength="100" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Descripción General del Puesto</td>
                                <td class="campo"><textarea name="descripcion" cols="50" rows="5"><?PHP echo $core["vacantes"]->getDescripcion(); ?></textarea></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Descripción de Puesto Anexa</td>
                                <td class="campo"><a href="../anexos/<?PHP echo $core["vacantes"]->getAnexo(); ?>" target="_blank"><?PHP echo $core["vacantes"]->getAnexo(); ?></a><br /><input type="file" name="anexo" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Formación Académica</td>
                                <td class="campo"><textarea name="formacion" cols="50" rows="5"><?PHP echo $core["vacantes"]->getFormacion(); ?></textarea></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Conocimientos Requeridos</td>
                                <td class="campo"><textarea name="conocimientos" cols="50" rows="5"><?PHP echo $core["vacantes"]->getConocimientos(); ?></textarea></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Experiencia Profesional</td>
                                <td class="campo"><textarea name="experiencia" cols="50" rows="5"><?PHP echo $core["vacantes"]->getExperiencia(); ?></textarea></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Funciones del Puesto</td>
                                <td class="campo"><textarea name="funciones" cols="50" rows="5"><?PHP echo $core["vacantes"]->getFunciones(); ?></textarea></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Competencias y Habilidades Requeridas</td>
                                <td class="campo"><textarea name="competencias" cols="50" rows="5"><?PHP echo $core["vacantes"]->getCompetencias(); ?></textarea></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Tipo de Discapacidad Aceptable</td>
                                <td class="campo"><textarea name="discapacidades" cols="50" rows="5"><?PHP echo $core["vacantes"]->getDiscapacidades(); ?></textarea></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Inicio de Validez</td>
                                <td class="campo"><input type="text" id="datepicker_inicio" name="inicio" value="<?PHP echo $core["vacantes"]->getInicio(); ?>" size="10" maxlength="10" readonly="readonly" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Fin de Validez</td>
                                <td class="campo"><input type="text" id="datepicker_fin" name="fin" value="<?PHP echo $core["vacantes"]->getFin(); ?>" size="10" maxlength="10" readonly="readonly" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Vacante Activa</td>
                                <td class="campo">
                                    <?PHP if ($core["vacantes"]->getActivo() == "X") { ?>
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
                <a name="Candidatos" id="Candidatos"></a>
				<h1>Candidatos</h1>
                <table class="reportes">
                	<thead>
                    	<tr>
                        	<td>#</td>
                            <td>Candidato</td>
                            <td>Nombre</td>
                            <td>Tipo</td>
                            <td>Empleado</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                    	<?PHP foreach ($listado_candidatos as $indice => $candidato) { ?>
                    	<tr>
                        	<td><?PHP echo $indice + 1; ?></td>
                            <td><a href="../../candidatos/abrir.php?usuario=<?PHP echo $candidato["candidato"]; ?>"><?PHP echo $candidato["candidato"]; ?></a></td>
                            <td><?PHP echo $candidato["nombre"]; ?></td>
                            <td><?PHP echo $candidato["tipo"]; ?></td>
                            <td><?PHP echo $candidato["empleado"]; ?></td>
                            <td>
                            	<?PHP
									
									$manuales = $core["vacantes"]->ExistenManuales($candidato["candidato"], $vacante); 
									$existen = $core["vacantes"]->ExistenEvaluacionesPendientes($candidato["candidato"], $vacante);
									
									if ($manuales) {
								?>
                                		<a href="manuales_abrir.php?vacante=<?PHP echo $vacante; ?>&candidato=<?PHP echo $candidato["candidato"]; ?>">
                                        <img src="../../../../imgs/acciones/manuales_abrir.png" alt="Calificación Manual Pendiente" title="Calificación Manual Pendiente" />
                                        </a>
                                <?PHP		
									} elseif (!($existen)) {
								?>
                                		<a href="evaluacion_abrir.php?vacante=<?PHP echo $vacante; ?>&candidato=<?PHP echo $candidato["candidato"]; ?>">
                                        <img src="../../../../imgs/acciones/abrir_evaluacion.png" alt="Abrir Evaluaciones" title="Abrir Evaluaciones" />
                                        </a>
                                <?PHP
									}
								
								?>
                            </td>
                            <td>
                            	<?PHP
									
									if ($core["vacantes"]->CandidatoAutorizado($vacante, $candidato["candidato"])) {
								?>
                                	<a href="desautorizar_candidato.php?vacante=<?PHP echo $vacante; ?>&candidato=<?PHP echo $candidato["candidato"]; ?>">
                                	<img src="../../../../imgs/acciones/desautorizar.png" alt="Desautorizar Candidato" title="Desautorizar Candidato" />
                                    </a>
                                <?PHP
									} else {
								?>
                                	<a href="autorizar_candidato.php?vacante=<?PHP echo $vacante; ?>&candidato=<?PHP echo $candidato["candidato"]; ?>">
                                	<img src="../../../../imgs/acciones/esperando.png" alt="Candidato en Espera" title="Candidato en Espera" />
                                    </a>
                                <?PHP
									}
								?>
                            </td>
                            
                            <!-- Envío de correo -->
                            <td>
                            	<a href="previa_correo.php?vacante=<?PHP echo $vacante; ?>&candidato=<?PHP echo $candidato["candidato"]; ?>">
                            	<img src="../../../../imgs/acciones/enviar_correo.png" alt="Enviar Correo" title="Enviar Correo" />
                                </a>
                            </td>
                            
                        </tr>
                        <?PHP } ?>
                    </tbody>
                    <tfoot>
                    	<tr>
                        	<td colspan="6">
                            	<form name="frmCandidatos" method="post" action="comparativo.php">
                                	<input type="hidden" name="vacante" value="<?PHP echo $vacante_seleccionada; ?>" />
	                                <input type="submit" name="btnComparativo" value="Comparativo" />
                                </form>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                
                <a name="Baterias" id="Baterias"></a>
				<h1>Baterías Asignadas</h1>
                <form name="frmBaterias" method="post" action="asignar.php">
                <table class="reportes">
                	<thead>
                    	<tr>
                        	<td>#</td>
                            <td>Batería</td>
                            <td>Secuencia</td>
                            <td>&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                    	<?PHP foreach ($listado_asignadas as $indice => $elemento) { ?>
                    	<tr>
                        	<td><?PHP echo $indice + 1; ?></td>
                            <td><?PHP echo strtoupper($elemento["bateria"]) . " - " . $elemento["titulo"]; ?></td>
                            <td><?PHP echo $elemento["secuencia"]; ?></td>
                            <td><a href="desasignar.php?bateria=<?PHP echo $elemento["bateria"]; ?>"><img src="../../../../imgs/utilerias/basurero.png" alt="Desasignar" title="Desasignar" /></a></td>
                        </tr>
                        <?PHP } ?>
                    </tbody>
                    <tfoot>
                    	<tr>
                        	<td colspan="4">
                                <input type="hidden" name="vacante" value="<?PHP echo $vacante_seleccionada; ?>" />
                                <select name="bateria">
                                    <option value="">Elija una Batería de Evaluaciones</option>
                                    <?PHP foreach ($listado_disponibles as $indice => $elemento) { ?>
                                        <option value="<?PHP echo $elemento["bateria"]; ?>"><?PHP echo strtoupper($elemento["bateria"]) . " - " . $elemento["titulo"]; ?></option>
                                    <?PHP } ?>
                                </select>
                                <input type="submit" name="btnAsignar" value="Asignar" />
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </form>
                <br />
                <a name="Adjuntos" id="Adjuntos"></a>
				<h1>Archivos Adjuntos</h1>
                <form name="frmAdjuntos" method="post" action="adjuntar.php" enctype="multipart/form-data">
                <table class="reportes">
                	<thead>
                    	<tr>
                        	<td>#</td>
                            <td>Instante</td>
                            <td>Archivo</td>
                        </tr>
                    </thead>
                    <tbody>
                    	<?PHP foreach ($listado_archivos as $indice => $elemento) { ?>
                    	<tr>
                        	<td><?PHP echo $indice + 1; ?></td>
                            <td><?PHP echo $elemento["instante"]; ?></td>
                            <td><a href="../../../../archivos/<?PHP echo $elemento["archivo"] ?>" target="_blank"><?PHP echo $elemento["archivo"] ?></a></td>
                        </tr>
                        <?PHP } ?>
                    </tbody>
                    <tfoot>
                    	<tr>
                        	<td colspan="3">
                            	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                                <input type="hidden" name="vacante" value="<?PHP echo $vacante_seleccionada; ?>" />
                            	<input type="file" name="archivo" />
                                <input type="submit" name="btnAdjuntar" value="Adjuntar" />
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
                            <td><?PHP echo $elemento["nota"] ?></td>
                        </tr>
                        <?PHP } ?>
                    </tbody>
                    <tfoot>
                    	<tr>
                        	<td colspan="3">
                                <input type="hidden" name="vacante" value="<?PHP echo $vacante_seleccionada; ?>" />
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
                    	<li>Indique el título, descripción y requisitos de la vacante.</li>
                        <li>Elija el área de la organización donde se abrió la vacante, considerando que sólo tendrá acceso a las que tenga asignadas.</li>
                        <li>Indique fecha de inicio y fin de la vacante.</li>
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
