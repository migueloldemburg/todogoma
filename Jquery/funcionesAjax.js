function getXMLHTTPRequest()
{
var req = false;
try
  {
    req = new XMLHttpRequest(); /* p.e. Firefox */
  }
catch(err1)
  {
  try
    {
     req = new ActiveXObject("Msxml2.XMLHTTP");
  /* algunas versiones IE */
    }
  catch(err2)
    {
    try
      {
       req = new ActiveXObject("Microsoft.XMLHTTP");
  /* algunas versiones IE */
      }
      catch(err3)
        {
         req = false;
        }
    }
  }
return req;
}
var miPeticion = getXMLHTTPRequest();

//*********************************************************************
function eliminar_id(id, url, tipo){
		var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
		var vinculo=url+"?id="+id+"&tipo="+tipo+"&rand="+mi_aleatorio;
		//alert(vinculo);
		miPeticion.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
			
               if (miPeticion.readyState==4)
               {
                       if (miPeticion.status==200)
                       {
                               var http=miPeticion.responseText;
							     if (http=='ok')
							   {
								   alert("Se ha eliminado correctamente");
   								   location.reload();

							   }else{
								   alert(http);
								}	
                       }
			   }
       }
       miPeticion.send(null);
}
/**********************************************************************/
function verificar_usuario(url, usuario, clave){
	alert('holis');
		var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
		var vinculo=url+"?usuario="+usuario+"&clave="+clave+"&rand="+mi_aleatorio;
		alert(vinculo);
		miPeticion.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
			
               if (miPeticion.readyState==4)
               {
                       if (miPeticion.status==200)
                       {
                               var http=miPeticion.responseText;
							   if (http=='1')
							   {
								   alert(http);
								   return true;
							   }else{
								   alert(http);
								   document.getElementById("wrong_id_msg").innerHTML="http";
								   return false;
								}	
                       }
			   }
       }
       miPeticion.send(null);
}
/**********************************************************************/

function cambiar_estado(url, usuario, estado){
		var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
		var vinculo=url+"?usuario="+usuario+"&estado="+estado+"&rand="+mi_aleatorio;
		//alert(vinculo);
		miPeticion.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
			
               if (miPeticion.readyState==4)
               {
                       if (miPeticion.status==200)
                       {
                               var http=miPeticion.responseText;
							   if (http=='ok')
							   {
								   if(estado=='0'){
								   		 alertify.success("Usuario "+usuario+" ha sido deshabilitado");
										 $("#datos").load("Jquery/phpAjax/cargarTablaUsuario.php");
							   		}else{
										alertify.success("Usuario "+usuario+" ha sido habilitado");
										 $("#datos").load("Jquery/phpAjax/cargarTablaUsuario.php");
									}
   								   //location.reload();
							   }else{
								    alertify.error('Lo siento, ha ocurrido un problema de BD');
									 $("#datos").load("Jquery/phpAjax/cargarTablaUsuario.php");
								}	
                       }
			   }
       }
       miPeticion.send(null);
}

/**********************************************************************/

function cargarModelo(url, id_fab){
	$("#cargarModelo").load(url+'?id_fab='+id_fab);
	$("#cargarBoton").show();
          
}

function cargarMarca(url){
	$("#boton_agregar").hide();
	$("#cargarMarca").load(url);
          
}
/**********************************************************************/

function actualizarModelo(url, redirA){
		var id_f  = document.getElementById('fabricante').value;
		var id_m = document.getElementById('modelo').value;

		if(id_m!='' && id_m!=' ')
		{
			var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
			var vinculo=url+"?id_f="+id_f+"&id_m="+id_m+"&rand="+mi_aleatorio;
			//alert(vinculo);
			miPeticion.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
			miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
				
				   if (miPeticion.readyState==4)
				   {
						   if (miPeticion.status==200)
						   {
								   var http=miPeticion.responseText;
								   if (http=='true')
								   {
									   if(redirA==''){
										location.reload();
									   }else{
										   location.href=redirA;
									   }
								   }else{
										alert('up! Ha ocurrido un problema al actualizar el modelo');
									}	
						   }
				   }
		   }
		   miPeticion.send(null);
		}else{
			alertify.warning("Verifique el modelo del carro")
		}
}

/**********************************************************************/

function relacionPiezaModelo(url, piezaId, fabricanteId, principalId, div, quitarPrincipal){
	//alert('url: '+url+'-- piezaid: '+piezaId+'-- fabricante: '+fabricanteId+'-- principal: '+principalId)
	
	if(principalId=='0')//En este procedimiento se asignan solo modelos compatibles con las piezas.
	{
		var idsChecked = '';
		var idsUnchecked = '';
		$("input:checkbox[name^='checkbox"+fabricanteId+"']").each(function(index,e){
			var $this = $(this);
			if($this.is(":checked")){
				var id = $this.attr("id");
				idsChecked += id +',';
					
			}else{
				var id2 = $this.attr("id");
				idsUnchecked += id2+',';
				
			}
		});
		//alert(idsChecked+" tienen check");
		//alert(idsUnchecked+" tienen uncheck");
	}else{
		if(principalId=='1')//En este procedimiento se asigna los modelos principales para la pieza
		{
			var idsChecked = '';
			var idsUnchecked = '';
			
			if(quitarPrincipal!='false')
			{
				idsUnchecked = document.getElementById("modelo").value;
			}else{
				idsChecked = document.getElementById("modelo").value;
			}
		}
	}
	
	var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
	var vinculo=url+"?piezaId="+piezaId+"&principalId="+principalId+"&idsChecked="+idsChecked+"&idsUnchecked="+idsUnchecked+"&rand="+mi_aleatorio;
	//alert(vinculo);
	miPeticion.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
	miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
		
		   if (miPeticion.readyState==4)
		   {
				   if (miPeticion.status==200)
				   {
						   var http=miPeticion.responseText;
						   if (http=='true')
						   {
							   if(principalId==1)
							   {
								   
							   }
							   //div = '#'+div;
							   //$(div).load('Jquery/phpAjax/cargarDivTabs.php?fabricanteId='+fabricanteId);
							   alert('Cambios registrados satisfactoriamente!');
							   location.reload();
						   }else{
								alert(http);
							}	
				   }
		   }
   }
   miPeticion.send(null);

}

/**********************************************************************/

function sumarExistencia(valorExistencia, cantNueva, id){
	var resultado = parseInt(valorExistencia)+parseInt(cantNueva);
	//alert(resultado+' '+id);
	if(cantNueva!=''){
		document.getElementById("existenciaP"+id).innerHTML = ('Existencia('+valorExistencia+') + Nuevo ingreso('+cantNueva+') = '+resultado);
	}else{
		document.getElementById("existenciaP"+id).innerHTML = ('Existencia('+valorExistencia+')');
	}
	
}
/**********************************************************************/

function comprobar(id){
	var check = document.getElementById(id).value;

	if(check=='' || check==' '){
		document.getElementById(id).style.border = '1px solid red';
	}else{
		document.getElementById(id).style.border = '1px solid #CCC';
	}
	
}
/**********************************************************************/

function comprobar2(obj){
	var stock = Number($("#curStock").val());
	var newStock = Number($("#nuevaCant").val());

	if(!isNaN(stock) && !isNaN(newStock)){
		$("#currentStockTxt").text("("+ stock +") + ("+newStock+") = " + Number(stock+newStock));
	}

	var check = $(obj).val();
	if(check=='' || check==' '){
		$(obj).style.border = '1px solid red';
	}else{
		$(obj).style.border = '1px solid #CCC';
	}
	
}
/***********************************************************************/

function buscarCliente(cedula){
	
	var url = 'Jquery/phpAjax/buscarCliente.php?ced=';
	cedula = cedula.toUpperCase();

	if(cedula!='' && cedula!=' ')
	{
		document.getElementById('cargar_cliente').innerHTML="<img src='images/loading.gif' title='cargando...' />";
		setTimeout(myFunction, 500)
		function myFunction()
		{
			$("#cargar_cliente").load(url+cedula);	
		}	
	}
}
/**********************************************************************/

function buscarPiezaxComponente(componente){
	//alert(componente);
	document.getElementById('cargar_busqueda').innerHTML="<img src='images/loading.gif' title='cargando...' />";
	setTimeout(myFunction, 500)
	function myFunction()
	{
		$("#cargar_busqueda").load("Jquery/phpAjax/buscarPiezaxComponente.php?componente="+componente);
	}	
}

/**********************************************************************/

function agregarCarrito(id, stock){

	if(stock>0)
	{
		alertify.prompt("Cantidad:", "1",
		function(evt, value ){
			value = parseInt(value);
			stock = parseInt(stock);
			
			if(value!=0 && value<=stock && value!='' && value!=' ')
			{
				cant = value;
				//Procedemos a guardar el producto en el carrito
				$('#agregar').load("Jquery/phpAjax/productoController.php?"+"pieza="+id+"&cant="+cant+"&operacion=agregar");
			}else{
				
				if(value>stock){
					alertify.error('No hay disponibilidad para '+parseInt(value)+' item(s)');
					return false;
				}

				if(value=="" && value==" " && value=='0'){
					alertify.warning('Ingrese un valor correcto');	
					return false;			
				}
			}
		},
		function(){
			
		});
		$('div.ajs-header').empty().text("Confirmar");
		$(".ajs-dialog").css("max-width", "300px");
		$(".ajs-input").addClass("form-control");

		
	}else{
		alertify.error('Item no disponible');
	}
}

/**********************************************************************/

function eliminarCarritoItem(id)
{
	alertify.confirm("Eliminar item "+id+" del carrito?", function (e) {
	    if (e) {
	        // user clicked "ok"
	        $("#tabla_carrito").load("Jquery/phpAjax/eliminarCarritoItem.php?id="+id+"&operacion=quitar");	
	    } else {
	        // user clicked "cancel"
	    }
	});
	$('div.ajs-header').empty().text("Confirmar");
	$(".ajs-dialog").css("max-width", "400px");
}

/**********************************************************************/

function sumarRestarItem(id, ope, stock)
{
		var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché...
		var vinculo="Jquery/phpAjax/sumarRestarItem.php"+"?id="+id+"&ope="+ope+"&stock="+stock+"&rand="+mi_aleatorio;
		//alert(vinculo);
		miPeticion.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function()
		{
			
			   if (miPeticion.readyState==4)
			   {
					   if (miPeticion.status==200)
					   {
							  var http=miPeticion.responseText;
							   
							   if (http!='0')
							   {
								   	//Se sumo o resto								  
									$("#cantidad"+id).empty().text(http);
									$("#tabla_carrito").load("Jquery/phpAjax/eliminarCarritoItem.php",function(){
										var subtotal = $("#subtotal").text();
									    $("#subtotal2").text(subtotal);
									    $("#subtotal3").text(subtotal);
									});	
							   }else{
									
								} 	
						 }
			   }
	   }
	   miPeticion.send(null);
}


/***********************************************************************/

function actualizarShoppingCart(count){
	$("#shoppingCart").empty().text(count);
}

