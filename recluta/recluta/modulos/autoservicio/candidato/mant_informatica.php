<?PHP

	require_once("../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$candidato = $sesion_usuario;
	
	/* Validar Estatus del Aviso de Privacidad del Candidato */
	$core["candidatos"]->setCandidato($candidato);
	$core["candidatos"]->Cargar();
	$existe_aviso = false;
	if ($core["candidatos"]->getAviso() == "X") {
		$existe_aviso = true;
	}
			
	$listado_tipos = $core["listados"]->ListadoTipos();
	$listado_paises = $core["listados"]->ListadoPaises();
	$listado_escolaridades = $core["listados"]->ListadoEscolaridades();
	$listado_idiomas = $core["listados"]->ListadoIdiomas();
	$listado_areas = $core["listados"]->ListadoAreas();
	$listado_niveles = $core["listados"]->ListadoNiveles();
	$listado_senioritys = $core["listados"]->ListadoSenioritys();
	$listado_meses = $core["listados"]->ListadoMeses();
	$listado_industrias = $core["listados"]->ListadoIndustrias();
	$listado_salarios = $core["listados"]->ListadoSalarios();
	
	$secuencia_seleccionada = (isset($_POST["secuencia"]) && $_POST["secuencia"] != "") ? $_POST["secuencia"] : "";
	$area_seleccionada = (isset($_POST["area"]) && $_POST["area"] != "") ? $_POST["area"] : "";	
	$listado_conocimientos = $core["listados"]->ListadoConocimientos($area_seleccionada);

	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	$completo = false;
	
	if ($core["candidatos"]->Existe($candidato)) {
		if ($core["estudios"]->Existe($candidato)) {
			if ($core["experiencias"]->Existe($candidato)) {
				if ($core["idiomas"]->Existe($candidato)) {
					if ($core["informatica"]->Existe($candidato)) {
						if ($core["salarial"]->Existe($candidato)) {
							$completo = true;
						}
					}
				}
			}
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Privadas.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- InstanceBeginEditable name="doctitle" -->
<title>OMA Reclutamiento</title>
<!-- InstanceEndEditable -->

<link rel="shortcut icon" href="../../../imgs/icono/favicon.ico" />
<link rel="stylesheet" href="../../../css/main.css" type="text/css">
<link rel="stylesheet" href="../../../css/flexslider.css" type="text/css">
<link rel="stylesheet" href="../../../css/reveal.css" type="text/css">
<link rel="stylesheet" href="../../../css/default.css" type="text/css">

<script src="../../../js/jquery-1.7.2.min.js"></script>
<script src="../../../js/jquery-ui-1.8.22.custom.min.js"></script>
<script src="../../../js/hoverintent.js" type="text/javascript"></script>
<script src="../../../js/easing.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../js/cycle.min.js"></script>
<script src="../../../js/nav.js" type="text/javascript"></script>
<script src="../../../js/jquery.reveal.js"></script>
<script src="../../../js/jquery.flexslider-min.js"></script>
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
<script language="javascript" src="../../../js/md5.js"></script>
<script language="javascript" src="../../../js/funciones.js"></script>
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
			changeYear: true,
			yearRange: "1900:2100"
		}).val();
    });
	
	$(function() {
		$("#datepicker_fin").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			yearRange: "1900:2100"
		}).val();
    });
	
	$(function() {
		$("#datepicker_inicio2").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			yearRange: "1900:2100"
		}).val();
    });
	
	$(function() {
		$("#datepicker_fin2").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			yearRange: "1900:2100"
		}).val();
    });
	
</script>
<!-- InstanceEndEditable -->
</head>

<body <?PHP if ($sesion_registrada) { ?> style="background:url(../../../imgs/logotipo/yosoyoma.png) no-repeat top right fixed" <?PHP } ?>>

<a name="Inicio" id="Inicio"></a>
<div class="header-wrap">
	
    <!-- INICIO CABECERA -->
    <div class="header">
		<a href="../../../index.php"><img src="../../../imgs/logotipo/logotipo.png"/></a>
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
                            <a href="../../../index.php" class="btnInicio">Inicio</a>
                            <div class="inicioSubmenu navSub">
                                <a href="../generales/">Mis Datos Generales</a>
                                <a href="../candidato/">Mis Datos de Candidato</a>
                                <a href="../cambio/">Cambio de Contraseña</a>
                                <a href="../accesos/">Mis Accesos al Sistema</a>
                                <a href="../../../logout.php">Cerrar Sesión</a>
                            </div>
                        </div>
                        
                        <div class="formatosHover">
                            <a href="#" class="btnFormatos">&nbsp;&nbsp;&nbsp;&nbsp;Admin&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <div class="formatosSubmenu navSub subnormal">
                            	<a href="../../administracion/parametros/">Parámetros del Sistema</a>
                                <a href="../../administracion/areas/">Áreas de la Organización</a>
                                <a href="../../administracion/usuarios/">Control de Usuarios</a>
                                <a href="../../administracion/accesos/">Registro de Accesos</a>
                                <a href="../../administracion/imagenes/">Imágenes de Banner</a>
                                <a href="../../administracion/informatica/">Conocimientos Informática</a>
                                <a href="../../administracion/industrias/">Catálogo Industrias</a>
                                <a href="../../administracion/errores/">Monitor Errores SQL</a>
                            </div>
                        </div>
                        
                        <div class="centroHover">
                            <a href="#" class="btnCentro">&nbsp;&nbsp;&nbsp;&nbsp;Bolsa de Trabajo&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <div class="centroSubmenu navSub subnormal">
                                <a href="../../bolsa/vacantes/agregar/">Creación de Vacante</a>
                                <a href="../../bolsa/vacantes/">Administración de Vacantes</a>
                                <a href="../../bolsa/candidatos/">Control de Candidatos</a>
                            </div>
                        </div>
                        
                        <div class="sitiosHover">
                            <a href="#" class="btnSitios">&nbsp;&nbsp;Evaluaciones&nbsp;&nbsp;</a>
                            <div class="sitiosSubmenu navSub subnormal">
                            	<a href="../../evaluaciones/evaluaciones/agregar/">Crear Evaluación Técnica</a>
                            	<a href="../../evaluaciones/baterias/agregar/">Crear Batería de Evaluaciones</a>
                                <a href="../../evaluaciones/evaluaciones/">Administrar Evaluaciones</a>
                                <a href="../../evaluaciones/baterias/">Administrar Baterías de Evaluaciones</a>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                    <!-- nav -->
                    
				<?PHP } elseif($sesion_nivel == 1 || $sesion_nivel == 2) { ?>
            
                    <!-- nav -->
                    <div class="nav">
                        
                        <div class="inicioHover">
                            <a href="../../../index.php" class="btnInicio">Inicio</a>
                            <div class="inicioSubmenu navSub">
                                <a href="../generales/">Mis Datos Generales</a>
                                <a href="../candidato/">Mis Datos de Candidato</a>
                                <a href="../cambio/">Cambio de Contraseña</a>
                                <a href="../accesos/">Mis Accesos al Sistema</a>
                                <a href="../../../logout.php">Cerrar Sesión</a>
                            </div>
                        </div>
                        
                        <div class="centroHover">
                            <a href="#" class="btnCentro">&nbsp;&nbsp;&nbsp;&nbsp;Bolsa de Trabajo&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            <div class="centroSubmenu navSub subnormal">
                                <a href="../../bolsa/vacantes/agregar/">Creación de Vacante</a>
                                <a href="../../bolsa/vacantes/">Administración de Vacantes</a>
                                <a href="../../bolsa/candidatos/">Control de Candidatos</a>
                            </div>
                        </div>
                        
                        <div class="sitiosHover">
                            <a href="#" class="btnSitios">&nbsp;&nbsp;Evaluaciones&nbsp;&nbsp;</a>
                            <div class="sitiosSubmenu navSub subnormal">
                            	<a href="../../evaluaciones/evaluaciones/agregar/">Crear Evaluación Técnica</a>
                            	<a href="../../evaluaciones/baterias/agregar/">Crear Batería de Evaluaciones</a>
                                <a href="../../evaluaciones/evaluaciones/">Administrar Evaluaciones</a>
                                <a href="../../evaluaciones/baterias/">Administrar Baterías de Evaluaciones</a>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                    <!-- nav -->
                    
				<?PHP } elseif($sesion_nivel == 3) { ?>
            
                    <!-- nav -->
                    <div class="nav">
                        
                        <div class="inicioHover">
                            <a href="../../../index.php" class="btnInicio">Inicio</a>
                            <div class="inicioSubmenu navSub">
                                <a href="../generales/">Mis Datos Generales</a>
                                <a href="../candidato/">Mis Datos de Candidato</a>
                                <a href="../accesos/">Mis Accesos al Sistema</a>
                                <a href="../../../logout.php">Cerrar Sesión</a>
                            </div>
                        </div>
                        
                        <div class="sitiosHover">
                            <a href="../../candidatos/vacantes/" class="btnSitios">&nbsp;&nbsp;&nbsp;&nbsp;Vacantes&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                    <!-- nav -->
                    
				<?PHP } ?>
            
            <?PHP } else { ?>
            
            	<div class="nav">
                
                	<div class="centroHover">
                        <a href="../../../registro/" class="btnCentro">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registrarme&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    </div>
                    
                    <div class="sitiosHover">
                        <a href="../../../recuperar/" class="btnSitios">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recuperar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
                  
				  <?PHP if (!($existe_aviso)) { ?>
                  <div class="mensajes">Consulte nuestro <a href="../../candidatos/vacantes/participar/aviso.php">AVISO DE PROTECCIÓN DE DATOS PERSONALES</a>. ¡Es un requisito indispensable para participar en las vacantes de OMA!</div>
                  <?PHP } ?>
                  
                  <?PHP if ($completo) { ?>
                  <div class="mensajes">
                  Tu información fue enviada con éxito, en breve el área de integración de personal establecerá contacto contigo
				  <br />
                  ¡Gracias por tu interés en formar parte del equipo de trabajo de OMA!
                  </div>
                  <?PHP } ?>
                        
						<h1>Informática</h1>
                        
                        <br />
                        <div class="mensajes">Para conocimientos de informática, como lenguajes de programación o software, utilizar "Otros conocimientos"</div>
                        
                        <form name="frmnInformatica" method="post" action="#">
	                        <input type="hidden" name="secuencia" value="0" />
                            <table class="detalles">
                                <tbody>
                                	<tr>
                                    	<td class="obligatorio">* Registro</td>
                                        <td class="etiqueta">Agregar</td>
                                    </tr>
                                    <tr>
                                        <td class="obligatorio">* Area</td>
                                        <td class="campo">
                                        
                                            <select name="area" onchange=submit();>
                                            	<option value=""></option>
                                            <?PHP 
                                                foreach ($listado_areas as $indice_area => $area) { 
                                                    if ($area_seleccionada == $area["area"]) {
                                            ?>
                                                
                                                <option value="<?PHP echo $area["area"]; ?>" selected="selected"><?PHP echo $area["descripcion"]; ?></option>
                                            <?PHP } else { ?>
                                                <option value="<?PHP echo $area["area"]; ?>"><?PHP echo $area["descripcion"]; ?></option>
                                            
                                            <?PHP 
                                                    }
                                                } 
                                            ?>
                                            
                                            </select>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="obligatorio">* Conocimiento</td>
                                        <td class="campo">
                                        
                                            <select name="conocimiento">
                                            
                                            <?PHP 
                                                foreach ($listado_conocimientos as $indice_conocimiento => $conocimiento) { 
                                            ?>
                                            
                                                <option value="<?PHP echo $conocimiento["conocimiento"]; ?>"><?PHP echo $conocimiento["descripcion"]; ?></option>
                                            
                                            <?PHP 
                                                } 
                                            ?>
                                            
                                            </select>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="obligatorio">* Nivel de Conocimiento</td>
                                        <td class="campo">
                                        
                                            <select name="nivel">
                                            
                                            <?PHP 
                                                foreach ($listado_niveles as $indice_nivel => $nivel) { 
                                            ?>
                                                <option value="<?PHP echo $nivel["nivel"]; ?>"><?PHP echo $nivel["descripcion"]; ?></option>
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
                                            <input type="button" name="btnAgregar" value="Agregar" onclick=ActualizarInformatica(this.form); />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                    	</form>
                        
                        <?PHP
						
							$listado_secuencias = $core["informatica"]->ListadoSecuencias($candidato);
							
							foreach ($listado_secuencias as $indice_secuencia => $registro) {
								
								$core["informatica"]->setCandidato($candidato);
								$core["informatica"]->setSecuencia($registro["secuencia"]);
								$core["informatica"]->Cargar();
								
								$listado_conocimientos = $core["listados"]->ListadoConocimientos($core["informatica"]->getArea());
						
						?>
                        
                        <form name="frmnInformatica" method="post" action="#">
	                        <input type="hidden" name="secuencia" value="<?PHP echo $registro["secuencia"]; ?>" />
                            <table class="detalles">
                                <tbody>
                                	<tr>
                                    	<td class="obligatorio">Registro</td>
                                        <td class="etiqueta"><?PHP echo $indice_secuencia + 1; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="obligatorio">* Area</td>
                                        <td class="campo">
                                        
                                            <select name="area" onchange=submit();>
                                            
                                            <?PHP 
                                                foreach ($listado_areas as $indice_area => $area) { 
                                                    if ($core["informatica"]->getArea() == $area["area"]) {
                                            ?>
                                                
                                                <option value="<?PHP echo $area["area"]; ?>" selected="selected"><?PHP echo $area["descripcion"]; ?></option>
                                            <?PHP } else { ?>
                                                <option value="<?PHP echo $area["area"]; ?>"><?PHP echo $area["descripcion"]; ?></option>
                                            
                                            <?PHP 
                                                    }
                                                } 
                                            ?>
                                            
                                            </select>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="obligatorio">* Conocimiento</td>
                                        <td class="campo">
                                        
                                            <select name="conocimiento">
                                            
                                            <?PHP 
                                                foreach ($listado_conocimientos as $indice_conocimiento => $conocimiento) { 
                                                    if ($core["informatica"]->getConocimiento() == $conocimiento["conocimiento"]) {
                                            ?>
                                                
                                                <option value="<?PHP echo $conocimiento["conocimiento"]; ?>" selected="selected"><?PHP echo $conocimiento["descripcion"]; ?></option>
                                            <?PHP } else { ?>
                                                <option value="<?PHP echo $conocimiento["conocimiento"]; ?>"><?PHP echo $conocimiento["descripcion"]; ?></option>
                                            
                                            <?PHP 
                                                    }
                                                } 
                                            ?>
                                            
                                            </select>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="obligatorio">* Nivel de Conocimiento</td>
                                        <td class="campo">
                                        
                                            <select name="nivel">
                                            
                                            <?PHP 
                                                foreach ($listado_niveles as $indice_nivel => $nivel) { 
                                                    if ($core["informatica"]->getNivel() == $nivel["nivel"]) {
                                            ?>
                                                
                                                <option value="<?PHP echo $nivel["nivel"]; ?>" selected="selected"><?PHP echo $nivel["descripcion"]; ?></option>
                                            <?PHP } else { ?>
                                                <option value="<?PHP echo $nivel["nivel"]; ?>"><?PHP echo $nivel["descripcion"]; ?></option>
                                            
                                            <?PHP 
                                                    }
                                                } 
                                            ?>
                                            
                                            </select>
                                        
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                        	<input type="button" name="btnActualizar" value="Actualizar" onclick=ActualizarInformatica(this.form); />
                                            <input type="button" name="btnEliminar" value="Eliminar" onclick=EliminarInformatica(this.form); />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                    	</form>
                        
                        <?PHP
						
							}
						
						?>
                        
                        <?PHP
						
							$campo_area = (isset($_POST["area"]) && $_POST["area"] != "") ? $_POST["area"] : "";
							$listado_conocimientos = $core["listados"]->ListadoConocimientos($campo_area);
						
						?>
                        
                         <!-- SECCION DE CANDIDATO -->
                <?PHP
					$alerta = false;
					if (!($core["candidatos"]->Existe($candidato))) {
						$alerta = true;
					}
					if ($alerta) {
				?>
                <h1><a href="index.php">Datos de Candidato</a></h1>
                <?PHP 
					} else {
				?>
                <h1><a href="index.php">Datos de Candidato</a></h1>
                <?PHP 
					}
				?>

				<!-- SECCION DE ESTUDIOS -->
                <?PHP
					$alerta = false;
					if (!($core["estudios"]->Existe($candidato))) {
						$alerta = true;
					}
					if ($alerta) {
				?>
                <h1><a href="mant_estudios.php">Estudios <strong>(Pendiente)</strong></a></h1>
                <?PHP 
					} else {
				?>
                <h1><a href="mant_estudios.php">Estudios</a></h1>
                <?PHP 
					}
				?>
                
                <!-- SECCION DE IDIOMAS -->
                <?PHP
					$alerta = false;
					if (!($core["idiomas"]->Existe($candidato))) {
						$alerta = true;
					}
					if ($alerta) {
				?>
                <h1><a href="mant_idiomas.php">Idiomas <strong>(Pendiente)</strong></a></h1>
                <?PHP 
					} else {
				?>
                <h1><a href="mant_idiomas.php">Idiomas</a></h1>
                <?PHP 
					}
				?>
                        
						<!-- SECCION DE EXPERIENCIAS -->
                <?PHP
					$alerta = false;
					if (!($core["experiencias"]->Existe($candidato))) {
						$alerta = true;
					}
					if ($alerta) {
				?>
                <h1><a href="mant_experiencias.php">Experiencias Laborales <strong>(Pendiente)</strong></a></h1>
                <?PHP 
					} else {
				?>
                <h1><a href="mant_experiencias.php">Experiencias Laborales</a></h1>
                <?PHP 
					}
				?>
                
                <!-- SECCION DE SALARIAL -->
                <?PHP
					$alerta = false;
					if (!($core["salarial"]->Existe($candidato))) {
						$alerta = true;
					}
					if ($alerta) {
				?>
                <h1><a href="mant_salarial.php">Sueldo Actual y Expectativa Salarial <strong>(Pendiente)</strong></a></h1>
                <?PHP 
					} else {
				?>
                <h1><a href="mant_salarial.php">Sueldo Actual y Expectativa Salarial</a></h1>
                <?PHP 
					}
				?>
                        
                        <h1><a href="mant_documentos.php">Documentos Adicionales</a></h1>
                        
						<!-- InstanceEndEditable -->
                </div>
            </div>
            <div class="derecha">
            	<div class="opciones">
                    <!-- InstanceBeginEditable name="Opciones" -->
                        <h1>Instrucciones</h1>
                        <ol>
                        	<li>Ingrese la información solicitada en cada una de las secciones de la información de candidato.</li>
                            <li>Hacer click en el botón <strong>ACTUALIZAR</strong> para almacenar la información de la sección correspondiente.</li>
                        </ol>
                        <em>Los candidatos internos deben ir acompañados de una clave de empleado, los candidatos externos deben carecer de ella.</em>
                        <em>Los campos marcados con asterisco (*) son obligatorios.</em>
						<!-- InstanceEndEditable -->
                </div>
            </div>
            <div class="clear"></div>
        
        <?PHP } else { ?>
        
        	<!-- FORMULARIO DE LOGIN -->
            	<div align="center">
                    <div class="login">
                        <h1>Ingreso de Usuarios</h1>
                        <form name="frmLogin" method="post" action="../../../login.php">
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
            	<img src="../../../imgs/logotipos/gptw.png" alt="Greate Place To Work" />
				<img src="../../../imgs/logotipos/ambiental.png" alt="Calidad Ambiental" />
                <img src="../../../imgs/logotipos/bolsa.png" alt="Bolsa Mexicana de Valores" />
                <img src="../../../imgs/logotipos/ica.png" alt="ICA" />
                <img src="../../../imgs/logotipos/iso.png" alt="ISO" />
                <img src="../../../imgs/logotipos/lrqa.png" alt="LRQA" />
                <img src="../../../imgs/logotipos/ohsas.png" alt="OHSAS" />
                <img src="../../../imgs/logotipos/sustentable.png" alt="Empresa Sustentable" />
                <img src="../../../imgs/logotipos/nasdaq.png" alt="Nasdaq" />
                <img src="../../../imgs/logotipos/esr.png" alt="Empresa Socialmente Responsable" />
                <img src="../../../imgs/logotipos/paris.png" alt="Paris" />
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
