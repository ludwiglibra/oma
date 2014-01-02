$(document).ready(function(){
	
	$('.inicioSubmenu').hide();
	$('.inicioHover').hoverIntent(mostrarInicio, esconderInicio);
	
	$('.omaSubmenu').hide();
	$('.omaHover').hoverIntent(mostrarOMA, esconderOMA);
	
	$('.formatosSubmenu').hide();
	$('.formatosHover').hoverIntent(mostrarFormatos, esconderFormatos);
	
	$('.sitiosSubmenu').hide();
	$('.sitiosHover').hoverIntent(mostrarSitios, esconderSitios);
	
	$('.centroSubmenu').hide();
	$('.centroHover').hoverIntent(mostrarCentro, esconderCentro);
	
	


	function mostrarInicio(){  $('.inicioSubmenu').slideDown(100);}
	function esconderInicio(){ $('.inicioSubmenu').slideUp(100);}
	
	function mostrarOMA(){  $('.omaSubmenu').slideDown(100);}
	function esconderOMA(){ $('.omaSubmenu').slideUp(100);}
	
	function mostrarFormatos(){  $('.formatosSubmenu').slideDown(100);}
	function esconderFormatos(){ $('.formatosSubmenu').slideUp(100);}
	
	function mostrarSitios(){  $('.sitiosSubmenu').slideDown(100);}
	function esconderSitios(){ $('.sitiosSubmenu').slideUp(100);}
	
	function mostrarCentro(){  $('.centroSubmenu').slideDown(100);}
	function esconderCentro(){ $('.centroSubmenu').slideUp(100);}


});