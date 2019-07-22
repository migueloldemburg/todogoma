
	//Limpia los campos en el modal de registro de cliente
	$('#registrarCliente').on('show.bs.modal', function (event) {
	  var modal = $(this)
	  modal.find('.modal-body #cedula').val('')
	  modal.find('.modal-body #nombre').val('')
	  modal.find('.modal-body #apellido').val('')
	  modal.find('.modal-body #direccion').val('')
	  modal.find('.modal-body #telefono').val('')
	  $('.alert').hide();//Oculto alert
	})

	//Envia el formulario de registro de cliente POST
	$( "#registrarClienteSubmit" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "modals/RegistrarClienteBD.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax_register").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#datos_ajax_register").html(datos);
					
					load(1);
				  }
		});
		event.preventDefault();
	});

	//Carga el modal de registro de usuario con los valores
	$('#editarCliente').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Botón que activó el modal
	  var cedula = button.data('cedula') // Extraer la información de atributos de datos
	  var nombre = button.data('nombre') // Extraer la información de atributos de datos
	  var apellido = button.data('apellido') // Extraer la información de atributos de datos
	  var direccion = button.data('direccion') // Extraer la información de atributos de datos
	  var telefono = button.data('telefono') // Extraer la información de atributos de datos
	  
	  var modal = $(this)
	  modal.find('.modal-body #newCedula0').val(cedula)
	  modal.find('.modal-body #oldCedula0').val(cedula)
	  modal.find('.modal-body #nombre0').val(nombre)
	  modal.find('.modal-body #apellido0').val(apellido)
	  modal.find('.modal-body #direccion0').val(direccion)
	  modal.find('.modal-body #telefono0').val(telefono)
	  $('.alert').hide();//Oculto alert
	})

	//Envia el formulario de la edicion de cliente POST
	$( "#editarClienteBD" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "modals/editarClienteBD.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#datos_ajax").html(datos);
					
					load(1);
				  }
			});
		  event.preventDefault();
		});
	
	//Limpia los campos en el modal de edicion de usuario
	$('#editarUsuario').on('show.bs.modal', function (event) {
	  var modal = $(this)
	  
	  $('.alert').hide();//Oculto alert
	})

	//Envia el formulario de la edicion de usuario POST
	$("#editarUsuarioBD").submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "modals/editarUsuarioBD.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#datos_ajax").html(datos);
					alertify.alert('Informacion', 'Los cambios han sido generados.').set('onok', function(closeEvent){ 
						location.href="salir.php";
					});
				  }
			});
		  event.preventDefault();
	});

	//Limpia los campos en el modal de edicion de usuario
	$('#verFactura').on('show.bs.modal', function (event) {
	  	var button = $(event.relatedTarget) // Botón que activó el modal
		var id = button.data('codigo') // Extraer la información de atributos de datos
	  	var modal = $(this)
	  	modal.find('#cedula').val(id)

	  	$('#verFactura').load('modals/modalVerFactura.php?codigo='+id);

	  
	  $('.alert').hide();//Oculto alert
	})


	//Editar precio y cantidad de stock
	$('#modalCambiarPrecioyCantidad').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var piezaid = button.data('piezaid');
		var modal = $(this)

		modal.find('.modal-body #oem').text('');
		modal.find('.modal-body #ref').text('');
		modal.find('.modal-body #nombre').text('');
		modal.find('.modal-body #nuevoPrecio').val(0);
		modal.find('.modal-body #nuevaCant').val(0);
		modal.find('.modal-body #piezaId').val(0);
		modal.find('.modal-body #currentStock').text('');
		modal.find('.modal-body #curStock').val(0);

		$.ajax({
			type: "POST",
			url: "modals/cargarPieza.php",
			data: {id: piezaid},
			dataType: "JSON",
			beforeSend: function(){

			},
			success: function(data){
				if(!data.error){
					var pieza = data.pieza;
					modal.find('.modal-body #oem').text(pieza.oem);
					modal.find('.modal-body #ref').text(pieza.ref);
					modal.find('.modal-body #nombre').text(pieza.nombre);
					modal.find('.modal-body #nuevoPrecio').val(pieza.precio);
					modal.find('.modal-body #nuevaCant').val(0);
					modal.find('.modal-body #piezaId').val(pieza.id);
					modal.find('.modal-body #currentStockTxt').text("("+pieza.cant+")");
					modal.find('.modal-body #curStock').val(pieza.cant);
				}
			}
		});

		$('.alert').hide();//Oculto alert
	});

	$("#modalCambiarPrecioyCantidadBD").submit(function( event ) {
		var parametros = $(this).serialize();
		$.ajax({
				type: "POST",
				url: "Jquery/phpAjax/modificarStock.php",
				data: parametros,
				dataType: "JSON",
				beforeSend: function(objeto){
					
				},
				success: function(datos){

					if(!datos.error){
						alertify.success(datos.msg);
						$("#modalCambiarPrecioyCantidad").modal("hide");
						$("#tr_" + datos.id).find("input[name=precio]").val(datos.precio);
						$("#tr_" + datos.id).find("input[name=cantidad]").val(datos.cantidad);
						
						//red borders on low stock
						if(parseInt(datos.cantidad) <= 10){
							$("#tr_" + datos.id).find("input[name=cantidad]").css("border", "2px solid red");
						}else{
							$("#tr_" + datos.id).find("input[name=cantidad]").css("border", "1px solid rgb(204, 204, 204)");
						}

						if(parseInt(datos.cantidad) <= 0){
							$("#tr_" + datos.id).find("input[name=precio]").css("border", "2px solid red");
						}else{
							$("#tr_" + datos.id).find("input[name=precio]").css("border", "1px solid rgb(204, 204, 204)");
						}
					}else{
						alertify.error(datos.msg);
					}
			    }
		});
	  	event.preventDefault();
	});



	$('#dataDelete').on('show.bs.modal', function (event) {
	 	var button = $(event.relatedTarget) // Botón que activó el modal
		var id = button.data('id') // Extraer la información de atributos de datos
	  	var modal = $(this)
	  	modal.find('#id_pais').val(id)
	})
		
	$( "#eliminarDatos" ).submit(function( event ) {
	var parametros = $(this).serialize();
		 $.ajax({
				type: "POST",
				url: "modals/eliminar.php",
				data: parametros,
				 beforeSend: function(objeto){
					$(".datos_ajax_delete").html("Mensaje: Cargando...");
				  },
				success: function(datos){
				$(".datos_ajax_delete").html(datos);
				
				$('#dataDelete').modal('hide');
				load(1);
			  }
		});
	  event.preventDefault();
	});
