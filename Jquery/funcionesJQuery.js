$( document ).ready(function() {
    //funciones al cargar la pagina
    
    $('#mesFactura').change(function(){
		var mes =  $('#mesFactura').val();
		$("#datos1").load('Jquery/phpAjax/buscarFacturaxMes.php?mes='+mes);
	});

    $('#buscarFacturaRango').click(function(){
        var fecha1 =  $('#fecha1').val();
        var fecha2 =  $('#fecha2').val();

        if(fecha1!='' && fecha2!='')
        {
            $("#datos2").load('Jquery/phpAjax/buscarFacturaxRango.php?fecha1='+fecha1+'&fecha2='+fecha2);
        }
        return false;
    });

	//ver facturas por rango de fecha
    $( "#fecha1" ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#fecha2" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fecha2" ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#fecha1" ).datepicker( "option", "maxDate", selectedDate );
        }
    });


});
