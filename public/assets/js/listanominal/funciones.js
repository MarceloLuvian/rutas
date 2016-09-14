	function seleccionarRuta(idruta){
		$("#ruta").val(idruta);
		// document.getElementById ('ruta').value = idruta;
		
	}
	function comprobarrutas(seccion, rut){
		var resul = 0;
		var ruta = "../public/comprobarrutas/"+seccion+"/"+rut;
		
		$.get(ruta, function (resultado) {
			resul = resultado;
			
			return resul;

			});
	}

	function eliminarNominal(id){
		var ruta = "../public/eliminarNominal/"+id;
		if (confirm("¿ESTA SEGURO DE ELIMINAR ESTE REGISTRO?")) {
			$.get(ruta, function (resultado) {
					
				cargarNominal();
			});
		}
		
	}


	function cargarNominal(){
		var rutag = $('#ruta').val();
		var seccion = $('#seccion').val();
		var ruta = "../public/cargarNominal/"+rutag+"/"+seccion;
		
		$.get(ruta, function (resultado) {
		if (resultado == 2) {
			$("#datanominal").empty();
			$('#datanominal').append('<tr> <td> SIN LISTADO DE PERSONAS </td>  </tr>');
		}else{
			$("#datanominal").empty();
				$.each(resultado, function(index,subCatObj){

					$('#datanominal').append('<tr> <td> '+subCatObj.nombre+" "+subCatObj.apellidop+" "+subCatObj.apellidom+' </td> <td> '+subCatObj.clave_elector+' </td> <td> '+subCatObj.domicilio+' </td> <td> '+subCatObj.telefono+' </td> <td> '+subCatObj.telefono2+' </td> <td> '+subCatObj.telefono3+' </td> <td> '+subCatObj.descripcion+' </td><td> <button class="btn btn-danger" onclick="eliminarNominal('+subCatObj.ID+')"> <span class="glyphicon glyphicon-remove-circle"></span></button> </td> </tr>');

				});
		}
				

			});
	}

	function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46-'-´";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    function soloNumeros(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "0123456789";
       especiales = "'´+-áéíóúabcdefghijklmnñopqrstuvwxyz";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    
	function limpiar(){

		$('#nombre').val("");

		$('#apellidop').val("");

		$('#apellidom').val("");

		$('#calle').val("");		

		$('#telefonocel').val("");

		$('#telefonocasa').val("");

		$('#otro').val("");

		$('#referencia').val("");

		$('#nombre2').val("");

		$('#apellidop2').val("");

		$('#apellidom2').val("");

		$('#calle2').val("");
		
		$('#telefonocel2').val("");

		$('#telefonocasa2').val("");

		$('#otro2').val("");

		$('#referencia2').val("");

		$('#ruta2').val("");
	}
	


	function ocultar(){
		$('#contenido').hide();
		$('#contenido2').hide();
		$('#guardar2').hide();
		$('#guardar').hide();
	}
	function mostrar(){
		$('#contenido').show();
		$('#guardar').show();

	}
	function mostrar2(){
		$('#contenido').hide();
		$('#contenido2').show();
		$('#guardar').hide();
		$('#guardar2').show();
	}

	function funcionDemo(){
		var seccion = $("#seccion").val();


		var parametros = {
			'seccion' : seccion,
			'clave_elector' : $('#clave_elector').val(), 
			'nombre' : $('#nombre').val(),
			'apellidop' : $('#apellidop').val(),
			'apellidom' : $('#apellidom').val(),
			'calle' : $('#calle').val(),
			
			'telefonocel' : $('#telefonocel').val(),
			'telefonocasa' : $('#telefonocasa').val(),
			'otro' : $('#otro').val(),
			'referencia' : $('#referencia').val(),
			'ruta' : $('#ruta').val()
		};


		var route = "../public/guardarnominal2/1";
		var token = $("#token").val();

		$.ajax({
			url: route,
			headers: {'X-CSRF-TOKEN':token},
			type: 'PUT',
			dataType: 'json',
			processData: true,
			data: parametros,

			success:function(respuesta){

				if (respuesta == 0) {
					alert("ESTA PERSONA YA SE ENCUENTRA REGISTRADA EN LA BASE DE DATOS");
					ocultar();	
					limpiar();
				}else{
					alert("DATOS GUARDADOS CORRECTAMENTE");
					ocultar();
					limpiar();
					cargarNominal();
				}
				
			}

		});

	}

	function funcionDemo2(){
		var seccion = $("#seccion").val();
		var ruta = $('#ruta').val();
		if ( $('#clave_elector').val() == "" ) {
			alert("POR FAVOR ESCRIBA LA CLAVE DE ELECTOR");
		// }else if(comprobarrutas(seccion, ruta) == 0){
			// alert("PARA AGREGAR AL LISTADO NOMINAL, PRIMERAMENTE DEBE AGREGAR LA DESCRIPCION DE SUS RUTAS");
		}else{
			var seccion = $("#seccion").val();
			var parametros = {
				'seccion' : seccion,
				'clave_elector' : $('#clave_elector').val(), 
				'nombre' : $('#nombre2').val(),
				'apellidop' : $('#apellidop2').val(),
				'apellidom' : $('#apellidom2').val(),
				'calle' : $('#calle2').val(),
				
				'telefonocel' : $('#telefonocel2').val(),
				'telefonocasa' : $('#telefonocasa2').val(),
				'otro' : $('#otro2').val(),
				'referencia' : $('#referencia2').val(),
				'ruta' : $('#ruta').val()
			};


			var route = "../public/guardarnominal2/1";
			var token = $("#token").val();

			$.ajax({
				url: route,
				headers: {'X-CSRF-TOKEN':token},
				type: 'PUT',
				dataType: 'json',
				processData: true,
				data: parametros,

				success:function(respuesta){

					if (respuesta == 0) {
						alert("ESTA PERSONA YA SE ENCUENTRA REGISTRADA EN LA BASE DE DATOS");
						ocultar();	
						limpiar();
					}else{
						alert("DATOS GUARDADOS CORRECTAMENTE");
						ocultar();	
						$('clave_elector').val("");
						limpiar();
						cargarNominal();
					}

				}

			});
		}
		

	}

 function nominalMunicipal(municipio){
	var ruta = "../public/nominalMunicipal/"+municipio;
$("#nominalmunicipal").text("Cargando...");	
$.get(ruta, function (resultado) {
				
			$("#nominalmunicipal").text(resultado);	

			});
}

	$(document).ready(function(){

		// ocultar();
		
			
	 

		$("#municipio").change(function () {
			var municipio = $("#municipio").val();
			var ruta = "../public/secciones/"+municipio;
			nominalMunicipal(municipio);

			$("#seccion").empty();
			$.get(ruta, function (resultado) {
				$('#seccion').append('<option value="0">SELECCIONE UNA SECCION </option>');
				$.each(resultado, function(index,subCatObj){

					$('#seccion').append('<option value="'+subCatObj.seccion+'">'+subCatObj.seccion+' </option>');

				});

			});

		});

		$("#seccion").change(function () {
			var seccion = $("#seccion").val();
			$('#seccion2').val(seccion);
			$("#datanominal").empty();
			var municipio = $('#municipio').val();
			
			var ruta = "../public/rutas/"+seccion;
			var	resul = "";
			

			$.get(ruta, function (resultado) {
				
				$("#data").empty();
				$.each(resultado, function(index,subCatObj){

					$('#data').append('<tr> <td> '+subCatObj.seccion+' </td> <td> '+subCatObj.numruta+' </td> <td> '+subCatObj.nombre+' </td>  <td> <button type="button" class="btn btn-default" onclick="seleccionarRuta('+subCatObj.numruta+' );cargarNominal()"><span class="glyphicon glyphicon-hand-up"></span></button> </td> </tr>');

				});

			});

		});




		$("#buscarnominal").click(function () {
			
			var clave_elector = $("#clave_elector").val();
			var seccion2 = $("#seccion2").val();
			var seccion = $("#seccion").val();
			var rutag = $("#ruta").val();
			// omprobacion
			
			
			var ruta = "../public/buscarnominal/"+clave_elector+"/"+seccion2+"/"+rutag;
			if (seccion <= 0) {
				alert("DEBE SELECCIONAR UNA SECCION PARA PODER CONTINUAR");
			}else if (clave_elector == "") {
				alert("DEBE PROPORCIONAR UNA CLAVE DE ELECTOR");
			}else if (rutag == "") {
				alert("DEBE SELECCIONAR LA RUTA");
			}else{


				$.get(ruta, function (resultado) {
					if (resultado == 4) {
						alert("PARA AGREGAR AL LISTADO NOMINAL, PRIMERAMENTE DEBE AGREGAR LA DESCRIPCIÓN DE SUS RUTAS.");
					}else{
						if (resultado == 0) {
						if (confirm("LA PERSONA CON CLAVE DE ELECTOR: "+ clave_elector +" "+"NO SE ENCUENTRA. ¿DESEA AGREGARLA MANUALMENTE?")) {
							
							mostrar2();
						}else{
							ocultar();
							limpiar();

						}
					}else{
						ocultar();
						mostrar();

						$("#nombre").val(resultado[0].nombre);
						$("#apellidop").val(resultado[0].app);
						$("#apellidom").val(resultado[0].apm);
						$("#calle").val(resultado[0].calle + " "+resultado[0].numeroInterior+ " "+resultado[0].numeroExterior+ " "+resultado[0].colonia+" "+ resultado[0].cp );
						
					}
					}

					


				});

			}

		});

		$("#guardar").click(function(){
			telefonocel = $("#telefonocel").val();
			telefonocasa = $("#telefonocasa").val();
			otro = $("#otro").val();
			referencia = $("#referencia").val();
			seccion = $("#seccion").val();
			var seccion = $("#seccion").val();
			 ruta = $("#ruta").val();
			
			if (confirm("¿ESTA SEGURO QUE DESEA CONTINUAR? RECUERDE REVISAR BIEN LOS DATOS PROPORCIONADOS.") ) {

				if (seccion == 0) {
					alert("DEBE SELECCIONAR UNA SECCION PARA CONTINUAR");
					
				}else
				{
					if (  (telefonocasa.length < 10 ) && (telefonocel.length < 10) && (otro.length < 10) ) {
						alert("DEBE PROPORCIONAR AL MENOS UN NUMERO DE TELEFONO, 10 DIGITOS (INCLUYENDO LADA)");



					}else if (otro != "") 
					{
						if (otro.length == 10) {
							if(referencia == ""){
							alert("DEBE PROPORCIONAR UNA REFERENCIA EJEMPLO (CASETA TELEFONICA, CASA DE VECINO, ETC...)");
							
						}else{
							
									funcionDemo2();
							
						}
						}else{
							alert("EL NUMERO DE TELEFONO PROPORCIONADO DEBE TENER 10 DIGITOS (INCLUYENDO LADA)");
						}
						
					}else{
						
						// if (comprobarrutas(seccion, ruta) >= 0) {
									funcionDemo();
							// }else{
							// 	alert("DEBE AGREGAR EL DETALLE DE LA RUTA PARA PODER AGREGAR PERSONAS AL LISTADO");
							// }
					}

				}
			}
		});

		function validar(){
		nombre =	$('#nombre2').val();

		app =	$('#apellidop2').val();

		apm =	$('#apellidom2').val();

		dire =	$('#calle2').val();
		if (nombre == "" || app == "" || apm =="" || dire == "") {
			return 0;
		}
		}

		$("#guardar2").click(function(){
			telefonocel = $("#telefonocel2").val();
			telefonocasa = $("#telefonocasa2").val();
			otro = $("#otro2").val();
			referencia = $("#referencia2").val();
			seccion = $("#seccion2").val();
			 ruta = $("#ruta").val();
			if (validar() == 0) {
					alert("EL NOMBRE, APELLIDO PATERNO, APELLIDO MATERNO Y DIRECCION SON NECESARIOS PARA CONTINUAR");
			}else if (confirm("¿ESTA SEGURO QUE DESEA CONTINUAR? RECUERDE REVISAR BIEN LOS DATOS PROPORCIONADOS.") ) {

				if (seccion == 0) {
					alert("DEBE SELECCIONAR UNA SECCION PARA CONTINUAR");
					
				}else
				{
					if (  (telefonocasa.length < 10) && (telefonocel.length < 10) && (otro.length < 10) ) {
						alert("DEBE PROPORCIONAR AL MENOS UN NUMERO DE TELEFONO, 10 DIGITOS (INCLUYENDO LADA)");



					}else if (otro != "") 
					{
						if (otro.length == 10) {
							if(referencia == ""){
							alert("DEBE PROPORCIONAR UNA REFERENCIA EJEMPLO (CASETA TELEFONICA, CASA DE VECINO, ETC...)");
							
						}else{
							// if (comprobarrutas(seccion, ruta) >= 0) {
									funcionDemo2();
							// }else{
								// alert("DEBE AGREGAR EL DETALLE DE LA RUTA PARA PODER AGREGAR PERSONAS AL LISTADO");
							// }
							
						}
						}else{
							alert("EL NUMERO DE TELEFONO PROPORCIONADO DEBE TENER 10 DIGITOS (INCLUYENDO LADA)");
						}
						
					}else{
						// if (comprobarrutas(seccion, ruta) >= 0) {
									funcionDemo2();
							// }else{
							// 	alert("DEBE AGREGAR EL DETALLE DE LA RUTA PARA PODER AGREGAR PERSONAS AL LISTADO");
							// }
					}

				}
			}
		});
		

	});

	

