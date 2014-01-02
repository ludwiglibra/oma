<?PHP

	require_once("../../../../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}
	
	$usuario_seleccionado = $core["sesion"]->getVariable("usuario_seleccionado");
	$candidato = $usuario_seleccionado;
	
	if ($usuario_seleccionado != "") {
		if (($usuario_seleccionado != $core["parametros"]->getAdministrador()) && $usuario_seleccionado != $sesion_usuario) {
			
			$core["usuarios"]->setUsuario($usuario_seleccionado);
			$core["usuarios"]->Cargar();
			
			$core["generales"]->setUsuario($candidato);
			$core["generales"]->Cargar();
			
			$core["candidatos"]->setCandidato($candidato);
			$core["candidatos"]->Cargar();
			
			$core["estudios"]->setCandidato($candidato);
			$core["estudios"]->Cargar();
			
			$core["idiomas"]->setCandidato($candidato);
			$core["idiomas"]->setSecuencia("1");
			$core["idiomas"]->Cargar();
			
			$core["experiencias"]->setCandidato($candidato);
			$core["experiencias"]->Cargar();
			
			$core["salarial"]->setCandidato($candidato);
			$core["salarial"]->Cargar();
			
			/* Cargar Adjuntos */
			$core["archivos"]->setTabla("candidatos");
			$core["archivos"]->setValor1($candidato);
			$listado_archivos = $core["archivos"]->Listado();
			
			$listado_paises = $core["listados"]->ListadoPaises();
			$listado_generos = $core["listados"]->ListadoGeneros();
			$listado_civiles = $core["listados"]->ListadoCiviles();
			$listado_tipos = $core["listados"]->ListadoTipos();
			$listado_paises = $core["listados"]->ListadoPaises();
			$listado_escolaridades = $core["listados"]->ListadoEscolaridades();
			$listado_idiomas = $core["listados"]->ListadoIdiomas();
			$listado_areas = $core["listados"]->ListadoAreas();
			$listado_niveles = $core["listados"]->NivelesActivos();
			$listado_niveles2 = $core["listados"]->ListadoNiveles();
			$listado_accesos = $core["listados"]->ListadoAccesosUsuario($usuario_seleccionado);
			$listado_senioritys = $core["listados"]->ListadoSenioritys();
			$listado_meses = $core["listados"]->ListadoMeses();
			$listado_industrias = $core["listados"]->ListadoIndustrias();
			$listado_salarios = $core["listados"]->ListadoSalarios();
			
			$vacante = (isset($_GET["vacante"]) && $_GET["vacante"] != "") ? $_GET["vacante"] : "";
			if ($vacante == "") {
				$vacante = $core["sesion"]->getVariable("campo_vacante");
				$core["sesion"]->setVariable("campo_vacante", "");
			}
			
			$completo = false;
			
			if ($core["candidatos"]->Existe($candidato)) {
				if ($core["estudios"]->Existe($candidato)) {
					if ($core["experiencias"]->Existe($candidato)) {
						if ($core["idiomas"]->Existe($candidato, "X")) {
							if ($core["informatica"]->Existe($candidato, 1)) {
								if ($core["salarial"]->Existe($candidato)) {
									$completo = true;
								}
							}
						}
					}
				}
			}
			
		} else {
			$core["sesion"]->setmensaje("No es posible dar mantenimiento al administrador del sistema ni al usuario personal en esta pantalla");
			header("location: ../");
			exit;	
		}
	} else {
		header("location: ../");
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
                            	<a href="../../parametros/">Parámetros del Sistema</a>
                                <a href="../../areas/">Áreas de la Organización</a>
                                <a href="../../usuarios/">Control de Usuarios</a>
                                <a href="../../accesos/">Registro de Accesos</a>
                                <a href="../../imagenes/">Imágenes de Banner</a>
                                <a href="../../informatica/">Conocimientos Informática</a>
                                <a href="../../industrias/">Catálogo Industrias</a>
                                <a href="../../errores/">Monitor Errores SQL</a>
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
                                <a href="../../../bolsa/vacantes/agregar/">Creación de Vacante</a>
                                <a href="../../../bolsa/vacantes/">Administración de Vacantes</a>
                                <a href="../../../bolsa/candidatos/">Control de Candidatos</a>
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
                  <h1>Detalles de Usuario <strong><?PHP echo strtoupper($usuario_seleccionado); ?></strong></h1>
                  <form name="frmDatos" method="post" action="actualizar.php">
                    	<table class="detalles">
                        	<tbody>
                            	<tr>
                                	<td class="obligatorio">* Correo Electrónico</td>
                                    <td class="campo"><input type="text" name="usuario" value="<?PHP echo $core["usuarios"]->getUsuario(); ?>" size="50" readonly="readonly" class="llave" /></td>
                                </tr>
                                <tr>
                                	<td class="obligatorio">* Nivel de Usuario</td>
                                    <td class="campo">
                                    	<select name="nivel">
                                        	<?PHP foreach ($listado_niveles as $indice => $elemento) { ?>
                                            	<?PHP if ($elemento["nivel"] == $core["usuarios"]->getNivel()) { ?>
                                                	<option value="<?PHP echo $elemento["nivel"]; ?>" selected="selected">
                                                <?PHP } else { ?>
                                        			<option value="<?PHP echo $elemento["nivel"]; ?>">
                                                <?PHP } ?>
                                                <?PHP echo $elemento["descripcion"] . " (" . $elemento["nivel"] . ")"; ?>
                                                </option>
                                            <?PHP } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                	<td class="obligatorio">Usuario Activo</td>
                                    <td class="campo">
                                    	<?PHP if ($core["usuarios"]->getActivo() == "X") { ?>
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
                    
                    <?PHP if ($completo) { ?>
                    <div class="mensajes">Este candidato tiene completo su perfil</div>
                    <?PHP } ?>
                    
                    <h1>Datos Generales de Candidato</h1>
                    <table class="detalles">
                        <tbody>
                            <tr>
                                <td class="obligatorio">* Nombre(s)</td>
                                <td class="campo"><input type="text" name="nombres" value="<?PHP echo $core["generales"]->getNombres(); ?>" size="70" maxlength="200" readonly="readonly" class="llave" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">* Apellido(s)</td>
                                <td class="campo"><input type="text" name="apellidos" value="<?PHP echo $core["generales"]->getApellidos(); ?>" size="70" maxlength="200" readonly="readonly" class="llave" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Teléfono Celular</td>
                                <td class="campo">
                                    <input type="text" name="prefcelular" value="<?PHP echo $core["generales"]->getPrefcelular(); ?>" size="5" maxlength="10" readonly="readonly" class="llave" />
                                    <input type="text" name="celular" value="<?PHP echo $core["generales"]->getCelular(); ?>" size="20" maxlength="100" readonly="readonly" class="llave" />
                                </td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Teléfono Fijo</td>
                                <td class="campo">
                                    <input type="text" name="preffijo" value="<?PHP echo $core["generales"]->getPreffijo(); ?>" size="5" maxlength="10" readonly="readonly" class="llave" />
                                    <input type="text" name="fijo" value="<?PHP echo $core["generales"]->getFijo(); ?>" size="20" maxlength="100" readonly="readonly" class="llave" />
                                </td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Nacionalidad</td>
                                <td class="campo">
                                
                                    <select name="nacionalidad" disabled="disabled" class="llave">
                                    
                                    <?PHP 
                                        foreach ($listado_paises as $indice_pais => $pais) { 
                                            if ($core["generales"]->getNacionalidad() == $pais["pais"]) {
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
                                <td class="obligatorio">Fecha de Nacimiento</td>
                                <td class="campo"><input type="text" id="datepicker_nacimiento" name="nacimiento" value="<?PHP echo $core["generales"]->getNacimiento(); ?>" size="10" maxlength="10" readonly="readonly" class="llave" /></td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Sexo</td>
                                <td class="campo">
                                
                                    <select name="genero" disabled="disabled" class="llave">
                                    
                                    <?PHP 
                                        foreach ($listado_generos as $indice_genero => $genero) { 
                                            if ($core["generales"]->getGenero() == $genero["genero"]) {
                                    ?>
                                        
                                        <option value="<?PHP echo $genero["genero"]; ?>" selected="selected"><?PHP echo $genero["descripcion"]; ?></option>
                                    <?PHP } else { ?>
                                        <option value="<?PHP echo $genero["genero"]; ?>"><?PHP echo $genero["descripcion"]; ?></option>
                                    
                                    <?PHP 
                                            }
                                        } 
                                    ?>
                                    
                                    </select>
                                
                                </td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Estado Civil</td>
                                <td class="campo">
                                
                                    <select name="civil" disabled="disabled" class="llave">
                                    
                                    <?PHP 
                                        foreach ($listado_civiles as $indice_civil => $civil) { 
                                            if ($core["generales"]->getCivil() == $civil["civil"]) {
                                    ?>
                                        
                                        <option value="<?PHP echo $civil["civil"]; ?>" selected="selected"><?PHP echo $civil["descripcion"]; ?></option>
                                    <?PHP } else { ?>
                                        <option value="<?PHP echo $civil["civil"]; ?>"><?PHP echo $civil["descripcion"]; ?></option>
                                    
                                    <?PHP 
                                            }
                                        } 
                                    ?>
                                    
                                    </select>
                                
                                </td>
                            </tr>
                            <tr>
                                <td class="obligatorio">Dependientes Económicos</td>
                                <td class="campo">
                                
                                    <select name="dependientes" disabled="disabled" class="llave">
                                    
                                    <?PHP 
                                        for ($x=0; $x<=20; $x++) { 
                                            if ($core["generales"]->getDependientes() == $x) {
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
                                <td class="obligatorio">Domicilio</td>
                                <td class="campo"><textarea name="domicilio" cols="50" rows="5" readonly="readonly" class="llave"><?PHP echo $core["generales"]->getDomicilio(); ?></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <a name="Estudios" id="Estudios"></a>
						<h1>Estudios</h1>
                        <br />
                        <form name="frmEstudios" method="post" action="actualizar_estudios.php">
                        <input type="hidden" name="vacante" value="<?PHP echo $vacante; ?>" />
                    	<table class="detalles">
                        	<tbody>
                            	<tr>
                                	<td class="obligatorio">* Título</td>
                                    <td class="campo"><input type="text" name="titulo" value="<?PHP echo $core["estudios"]->getTitulo(); ?>" size="70" maxlength="100" readonly="readonly" class="llave" /></td>
                                </tr>
                                <tr>
                                	<td class="obligatorio">País</td>
                                    <td class="campo">
                                    
                                    	<select name="nacionalidad" disabled="disabled" class="llave">
                                        
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
                                    <td class="campo"><input type="text" name="institucion" value="<?PHP echo $core["estudios"]->getInstitucion(); ?>" size="70" maxlength="100" readonly="readonly" class="llave" /></td>
                                </tr>
                                <tr>
                                    <td class="obligatorio">Fecha de Inicio</td>
                                    <td class="campo">
                                    
                                    	<select name="mes_inicio" disabled="disabled" class="llave">
                                        
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
                                        
                                        <select name="ano_inicio" disabled="disabled" class="llave">
                                        	
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
                                    
                                    	<select name="mes_fin" disabled="disabled" class="llave">
                                        
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
                                        
                                        <select name="ano_fin" disabled="disabled" class="llave">
                                        	
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
                                    		<input type="checkbox" name="presente" value="X" checked="checked" disabled="disabled" class="llave" />
                                        <?PHP } else { ?>
                                        	<input type="checkbox" name="presente" value="X" disabled="disabled" class="llave" />
                                        <?PHP } ?>
                                    </td>
                                </tr>
                                <tr>
                                	<td class="obligatorio">Nivel de Escolaridad</td>
                                    <td class="campo">
                                    
                                    	<select name="escolaridad" disabled="disabled" class="llave">
                                        
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
                        </table>
                    	</form>
                        <a name="Idiomas" id="Idiomas"></a>
						<h1>Idiomas</h1>
                        <br />
                        <form name="frmidiomas" method="post" action="actualizar_idiomas.php">
                        <input type="hidden" name="primario" value="X" />
                    	<table class="detalles">
                        	<tbody>
                                <tr>
                                	<td class="obligatorio">* Idioma</td>
                                    <td class="campo">
                                    
                                    	<select name="idioma" disabled="disabled" class="llave" >
                                        
                                        <?PHP 
											foreach ($listado_idiomas as $indice_idioma => $idioma) { 
												if ($core["idiomas"]->getIdioma() == $idioma["idioma"]) {
										?>
                                        	
                                            <option value="<?PHP echo $idioma["idioma"]; ?>" selected="selected"><?PHP echo $idioma["descripcion"]; ?></option>
                                        <?PHP } else { ?>
                                        	<option value="<?PHP echo $idioma["idioma"]; ?>"><?PHP echo $idioma["descripcion"]; ?></option>
                                        
                                        <?PHP 
												}
											} 
										?>
                                        
                                        </select>
                                    
                                    </td>
                                </tr>
                                <tr>
                                	<td class="obligatorio">* Escrito</td>
                                    <td class="campo">
                                    
                                    	<select name="escrito" disabled="disabled" class="llave">
                                        
                                        <?PHP 
											for ($x=0; $x<=100; $x++) {
												if ($core["idiomas"]->getEscrito() == $x) {
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
                                	<td class="obligatorio">* Oral</td>
                                    <td class="campo">
                                    
                                    	<select name="oral" disabled="disabled" class="llave">
                                        
                                        <?PHP 
											for ($x=0; $x<=100; $x++) {
												if ($core["idiomas"]->getOral() == $x) {
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
                            </tbody>
                        </table>
                        </form>
                        
                        <?PHP 
						
							if ($core["idiomas"]->Existe($candidato, "X")) {
							
								$core["idiomas"]->setCandidato($candidato);
								$core["idiomas"]->setPrimario("");
								$core["idiomas"]->Cargar();
							
						?>
                        
                            <h1>Segundo Idioma</h1>
                        <br />
                        <div class="mensajes">Muchas empresas realizan tests de idiomas para comprobar el nivel de cada postulante</div>
                        <form name="frmidiomas" method="post" action="actualizar_idiomas.php">
                        <input type="hidden" name="primario" value="" />
                    	<table class="detalles">
                        	<tbody>
                                <tr>
                                	<td class="obligatorio">* Idioma</td>
                                    <td class="campo">
                                    
                                    	<select name="idioma" disabled="disabled" class="llave">
                                        
                                        <?PHP 
											foreach ($listado_idiomas as $indice_idioma => $idioma) { 
												if ($core["idiomas"]->getIdioma() == $idioma["idioma"]) {
										?>
                                        	
                                            <option value="<?PHP echo $idioma["idioma"]; ?>" selected="selected"><?PHP echo $idioma["descripcion"]; ?></option>
                                        <?PHP } else { ?>
                                        	<option value="<?PHP echo $idioma["idioma"]; ?>"><?PHP echo $idioma["descripcion"]; ?></option>
                                        
                                        <?PHP 
												}
											} 
										?>
                                        
                                        </select>
                                    
                                    </td>
                                </tr>
                                <tr>
                                	<td class="obligatorio">* Escrito</td>
                                    <td class="campo">
                                    
                                    	<select name="escrito" disabled="disabled" class="llave">
                                        
                                        <?PHP 
											for ($x=0; $x<=100; $x++) {
												if ($core["idiomas"]->getEscrito() == $x) {
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
                                	<td class="obligatorio">* Oral</td>
                                    <td class="campo">
                                    
                                    	<select name="oral" disabled="disabled" class="llave">
                                        
                                        <?PHP 
											for ($x=0; $x<=100; $x++) {
												if ($core["idiomas"]->getOral() == $x) {
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
                            </tbody>
                        </table>
                    	</form>
                        <?PHP } ?>
                        
                        <a name="Informatica" id="Informatica"></a>
						<h1>Informática</h1>
                        
                        <?PHP
						
							$listado_secuencias = $core["informatica"]->ListadoSecuencias($candidato);
							
							foreach ($listado_secuencias as $indice_secuencia => $registro) {
								
								$core["informatica"]->setCandidato($candidato);
								$core["informatica"]->setSecuencia($registro["secuencia"]);
								$core["informatica"]->Cargar();
								
								$listado_conocimientos = $core["listados"]->ListadoConocimientos($core["informatica"]->getArea());
						
						?>
                        
                        <form name="frmnInformatica" method="post" action="eliminar_informatica.php">
                        <input type="hidden" name="candidato" value="<?PHP echo $candidato; ?>" />
                        <input type="hidden" name="secuencia" value="<?PHP echo $registro["secuencia"]; ?>" />
                    	<table class="detalles">
                        	<tbody>
                                <tr>
                                	<td class="obligatorio">* Area</td>
                                    <td class="campo">
                                    
                                    	<select name="area" class="llave" disabled="disabled">
                                        
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
                                    
                                    	<select name="conocimiento" class="llave" disabled="disabled">
                                        
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
                                    
                                    	<select name="nivel" class="llave" disabled="disabled">
                                        
                                        <?PHP 
											foreach ($listado_niveles2 as $indice_nivel => $nivel) { 
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
                        </table>
                    	</form>
                        
                        <?PHP
						
							} 
						
							if (count($listado_secuencias) == 0) {
							
						?>
                        
                        <?PHP
						
							$campo_area = (isset($_POST["area"]) && $_POST["area"] != "") ? $_POST["area"] : "";
							$listado_conocimientos = $core["listados"]->ListadoConocimientos($campo_area);
						
						?>
                        
                        <a name="Informatica2" id="Informatica2"></a>
                        <form name="frmnInformatica" method="post" action="index.php#Informatica2">
                        <input type="hidden" name="secuencia" value="0" />
                    	<table class="detalles">
                        	<tbody>
                                <tr>
                                	<td class="obligatorio">* Area</td>
                                    <td class="campo">
                                    
                                    	<select name="area" disabled="disabled" class="llave">
                                        
                                        <?PHP 
											foreach ($listado_areas as $indice_area => $area) { 
												if ($campo_area == $area["area"]) {
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
                                    
                                    	<select name="conocimiento" disabled="disabled" class="llave">
                                        
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
                                    
                                    	<select name="nivel" disabled="disabled" class="llave">
                                        
                                        <?PHP 
											foreach ($listado_niveles2 as $indice_nivel => $nivel) { 
										?>
                                        	<option value="<?PHP echo $nivel["nivel"]; ?>"><?PHP echo $nivel["descripcion"]; ?></option>
                                        <?PHP 
											} 
										?>
                                        
                                        </select>
                                    
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    	</form>
                        <?PHP } ?>
                        
                        <a name="Experiencias" id="Experiencias"></a>
						<h1>Experiencias Laborales</h1>
                        <br />
                        <form name="frmExperiencias" method="post" action="actualizar_experiencias.php">
                        <input type="hidden" name="vacante" value="<?PHP echo $vacante; ?>" />
                    	<table class="detalles">
                        	<tbody>
                            	<tr>
                                	<td class="obligatorio">Título / Puesto</td>
                                    <td class="campo">
                                    	<input type="text" name="titulo" value="<?PHP echo $core["experiencias"]->getTitulo(); ?>" size="70" maxlength="100" readonly="readonly" class="llave" />
                                    </td>
                                </tr>
                                <tr>
                                	<td class="obligatorio">Empresa</td>
                                    <td class="campo"><input type="text" name="empresa" value="<?PHP echo $core["experiencias"]->getEmpresa(); ?>" size="70" maxlength="100" disabled="disabled" class="llave" /></td>
                                </tr>
                                <tr>
                                	<td class="obligatorio">País</td>
                                    <td class="campo">
                                    
                                    	<select name="pais" disabled="disabled" class="llave">
                                        
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
                                    
                                    	<select name="mes_inicio" disabled="disabled" class="llave">
                                        
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
                                        
                                        <select name="ano_inicio" disabled="disabled" class="llave">
                                        	
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
                                    
                                    	<select name="mes_fin" disabled="disabled" class="llave">
                                        
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
                                        
                                        <select name="ano_fin" disabled="disabled" class="llave">
                                        	
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
                                    		<input type="checkbox" name="presente" value="X" checked="checked" readonly="readonly" class="llave" />
                                        <?PHP } else { ?>
                                        	<input type="checkbox" name="presente" value="X" disabled="disabled" class="llave" />
                                        <?PHP } ?>
                                    </td>
                                </tr>
                                <tr>
                                	<td class="obligatorio">Area</td>
                                    <td class="campo"><input type="text" name="area" value="<?PHP echo $core["experiencias"]->getArea(); ?>" size="70" maxlength="100" readonly="readonly" class="llave" /></td>
                                </tr>
                                <tr>
                                	<td class="obligatorio">Sub-Area</td>
                                    <td class="campo"><input type="text" name="subarea" value="<?PHP echo $core["experiencias"]->getSubarea(); ?>" size="70" maxlength="100" disabled="disabled" class="llave" /></td>
                                </tr>
                                
                                
                                <tr>
                                	<td class="obligatorio">Industria</td>
                                    <td class="campo">
                                    
                                    	<select name="industria" disabled="disabled" class="llave">
                                        
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
                                    <td class="campo"><textarea name="responsabilidades" cols="70" rows="10" readonly="readonly" class="llave"><?PHP echo $core["experiencias"]->getResponsabilidades(); ?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                    	</form>
                        
                        <a name="Salarial" id="Salarial"></a>
						<h1>Sueldo Actual y Expectativa Salarial</h1>
                        <br />

                        <form name="frmSalarial" method="post" action="actualizar_salarial.php">
                        <input type="hidden" name="candidato" value="<?PHP echo $candidato; ?>" />
                        <input type="hidden" name="vacante" value="<?PHP echo $vacante; ?>" />
                    	<table class="detalles">
                        	<tbody>
                                <tr>
                                    <td class="obligatorio">Sueldo Actual</td>
                                    <td class="campo">
                                    
                                    	<select name="actual" disabled="disabled" class="llave">
                                        
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
                                    
                                    	<select name="expectativas" disabled="disabled" class="llave">
                                        
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
                    	</form>
                        
                        <br />
                        <a name="Adjuntos" id="Adjuntos"></a>
                        <h1>Documentos Adicionales</h1>
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
                        </table>
                        </form>
                    
                    <h1>Accesos del Usuario</h1>
                    <table class="reportes">
                        	<thead>
                            	<tr>
                                	<td>#</td>
                                    <td>Instante</td>
                                    <td>IP</td>
                                    <td>Navegador</td>
                                </tr>
                            </thead>
                            <tbody>
                            	<?PHP foreach ($listado_accesos as $indice => $elemento) { ?>
                            	<tr>
                                	<td><?PHP echo $indice + 1; ?></td>
                                    <td><?PHP echo $elemento["instante"]; ?></td>
                                    <td><?PHP echo $elemento["ip"]; ?></td>
                                    <td><?PHP echo $elemento["navegador"]; ?></td>
                                </tr>
								<?PHP } ?>
                            </tbody>
                        </table>
                        
				  <!-- InstanceEndEditable -->
                </div>
            </div>
            <div class="derecha">
            	<div class="opciones">
                    <!-- InstanceBeginEditable name="Opciones" -->
                    <h1>Instrucciones</h1>
                    <ol>
                    	<li>Proporcione nombre y correo electrónico del usuario</li>
                        <li>Indique el nivel que debe tener el usuario</li>
                        <li>Marque o desmarque el check <strong>ACTIVO</strong>, dependiendo si desea tener activo o inactivo al usuario, respectivamente.</li>
                        <li>Haga click en el botón <strong>ACTUALIZAR</strong> para aplicar los cambios o en el botón <strong>VOLVER</strong> para regresar al listado de usuarios.</li>
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
