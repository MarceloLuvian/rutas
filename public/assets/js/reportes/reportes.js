function seleccionarRuta(idruta){
		$("#ruta").val(idruta);
		// document.getElementById ('ruta').value = idruta;
		
	}

	function seleccionarRuta2(idruta){
		$("#ruta2").val(idruta);
		// document.getElementById ('ruta').value = idruta;
		
	}
	$(document).ready(function(){
		

		$( "#formularioLista" ).submit(function( event ) 
		{	
			ruta = $('#ruta').val();
			seccion = $("#seccion").val();

			if (ruta == "") {
				alert("DEBE SELECCIONAR UNA RUTA PARA CONTINUAR");
					event.preventDefault();	
			}
			
		
		
			
		
			

		});

	$("#seccion").change(function () {
			var seccion = $("#seccion").val();
			var municipio = $('#municipio').val();
			
			var ruta = "../public/rutas/"+seccion;
			var	resul = "";
			

			$.get(ruta, function (resultado) {
				
				$("#data").empty();
				$.each(resultado, function(index,subCatObj){

					$('#data').append('<tr> <td> '+subCatObj.numruta+' </td> <td> '+subCatObj.nombre+' </td> <td> '+subCatObj.seccion+' </td> <td> <button type="button" class="btn btn-default" onclick="seleccionarRuta('+subCatObj.numruta+' )"><span class="glyphicon glyphicon-hand-up"></span></button> </td> </tr>');

				});

			});

		});


	  $("#municipio").change(function () {
    var municipio = $("#municipio").val();
    var ruta = "../public/secciones/"+municipio;
   

 $("#seccion").empty();
    $.get(ruta, function (resultado) {
      $("#seccion").empty();
       $('#seccion').append('<option value="0">SELECCIONE UNA SECCION </option>');
      $.each(resultado, function(index,subCatObj){

        $('#seccion').append('<option value="'+subCatObj.seccion+'">'+subCatObj.seccion+' </option>');

      });

    });

  });


// PARA EL REPORTE F1

	$( "#formularioLista2" ).submit(function( event ) 
		{	
			ruta = $('#ruta2').val();
			seccion = $("#seccion2").val();

			if (ruta == "") {
				alert("DEBE SELECCIONAR UNA RUTA PARA CONTINUAR");
					event.preventDefault();	
			}
		});

	$("#formulario3").submit(function( event ) 
		{	
			
			municipio = $("#municipio3").val();
			
			if (municipio == 0) {
				alert("DEBE SELECCIONAR UNA MUNICIPIO PARA CONTINUAR");
			event.preventDefault();	
			}
		});



$("#seccion2").change(function () {
			var seccion = $("#seccion2").val();
			var municipio = $('#municipio2').val();
			
			var ruta = "../public/rutas/"+seccion;
			var	resul = "";
			

			$.get(ruta, function (resultado) {
				
				$("#data2").empty();
				$.each(resultado, function(index,subCatObj){

					$('#data2').append('<tr> <td> '+subCatObj.numruta+' </td> <td> '+subCatObj.nombre+' </td> <td> '+subCatObj.seccion+' </td> <td> <button type="button" class="btn btn-default" onclick="seleccionarRuta2('+subCatObj.numruta+' )"><span class="glyphicon glyphicon-hand-up"></span></button> </td> </tr>');

				});

			});

		});

  $("#municipio2").change(function () {
    var municipio = $("#municipio2").val();
    var ruta = "../public/secciones/"+municipio;
   

 $("#seccion2").empty();
    $.get(ruta, function (resultado) {
      $("#seccion2").empty();
       $('#seccion2').append('<option value="0">SELECCIONE UNA SECCION </option>');
      $.each(resultado, function(index,subCatObj){

        $('#seccion2').append('<option value="'+subCatObj.seccion+'">'+subCatObj.seccion+' </option>');

      });

    });

  });


	  });