var nav4 = window.Event ? true : false;

//valida formato de correo electrónico
function validation_email(email){  
	var text=/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/  
	alert("Email " + (text.test(email)?"":"no ") + "v&aacute;lido.")  
	return text.test(email)  
}  


function validation_date(Cadena)
{  
	var Fecha= new String(Cadena)   // Crea un string  
	var RealFecha= new Date()   // Para sacar la fecha de hoy  
	//Cadena Año  
	/*
	var Ano= new String(Fecha.substring(Fecha.lastIndexOf("-")+1,Fecha.length))  
	// Cadena Mes  
	var Mes= new String(Fecha.substring(Fecha.indexOf("-")+1,Fecha.lastIndexOf("-")))  
	// Cadena Día  
	var Dia= new String(Fecha.substring(0,Fecha.indexOf("-")))  
	*/
	
	var Dia= new String(Fecha.substring(Fecha.lastIndexOf("-")+1,Fecha.length))  
	// Cadena Mes  
	var Mes= new String(Fecha.substring(Fecha.indexOf("-")+1,Fecha.lastIndexOf("-")))  
	// Cadena Día  
	var Ano= new String(Fecha.substring(0,Fecha.indexOf("-")))  
	
	var correct_validation = true;
	// Valido el año  
	if (isNaN(Ano) || Ano.length<4 || parseFloat(Ano)<1900)
	{  
		//alert('Año inválido')  
		//return false  
		correct_validation = false;
	}  
	// Valido el Mes  
	if (isNaN(Mes) || parseFloat(Mes)<1 || parseFloat(Mes)>12)
	{  
		//alert('Mes inválido')  
		//return false  
		correct_validation = false;
	}  
	// Valido el Dia  
	if (isNaN(Dia) || parseInt(Dia, 10)<1 || parseInt(Dia, 10)>31)
	{  
		//alert('Día inválido')  
		//return false  
		correct_validation = false;
	}  
	
	if (Mes==4 || Mes==6 || Mes==9 || Mes==11 || Mes==2) 
	{  
		if (Mes==2 && Dia > 28 || Dia>30) 
		{  
			//alert('Día inválido')  
			//return false  
			correct_validation = false;
		}  
	}  
    
	//para que envie los datos, quitar las  2 lineas siguientes  
	//alert("Fecha correcta.")  
	//return false    
	return correct_validation;
}  


//validación de sólo números, no se permite decimales
function validation_number(text) {
	var key = nav4 ? text.which : text.keyCode;
	return (key == 8 || key == 127 || key == 0 || key == 13 || key == 45 || (key >= 48 && key <= 57));
}

function validation_codigo(text) {
	var key = nav4 ? text.which : text.keyCode;
	return (key == 45 || key == 8 || key == 127 || key == 0 || key == 13 ||  (key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) );
}


//validación de sólo números, no se permite decimales
function validation_number_pay(text) {
	var key = nav4 ? text.which : text.keyCode;
	return (key == 8 || key == 127 || key == 0 || key == 13 ||  (key >= 48 && key <= 57));
}


//validación de números con decimales
function validation_number_decimal(text) {
	var key = nav4 ? text.which : text.keyCode;
	return (key == 8 || key == 127 || key == 46 || key == 0 || key == 13 || (key >= 48 && key <= 57));
}

//validación de formato para números telefónicos
function validation_tlf(text,str) {
	var key = nav4 ? text.which : text.keyCode;
	var cadena = (document.getElementById(str).value);
	var tecla_guion = false;
	var key1=0; 
	for (i=0;i<=cadena.length;i++) {
    	if (cadena.charAt(i)=="-")
			tecla_guion = true;
	}
	if ((document.getElementById(str).value.length >= 1) && !tecla_guion && key == 45)
		key1 = 45;
	
	return (key ==key1 || key == 8 || key == 127 || key == 0 || key == 40 || key == 41 || key == 13 || (key >= 48 && key <= 57));
}

//validación de solo texto
function validation_letra(text) {
	var key = nav4 ? text.which : text.keyCode;
	return (key == 8 || key == 127 || key == 0 || key == 13 || (key >= 97 && key <= 122) 
			|| (key >= 65 && key <= 90) || key == 32 || key == 160 || key == 181 
			|| key == 130 || key == 144 || key == 161 || key == 214 || key == 162 || key == 224
			|| key == 163 || key == 233 || key == 164 || key == 165 || key == 239 || key == 225 
			|| key == 233 || key == 237 || key == 243 || key == 250 || key == 241 || key == 209);
}

//validación de campos alfanuméricos
function validation_alphanumber(text) {
	var key = nav4 ? text.which : text.keyCode;
	return (key == 8 || key == 127 || key == 0 || key == 13 || (key >= 97 && key <= 122) || (key >= 65 && key <= 90) || (key >= 48 && key <= 57));
}

//validación de claves primarias que no acepte caracteres especiales
function validation_pkey(text) 
{
	var key = nav4 ? text.which : text.keyCode;
	return (key == 8 || key == 127 || key == 46 || key == 0 || (key >= 48 && key <= 57) 
		   || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || key == 95 || key == 45 || key == 39 
		   || key == 225 || key == 233 || key == 237 || key == 243 || key == 250 || key == 34 || key == 40
		   || key == 41 || key == 250 || key == 64 || key == 32);
}

//validación de campos alfanuméricos
function validation_null(text) {
	var key = nav4 ? text.which : text.keyCode;
	return (key == 0);
}
