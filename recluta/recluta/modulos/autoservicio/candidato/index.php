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
	
	/* Cargar Candidato */
	$core["candidatos"]->setCandidato($candidato);
	$core["candidatos"]->Cargar();
	
	/* Listados Relacionados */
	$listado_tipos = $core["listados"]->ListadoTipos();
	$listado_paises = $core["listados"]->ListadoPaises();
	$listado_escolaridades = $core["listados"]->ListadoEscolaridades();
	$listado_idiomas = $core["listados"]->ListadoIdiomas();
	$listado_niveles = $core["listados"]->ListadoNiveles();
	$listado_senioritys = $core["listados"]->ListadoSenioritys();
	$listado_meses = $core["listados"]->ListadoMeses();
	$listado_industrias = $core["listados"]->ListadoIndustrias();
	$listado_salarios = $core["listados"]->ListadoSalarios();
	$listado_conocimientos = $core["listados"]->ListadoConocimientos();
	
	$vacante = $core["sesion"]->getVariable("vacante_aplicando");
	
	$completo = false;
	
	if ($core["candidatos"]->Existe($candidato)) {
		if ($core["estudios"]->Existe($candidato)) {
			if ($core["idiomas"]->Existe($candidato)) {		
				if ($core["informatica"]->Existe($candidato)) {
					if ($core["experiencias"]->Existe($candidato)) {	
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
                
                <form name="frmCandidatos" method="post" action="actualizar.php">

                	<input type="hidden" name="vacante" value="<?PHP echo $vacante; ?>" />
	                <input type="hidden" name="candidato" value="<?PHP echo $candidato; ?>" />
                
                <!-- SECCIÓN DE REGISTROS DE CANDIDATO -->
				
                <h1>Datos de Candidato</h1>
                    
                <table class="detalles">
                    <tbody>
                        <tr>
                            <td class="obligatorio">* Tipo de Candidato</td>
                            <td class="campo">
                                <select name="candidato_tipo" onfocus=AjustaTipoCandidato(this.form); onchange=AjustaTipoCandidato(this.form);>
									<?PHP 
                                        foreach ($listado_tipos as $indice_tipos => $tipo) { 
                                            if ($tipo["tipo"] == $core["candidatos"]->getTipo()) {
                                    ?>
                                        <option value="<?PHP echo $tipo["tipo"]; ?>" selected="selected"><?PHP echo $tipo["descripcion"]; ?></option>
                                    <?PHP } else { ?>                 
                                        <option value="<?PHP echo $tipo["tipo"]; ?>"><?PHP echo $tipo["descripcion"]; ?></option>
                                    <?PHP 
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="obligatorio">ID de Empleado</td>
                            <td class="campo"><input type="text" name="candidato_empleado" value="<?PHP echo $core["candidatos"]->getEmpleado(); ?>" size="10" maxlength="100" /></td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- SECCION DE REGISTROS ESTUDIOS -->
                
                <a name="SeccionEstudios" id="SeccionEstudios"></a>
                
				<table class="cabecera_candidatos">
                    <tbody>
                        <tr>
                            <td class="titulo">Estudios</td>
                            <td class="botones"><input type="button" name="btnAgregarEstudio" value="Agregar" onclick=AgregarEstudio(this.form); /></td>
                        </tr>
                    </tbody>
                </table>

                <br />
                <div class="mensajes">Incluye estudios que sean relevantes para los puestos a los que quieres postularte</div>
                
                <?PHP 
					
					$listado_estudios = $core["estudios"]->ListadoSecuencias($candidato);
					
					foreach ($listado_estudios as $indice_secuencias => $secuencia) { 
					
						$core["estudios"]->setCandidato($candidato);
						$core["estudios"]->setSecuencia($secuencia["secuencia"]);
						$core["estudios"]->Cargar();
					
				?>
                
                        <input type="hidden" name="estudios_secuencia[<?PHP echo $core["estudios"]->getSecuencia(); ?>]" value="<?PHP echo $core["estudios"]->getSecuencia(); ?>" />
                        <table class="detalles">
                            <tbody>
                                <tr>
                                    <td class="obligatorio">* Título</td>
                                    <td class="campo"><input type="text" name="estudios_titulo[<?PHP echo $core["estudios"]->getSecuencia(); ?>]" value="<?PHP echo $core["estudios"]->getTitulo(); ?>" size="70" maxlength="100" /></td>
                                </tr>
                                <tr>
                                    <td class="obligatorio">País</td>
                                    <td class="campo">
                                    
                                        <select name="estudios_pais[<?PHP echo $core["estudios"]->getSecuencia(); ?>]">
                                        
                                        <?PHP 
                                            foreach ($listado_paises as $indice_pais => $pais) { 
                                                if ($core["estudios"]->getPais() == $pais["pais"]) {
                                        ?>
                                            
                                            <option value="<?PHP echo $pais["pais"]; ?>" selected="selected"><?PHP echo $pais["descripcion"]; ?></option>
                                        <?PHP } else { ?>
                                            <option value="<?PHP echo $pais["pais"]; ?>"><?PHP echo $pais["descripcion"]; ?></option>
                                        
                                        <?PHP 
                                                }
                                            } 
                                        ?>
                                        
                                        </select>
                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td class="obligatorio">Institución</td>
                                    <td class="campo"><input type="text" name="estudios_institucion[<?PHP echo $core["estudios"]->getSecuencia(); ?>]" value="<?PHP echo $core["estudios"]->getInstitucion(); ?>" size="70" maxlength="100" /></td>
                                </tr>
                                <tr>
                                    <td class="obligatorio">Fecha de Inicio</td>
                                    <td class="campo">
                                    
                                        <select name="estudios_mes_inicio[<?PHP echo $core["estudios"]->getSecuencia(); ?>]">
                                        
                                        <?PHP 
                                            foreach ($listado_meses as $indice_mes => $mes) { 
                                                if ($core["estudios"]->getMes_Inicio() == $mes["mes"]) {
                                        ?>
                                            
                                            <option value="<?PHP echo $mes["mes"]; ?>" selected="selected"><?PHP echo $mes["descripcion"]; ?></option>
                                        <?PHP } else { ?>
                                            <option value="<?PHP echo $mes["mes"]; ?>"><?PHP echo $mes["descripcion"]; ?></option>
                                        
                                        <?PHP 
                                                }
                                            } 
                                        ?>
                                        
                                        </select>
                                        
                                        <select name="estudios_ano_inicio[<?PHP echo $core["estudios"]->getSecuencia(); ?>]">
                                            
                                            <option value=""></option>
                    
                                            <?PHP
                                            
                                                $actual = date("Y");
                                                $inferior = $actual - 100;
                                                
                                                for ($x=$actual;$x>=$inferior;$x--) {
                                                    
                                                    if ($core["estudios"]->getAno_Inicio() == $x) {
                                            ?>
                                                <option value="<?PHP echo $x; ?>" selected="selected"><?PHP echo $x; ?></option>
                                            <?PHP } else { ?>
                                                <option value="<?PHP echo $x; ?>"><?PHP echo $x; ?></option>
                                            <?PHP
                                                    }
                                                }
                                            ?>
                                        
                                        </select>
                                        
                                    
                                    </td>
                                </tr>
                                 <tr>
                                    <td class="obligatorio">Fecha de Finalización</td>
                                    <td class="campo">
                                    
                                        <select name="estudios_mes_fin[<?PHP echo $core["estudios"]->getSecuencia(); ?>]">
                                        
                                        <?PHP 
                                            foreach ($listado_meses as $indice_mes => $mes) { 
                                                if ($core["estudios"]->getMes_Fin() == $mes["mes"]) {
                                        ?>
                                            
                                            <option value="<?PHP echo $mes["mes"]; ?>" selected="selected"><?PHP echo $mes["descripcion"]; ?></option>
                                        <?PHP } else { ?>
                                            <option value="<?PHP echo $mes["mes"]; ?>"><?PHP echo $mes["descripcion"]; ?></option>
                                        
                                        <?PHP 
                                                }
                                            } 
                                        ?>
                                        
                                        </select>
                                        
                                        <select name="estudios_ano_fin[<?PHP echo $core["estudios"]->getSecuencia(); ?>]">
                                            
                                            <option value=""></option>
                    
                                            <?PHP
                                            
                                                $actual = date("Y");
                                                $inferior = $actual - 100;
                                                
                                                for ($x=$actual;$x>=$inferior;$x--) {
                                                    
                                                    if ($core["estudios"]->getAno_Fin() == $x) {
                                            ?>
                                                <option value="<?PHP echo $x; ?>" selected="selected"><?PHP echo $x; ?></option>
                                            <?PHP } else { ?>
                                                <option value="<?PHP echo $x; ?>"><?PHP echo $x; ?></option>
                                            <?PHP
                                                    }
                                                }
                                            ?>
                                        
                                        </select>
                                        
                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td class="obligatorio">Al Presente</td>
                                    <td class="campo">
                                        <?PHP if ($core["estudios"]->getPresente() == "X") { ?>
                                            <input type="checkbox" name="estudios_presente[<?PHP echo $core["estudios"]->getSecuencia(); ?>]" value="X" checked="checked" />
                                        <?PHP } else { ?>
                                            <input type="checkbox" name="estudios_presente[<?PHP echo $core["estudios"]->getSecuencia(); ?>]" value="X" />
                                        <?PHP } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="obligatorio">Nivel de Escolaridad</td>
                                    <td class="campo">
                                    
                                        <select name="estudios_escolaridad[<?PHP echo $core["estudios"]->getSecuencia(); ?>]">
                                        
                                        <?PHP 
                                            foreach ($listado_escolaridades as $indice_escolaridad => $escolaridad) { 
                                                if ($core["estudios"]->getEscolaridad() == $escolaridad["escolaridad"]) {
                                        ?>
                                            
                                            <option value="<?PHP echo $escolaridad["escolaridad"]; ?>" selected="selected"><?PHP echo $escolaridad["descripcion"]; ?></option>
                                        <?PHP } else { ?>
                                            <option value="<?PHP echo $escolaridad["escolaridad"]; ?>"><?PHP echo $escolaridad["descripcion"]; ?></option>
                                        
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
                                        <input type="button" name="btnEliminar" value="Eliminar" onclick=EliminarEstudio(this.form,<?PHP echo $core["estudios"]->getSecuencia(); ?>); />
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                
                <?PHP } ?>
                
                <!-- SECCION DE REGISTROS DE IDIOMAS -->
                
                <a name="SeccionIdiomas" id="SeccionIdiomas"></a>
                
                <table class="cabecera_candidatos">
                    <tbody>
                        <tr>
                            <td class="titulo">Idiomas</td>
                            <td class="botones"><input type="button" name="btnAgregarIdioma" value="Agregar" onclick=AgregarIdioma(this.form); /></td>
                        </tr>
                    </tbody>
                </table>
                    
                <br />
                <div class="mensajes">Muchas empresas realizan tests de idiomas para comprobar el nivel de cada postulante</div>
                
                <?PHP 
                	
					$secuencias_idiomas = $core["idiomas"]->ListadoSecuencias($candidato);
					
                    foreach ($secuencias_idiomas as $indice_secuencias => $secuencia) { 
                    
                        $core["idiomas"]->setCandidato($candidato);
                        $core["idiomas"]->setSecuencia($secuencia["secuencia"]);
                        $core["idiomas"]->Cargar();
                    
                ?>
                    
                        <input type="hidden" name="idiomas_secuencia[<?PHP echo $core["idiomas"]->getSecuencia(); ?>]" value="<?PHP echo $core["idiomas"]->getSecuencia(); ?>" />
                        <table class="detalles">
                            <tbody>
                                <tr>
                                    <td class="obligatorio">* Idioma</td>
                                    <td class="obligatorio">* Escrito</td>
                                    <td class="obligatorio">* Oral</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                	<td class="campo">
                                    
                                        <select name="idiomas_idioma[<?PHP echo $core["idiomas"]->getSecuencia(); ?>]">
                                        
                                        <?PHP 
                                            foreach ($listado_idiomas as $indice_idioma => $idioma) { 
                                                if ($core["idiomas"]->getIdioma() == $idioma["idioma"]) {
                                        ?>
                                            
                                            <option value="<?PHP echo $idioma["idioma"]; ?>" selected="selected"><?PHP echo $idioma["descripcion"]; ?></option>
                                        <?PHP	} else { ?>
                                            <option value="<?PHP echo $idioma["idioma"]; ?>"><?PHP echo $idioma["descripcion"]; ?></option>
                                        
                                        <?PHP 
                                                }
                                            } 
                                        ?>
                                        
                                        </select>
                                    
                                    </td>
                                    <td class="campo">
                                    
                                        <select name="idiomas_escrito[<?PHP echo $core["idiomas"]->getSecuencia(); ?>]">
                                        
                                        <?PHP 
                                            for ($x=0; $x<=10; $x++) {
                                                
                                                $factor = $x * 10;
                                                
                                                if ($core["idiomas"]->getEscrito() == $factor) {
                                        ?>
                                            
                                            <option value="<?PHP echo $factor; ?>" selected="selected"><?PHP echo $factor . "%"; ?></option>
                                        <?PHP } else { ?>
                                            <option value="<?PHP echo $factor; ?>"><?PHP echo $factor . "%"; ?></option>
                                        
                                        <?PHP 
                                                }
                                            } 
                                        ?>
                                        
                                        </select>
                                    
                                    </td>
                                    <td class="campo">
                                    
                                        <select name="idiomas_oral[<?PHP echo $core["idiomas"]->getSecuencia(); ?>]">
                                        
                                        <?PHP 
                                            for ($x=0; $x<=10; $x++) {
                                                
                                                $factor = $x * 10;
                                                
                                                if ($core["idiomas"]->getOral() == $factor) {
                                        ?>
                                            
                                            <option value="<?PHP echo $factor; ?>" selected="selected"><?PHP echo $factor . "%"; ?></option>
                                        <?PHP } else { ?>
                                            <option value="<?PHP echo $factor; ?>"><?PHP echo $factor . "%"; ?></option>
                                        
                                        <?PHP 
                                                }
                                            } 
                                        ?>
                                        
                                        </select>
                                    
                                    </td>
                                    <td>
                                    	<input type="button" name="btnEliminar" value="Eliminar" onclick=EliminarIdioma(this.form,<?PHP echo $core["idiomas"]->getSecuencia(); ?>); />
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    
                <?PHP 
                
                    }
                
                ?>
                
                <!-- SECCION DE INFORMATICA -->
                
				<a name="SeccionInformatica" id="SeccionInformatica"></a>
                
                <table class="cabecera_candidatos">
                    <tbody>
                        <tr>
                            <td class="titulo">Informática</td>
                            <td class="botones"><input type="button" name="btnAgregarInformatica" value="Agregar" onclick=AgregarInformatica(this.form); /></td>
                        </tr>
                    </tbody>
                </table>
                                    
                <br />
                <div class="mensajes">Para conocimientos de informática, como lenguajes de programación o software, utilizar "Otros conocimientos"</div>
				
                <?PHP
						
							$secuencias_informatica = $core["informatica"]->ListadoSecuencias($candidato);
							
							foreach ($secuencias_informatica as $indice_secuencia => $registro) {
								
								$core["informatica"]->setCandidato($candidato);
								$core["informatica"]->setSecuencia($registro["secuencia"]);
								$core["informatica"]->Cargar();
						
						?>
                        
	                        <input type="hidden" name="informatica_secuencia[<?PHP echo $registro["secuencia"]; ?>]" value="<?PHP echo $registro["secuencia"]; ?>" />
                            <table class="detalles">
                                <tbody>
                                    <tr>
                                        <td class="obligatorio">* Conocimiento</td>
                                        <td class="obligatorio">* Nivel</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    	<td class="campo">
                                        
                                            <select name="informatica_conocimiento[<?PHP echo $registro["secuencia"]; ?>]">
                                            	<option></option>
                                            <?PHP 
                                                foreach ($listado_conocimientos as $indice_conocimiento => $conocimiento) { 
                                                    if ($core["informatica"]->getConocimiento() == $conocimiento["conocimiento"]) {
                                            ?>
                                                
                                                <option value="<?PHP echo $conocimiento["conocimiento"]; ?>" selected="selected"><?PHP echo $conocimiento["conocimiento"]; ?></option>
                                            <?PHP } else { ?>
                                                <option value="<?PHP echo $conocimiento["conocimiento"]; ?>"><?PHP echo $conocimiento["conocimiento"]; ?></option>
                                            
                                            <?PHP 
                                                    }
                                                } 
                                            ?>
                                            
                                            </select>
                                        
                                        </td>
                                        <td class="campo">
                                        
                                            <select name="informatica_nivel[<?PHP echo $registro["secuencia"]; ?>]">
                                            
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
                                        <td>
                                            <input type="button" name="btnEliminar" value="Eliminar" onclick=EliminarInformatica(this.form,<?PHP echo $registro["secuencia"]; ?>); />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        
                        <?PHP
						
							}
						
						?>
                
                <!-- SECCION DE EXPERIENCIAS -->
                <a name="SeccionExperiencias" id="SeccionExperiencias"></a>
                
                <table class="cabecera_candidatos">
                    <tbody>
                        <tr>
                            <td class="titulo">Experiencias</td>
                            <td class="botones"><input type="button" name="btnAgregarExperiencia" value="Agregar" onclick=AgregarExperiencia(this.form); /></td>
                        </tr>
                    </tbody>
                </table>
                                    
                <br />
                <div class="mensajes">Describe en pocas palabras las tareas y responsabilidades relevantes de cada experiencia laboral, incluye también pasantías o trabajos voluntarios que consideres relevantes para los puestos a los que quieres postularte</div>				
                
                <?PHP
						
					$secuencias_experiencias = $core["experiencias"]->ListadoSecuencias($candidato);
					
					foreach ($secuencias_experiencias as $indice_secuencia => $registro) {
						
						$core["experiencias"]->setCandidato($candidato);
						$core["experiencias"]->setSecuencia($registro["secuencia"]);
						$core["experiencias"]->Cargar();
				
				?>
                	
                    <input type="hidden" name="experiencias_secuencia[<?PHP echo $registro["secuencia"]; ?>]" value="<?PHP echo $registro["secuencia"]; ?>" />
                	<table class="detalles">
                        <tbody>
                            <tr>
                                <td class="obligatorio">Título / Puesto</td>
                                <td class="campo">
                                    <input type="text" name="experiencias_titulo[<?PHP echo $registro["secuencia"]; ?>]" value="<?PHP echo $core["experiencias"]->getTitulo(); ?>" size="70" maxlength="100" />
                                </td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Empresa</td>
                                <td class="campo"><input type="text" name="experiencias_empresa[<?PHP echo $registro["secuencia"]; ?>]" value="<?PHP echo $core["experiencias"]->getEmpresa(); ?>" size="70" maxlength="100" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">País</td>
                                <td class="campo">
                                
                                    <select name="experiencias_pais[<?PHP echo $registro["secuencia"]; ?>]">
                                    
                                    <?PHP 
                                        foreach ($listado_paises as $indice_pais => $pais) { 
                                            if ($core["experiencias"]->getPais() == $pais["pais"]) {
                                    ?>
                                        
                                        <option value="<?PHP echo $pais["pais"]; ?>" selected="selected"><?PHP echo $pais["descripcion"]; ?></option>
                                    <?PHP } else { ?>
                                        <option value="<?PHP echo $pais["pais"]; ?>"><?PHP echo $pais["descripcion"]; ?></option>
                                    
                                    <?PHP 
                                            }
                                        } 
                                    ?>
                                    
                                    </select>
                                
                                </td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Fecha de Inicio</td>
                                <td class="campo">
                                
                                    <select name="experiencias_mes_inicio[<?PHP echo $registro["secuencia"]; ?>]">
                                    
                                    <?PHP 
                                        foreach ($listado_meses as $indice_mes => $mes) { 
                                            if ($core["experiencias"]->getMes_Inicio() == $mes["mes"]) {
                                    ?>
                                        
                                        <option value="<?PHP echo $mes["mes"]; ?>" selected="selected"><?PHP echo $mes["descripcion"]; ?></option>
                                    <?PHP } else { ?>
                                        <option value="<?PHP echo $mes["mes"]; ?>"><?PHP echo $mes["descripcion"]; ?></option>
                                    
                                    <?PHP 
                                            }
                                        } 
                                    ?>
                                    
                                    </select>
                                    
                                    <select name="experiencias_ano_inicio[<?PHP echo $registro["secuencia"]; ?>]">
                                        
                                        <option value=""></option>
    
                                        <?PHP
                                        
                                            $actual = date("Y");
                                            $inferior = $actual - 100;
                                            
                                            for ($x=$actual;$x>=$inferior;$x--) {
                                                
                                                if ($core["experiencias"]->getAno_Inicio() == $x) {
                                        ?>
                                            <option value="<?PHP echo $x; ?>" selected="selected"><?PHP echo $x; ?></option>
                                        <?PHP } else { ?>
                                            <option value="<?PHP echo $x; ?>"><?PHP echo $x; ?></option>
                                        <?PHP
                                                }
                                            }
                                        ?>
                                    
                                    </select>
                                    
                                
                                </td>
                            </tr>
                             <tr>
                                <td class="obligatorio">Fecha de Finalización</td>
                                <td class="campo">
                                
                                    <select name="experiencias_mes_fin[<?PHP echo $registro["secuencia"]; ?>]">
                                    
                                    <?PHP 
                                        foreach ($listado_meses as $indice_mes => $mes) { 
                                            if ($core["experiencias"]->getMes_Fin() == $mes["mes"]) {
                                    ?>
                                        
                                        <option value="<?PHP echo $mes["mes"]; ?>" selected="selected"><?PHP echo $mes["descripcion"]; ?></option>
                                    <?PHP } else { ?>
                                        <option value="<?PHP echo $mes["mes"]; ?>"><?PHP echo $mes["descripcion"]; ?></option>
                                    
                                    <?PHP 
                                            }
                                        } 
                                    ?>
                                    
                                    </select>
                                    
                                    <select name="experiencias_ano_fin[<?PHP echo $registro["secuencia"]; ?>]">
                                        
                                        <option value=""></option>
    
                                        <?PHP
                                        
                                            $actual = date("Y");
                                            $inferior = $actual - 100;
                                            
                                            for ($x=$actual;$x>=$inferior;$x--) {
                                                
                                                if ($core["experiencias"]->getAno_Fin() == $x) {
                                        ?>
                                            <option value="<?PHP echo $x; ?>" selected="selected"><?PHP echo $x; ?></option>
                                        <?PHP } else { ?>
                                            <option value="<?PHP echo $x; ?>"><?PHP echo $x; ?></option>
                                        <?PHP
                                                }
                                            }
                                        ?>
                                    
                                    </select>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Al Presente</td>
                                <td class="campo">
                                    <?PHP if ($core["experiencias"]->getPresente() == "X") { ?>
                                        <input type="checkbox" name="experiencias_presente[<?PHP echo $registro["secuencia"]; ?>]" value="X" checked="checked" />
                                    <?PHP } else { ?>
                                        <input type="checkbox" name="experiencias_presente[<?PHP echo $registro["secuencia"]; ?>]" value="X" />
                                    <?PHP } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Area</td>
                                <td class="campo"><input type="text" name="experiencias_area[<?PHP echo $registro["secuencia"]; ?>]" value="<?PHP echo $core["experiencias"]->getArea(); ?>" size="70" maxlength="100" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Sub-Area</td>
                                <td class="campo"><input type="text" name="experiencias_subarea[<?PHP echo $registro["secuencia"]; ?>]" value="<?PHP echo $core["experiencias"]->getSubarea(); ?>" size="70" maxlength="100" /></td>
                            </tr>
                            
                            
                            <tr>
                                <td class="obligatorio">Industria</td>
                                <td class="campo">
                                
                                    <select name="experiencias_industria[<?PHP echo $registro["secuencia"]; ?>]">
                                    
                                    <?PHP 
                                        foreach ($listado_industrias as $indice_industria => $industria) { 
                                            if ($core["experiencias"]->getIndustria() == $industria["industria"]) {
                                    ?>
                                        
                                        <option value="<?PHP echo $industria["industria"]; ?>" selected="selected"><?PHP echo $industria["descripcion"]; ?></option>
                                    <?PHP } else { ?>
                                        <option value="<?PHP echo $industria["industria"]; ?>"><?PHP echo $industria["descripcion"]; ?></option>
                                    
                                    <?PHP 
                                            }
                                        } 
                                    ?>
                                    
                                    </select>
                                
                                </td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Responsabilidades</td>
                                <td class="campo"><textarea name="experiencias_responsabilidades[<?PHP echo $registro["secuencia"]; ?>]" cols="70" rows="10"><?PHP echo $core["experiencias"]->getResponsabilidades(); ?></textarea></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                	<input type="button" name="btnEliminar" value="Eliminar" onclick=EliminarExperiencia(this.form,<?PHP echo $registro["secuencia"]; ?>); />
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                
                <?PHP
					}
				?>
                
                <!-- SECCION DE SALARIAL -->
                
                <h1>Sueldo Actual y Expectativa Salarial</h1>
                
                <?PHP
				
					$core["salarial"]->setCandidato($candidato);
					$core["salarial"]->Cargar();
				
				?>
                
                <table class="detalles">
                    <tbody>
                        <tr>
                            <td class="obligatorio">Sueldo Actual</td>
                            <td class="campo">
                            
                                <select name="salarial_actual">
                                
                                <?PHP 
                                    foreach ($listado_salarios as $indice_salario => $salario) { 
                                    
                                        if ($core["salarial"]->getActual() == $salario["salario"]) {
                                ?>
                                    
                                    <option value="<?PHP echo $salario["salario"]; ?>" selected="selected"><?PHP echo $salario["descripcion"]; ?></option>
                                <?PHP } else { ?>
                                    <option value="<?PHP echo $salario["salario"]; ?>"><?PHP echo $salario["descripcion"]; ?></option>
                                
                                <?PHP 
                                        }
                                    } 
                                ?>
                                
                                </select>
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="obligatorio">Expectativa Salarial</td>
                            <td class="campo">
                            
                                <select name="salarial_expectativas">
                                
                                <?PHP 
                                    foreach ($listado_salarios as $indice_salario => $salario) { 
                                    
                                        if ($core["salarial"]->getExpectativas() == $salario["salario"]) {
                                ?>
                                    
                                    <option value="<?PHP echo $salario["salario"]; ?>" selected="selected"><?PHP echo $salario["descripcion"]; ?></option>
                                <?PHP } else { ?>
                                    <option value="<?PHP echo $salario["salario"]; ?>"><?PHP echo $salario["descripcion"]; ?></option>
                                
                                <?PHP 
                                        }
                                    } 
                                ?>
                                
                                </select>
                            
                            </td>
                        </tr>
                    </tbody>
                </table>
                
				<!-- BOTÓN ACTUALIZAR -->
                
                <table class="detalles">
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="btnActualizar" value="Actualizar" />
                            </td>
                        </tr>
                    </tfoot>
                </table>
                    
                </form>
                
                <a name="SeccionAdjuntos" id="SeccionAdjuntos"></a>
                
                <h1>Documentos Adicionales</h1>
                
                <?PHP
				
					/* Cargar Objetos */
					$core["archivos"]->setTabla("candidatos");
					$core["archivos"]->setValor1($candidato);
					$listado_archivos = $core["archivos"]->Listado();
				
				?>
                
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
                            <td><a href="archivos/<?PHP echo $elemento["archivo"] ?>" target="_blank"><?PHP echo $elemento["archivo"] ?></a></td>
                        </tr>
                        <?PHP } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                                <input type="hidden" name="candidato" value="<?PHP echo $candidato; ?>" />
                                <input type="file" name="archivo" />
                                <input type="submit" name="btnAdjuntar" value="Adjuntar" />
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
