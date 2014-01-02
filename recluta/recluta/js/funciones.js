/*******************************************************************************************
	DETERMINAR SI EL PARÁMETRO TIENE VALOR
*******************************************************************************************/
function all(valor) {

	if (valor != "") {
		return true;
	} else {
		return false;
	}

}

/*******************************************************************************************
	DETERMINAR SI EL PARÁMETRO ES VACÍO
*******************************************************************************************/
function none(valor) {
	
	if (valor == "") {
		return true;
	} else {
		return false;
	}
	
}

/*******************************************************************************************
	FUNCIÓN QUE VALIDA UNA DIRECCIÓN DE CORREO ELECTRÓNICO
*******************************************************************************************/
function EmailValido(valor) {

  re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
  
  if(re.exec(valor)) {
	return true;
  } else {
  	return false;
  }

}

/*******************************************************************************************
	FUNCIONES QUE VALIDAN UNA FECHA
*******************************************************************************************/
function FechaValida(valor) {
	
    if (valor != undefined && valor.value != "" ) {

		if (!/^\d{2}\/\d{2}\/\d{4}$/.test(valor.value)) {
			return false;
		}

        var dia  =  parseInt(valor.value.substring(0,2),10);
        var mes  =  parseInt(valor.value.substring(3,5),10);
        var anio =  parseInt(valor.value.substring(6),10);
 
		switch(mes) {
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				numDias = 31;
				break;
			case 4: 
			case 6: 
			case 9: 
			case 11:
				numDias = 30;
				break;
			case 2:
				if (AnioBisiesto(anio)) { 
					numDias=29 
				} else { 
					numDias=28
				};
				break;
			default:
				return false;
		}
 
        if (dia>numDias || dia==0) {
            return false;
        }
		
        return true;
		
    } else {

		return false;
		
	}
	
}

function AnioBisiesto(anio) {

	if ((anio % 100 != 0) && ((anio % 4 == 0) || (anio % 400 == 0))) {
		return true;
    } else {
    	return false;
    }
	
}

/*******************************************************************************************
	FUNCIÓN QUE VALIDA SI UN VALOR ES NUMÉRICO ENTERO
*******************************************************************************************/
function EnteroValido(valor){

	regexp = /^[0-9]*$/;
	return regexp.test(valor);

}

/*******************************************************************************************
	FUNCIÓN QUE VALIDA SI UN VALOR ES NUMÉRICO DECIMAL
*******************************************************************************************/
function DecimalValido(valor){

	regexp = /^[0-9]*.[0-9]*$/;
	return regexp.test(valor);

}

/*******************************************************************************************
	FUNCIÓN QUE CREA UNA COKIE
*******************************************************************************************/

function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*60*60*24));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

/*******************************************************************************************
	FUNCIÓN QUE REGRESA VALOR DE UNA COOKIE
*******************************************************************************************/

function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

/*******************************************************************************************
	FUNCIÓN QUE ELIMINA UNA COOKIE
*******************************************************************************************/

function eraseCookie(name) {
	createCookie(name,"",-1);
}

/*******************************************************************************************
	FUNCIÓN QUE ACTIVA OBJETOS DE UN FORMULARIO 
*******************************************************************************************/

function ActivarObjetos(formulario, tipo, nombre) {
	for (i=0;i<formulario.elements.length;i++) {
		//alert(formulario.elements[i].name+": "+formulario.elements[i].type);
		if ((formulario.elements[i].type == tipo) || (formulario.elements[i].name == nombre)) {
			formulario.elements[i].disabled = false;
			formulario.elements[i].className = 'ObjetoActivo';
		} 
	}
}

/*******************************************************************************************
	FUNCIÓN QUE DESACTIVA OBJETOS DE UN FORMULARIO 
*******************************************************************************************/

function DesactivarObjetos(formulario, tipo, nombre) {
	for (i=0;i<formulario.elements.length;i++) {
		//alert(formulario.elements[i].name+": "+formulario.elements[i].type);
		if ((formulario.elements[i].type == tipo) || (formulario.elements[i].name == nombre)) {
			formulario.elements[i].disabled = true;
			formulario.elements[i].className = 'ObjetoInactivo';
		} 
	}
}

/*******************************************************************************************
	FUNCIÓN QUE VUELVE VISIBLE OBJETOS DE UN FORMULARIO 
*******************************************************************************************/

function MostrarObjetos(formulario, tipo, nombre) {
	for (i=0;i<formulario.elements.length;i++) {
		if ((formulario.elements[i].type == tipo) || (formulario.elements[i].name == nombre))  {
			formulario.elements[i].disable = false;
			formulario.elements[i].className = 'ObjetoVisible';
		} 
	}
}

/*******************************************************************************************
	FUNCIÓN QUE VUELVE INVISIBLE OBJETOS DE UN FORMULARIO 
*******************************************************************************************/

function OcultarObjetos(formulario, tipo, nombre) {
	for (i=0;i<formulario.elements.length;i++) {
		if ((formulario.elements[i].type == tipo) || (formulario.elements[i].name == nombre)) {
			formulario.elements[i].disable = true;
			formulario.elements[i].className = 'ObjetoInvisible';
		}
	}
}

/*******************************************************************************************
	FUNCIÓN PARA MARCAR TODOS LOS CHECKBOX DE SELECCIÓN DE UN FORMULARIO
*******************************************************************************************/

function Todos(formulario) {
	for (i=0;i<formulario.elements.length;i++) {
		if (formulario.elements[i].type == "checkbox") {
			formulario.elements[i].checked = 1;
		} 
	}
}

/*******************************************************************************************
	FUNCIÓN PARA DESMARCAR TODOS LOS CHECKBOX DE SELECCIÓN DE UN FORMULARIO
*******************************************************************************************/

function Ninguno(formulario) {
	for (i=0;i<formulario.elements.length;i++) {
		if (formulario.elements[i].type == "checkbox") {
			formulario.elements[i].checked = 0;
		} 
	}
}

/*******************************************************************************************
	FUNCIÓN PARA HACER UN MARCAJE INVERSO DE LOS CHECKBOX DE SELECCIÓN DE UN FORMULARIO
*******************************************************************************************/

function Invertir(formulario) {
	for (i=0;i<formulario.elements.length;i++) {
		if (formulario.elements[i].type == "checkbox") {
			if (formulario.elements[i].checked == 1) {
				formulario.elements[i].checked = 0;
			} else {
				formulario.elements[i].checked = 1;
			}
		} 
	}
}

/*******************************************************************************************
	FUNCIÓN PARA ABRIR OPCIÓN ELEGIDA
*******************************************************************************************/

function AbrirOpcion(modulo, opcion) {
	
	document.frmNavegador.modulo.value = modulo;
	document.frmNavegador.opcion.value = opcion;
	document.frmNavegador.submit();
	
}

/*******************************************************************************************
	FUNCIÓN PARA COLOCAR CURSOR EN PRIMER CAMPO DE PAGINA
*******************************************************************************************/

function CursorInicial() {
	
	formulario = document.forms[0];
		
	for (i=0;i<formulario.elements.length;i++) {
	
		//alert();

		if ((!(formulario.elements[i].disabled)) && (!(formulario.elements[i].readOnly))) {
			
			if (formulario.elements[i].type != 'hidden' && formulario.elements[i].type != 'button' && formulario.elements[i].type != 'checkbox') {
			
				if (formulario.elements[i].type == 'text' || formulario.elements[i].type == 'password' || formulario.elements[i].type == 'textarea') {
					
					formulario.elements[i].focus(1);
					break;
					
				}
				
			}
			
		}
			 
	}
}
