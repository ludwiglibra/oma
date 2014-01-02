<?PHP

	require_once("../cadenero.php");
	
	if (file_exists("cadenero.php")) {
		require_once("cadenero.php");
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- TemplateBeginEditable name="doctitle" -->
<title>OMA Reclutamiento</title>
<!-- TemplateEndEditable -->

<link rel="shortcut icon" href="../imgs/icono/favicon.ico" />
<link rel="stylesheet" href="../css/main.css" type="text/css">
<link rel="stylesheet" href="../css/flexslider.css" type="text/css">
<link rel="stylesheet" href="../css/reveal.css" type="text/css">
<link rel="stylesheet" href="../css/default.css" type="text/css">

<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/jquery-ui-1.8.22.custom.min.js"></script>
<script src="../js/hoverintent.js" type="text/javascript"></script>
<script src="../js/easing.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/cycle.min.js"></script>
<script src="../js/nav.js" type="text/javascript"></script>
<script src="../js/jquery.reveal.js"></script>
<script src="../js/jquery.flexslider-min.js"></script>
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
<script language="javascript" src="../js/md5.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
<script language="javascript" src="cadenero.js"></script>

<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
<div class="header-wrap">
	<div class="header">
		<a href="../index.php"><img src="../imgs/logotipo/logotipo.png"/></a>
		<div class="wel-nav">
			<div class="welcome">
            	
                <?PHP if ($sesion_registrada) { ?>
					<span>Bienvenido</span> <?PHP echo $sesion_nombre; ?>
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

                <!-- nav -->
                <div class="nav">
                    <div class="inicioHover">
                        <a href="#" onclick=window.print(); class="btnInicio">Imprimir</a>
                    </div>
                    <div class="formatosHover">
                        <a href="../exportar.php" class="btnFormatos">Exportar</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- nav -->
            
            <?PHP } ?>
            
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="wrap">
	<div class="homeCont">
        
    	<?PHP if ($sesion_registrada) { ?>
			
		<!-- TemplateBeginEditable name="Contenido" -->Contenido<!-- TemplateEndEditable -->
        
        <?PHP } else { ?>
        
        	<!-- FORMULARIO DE LOGIN -->
            	<div align="center">
                    <div class="login">
                        <h1>Ingreso de Usuarios</h1>
                        <form name="frmLogin" method="post" action="../login.php">
                            <fieldset class="campos">
                                <label>Usuario</label>
                                <input type="text" name="usuario" size="36" maxlength="50" />
                                <label>Clave</label>
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
            	<img src="../imgs/logotipos/gptw.png" alt="Greate Place To Work" />
				<img src="../imgs/logotipos/ambiental.png" alt="Calidad Ambiental" />
                <img src="../imgs/logotipos/bolsa.png" alt="Bolsa Mexicana de Valores" />
                <img src="../imgs/logotipos/ica.png" alt="ICA" />
                <img src="../imgs/logotipos/iso.png" alt="ISO" />
                <img src="../imgs/logotipos/lrqa.png" alt="LRQA" />
                <img src="../imgs/logotipos/ohsas.png" alt="OHSAS" />
                <img src="../imgs/logotipos/sustentable.png" alt="Empresa Sustentable" />
                <img src="../imgs/logotipos/nasdaq.png" alt="Nasdaq" />
                <img src="../imgs/logotipos/esr.png" alt="Empresa Socialmente Responsable" />
                <img src="../imgs/logotipos/paris.png" alt="Paris" />
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
</html>
