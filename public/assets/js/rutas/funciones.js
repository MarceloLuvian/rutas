function datos(rep, r){
			// alert(rep);
			// text = rep.replace(",", " ");
			// $('#rep').text("");
			// $('#rep').text(text);
			res = rep.split(",");
			nombre = "";
			for (var i = 0; i < res.length; i++) {
				nombre = nombre + res[i]+" ";
			}
			$('#rep').text(nombre);
			$('#nru').text(r);

		}

		function limpiar(){
			$('#responsable').val("");
			$('#appp').val("");
			$('#apmm').val("");
		}

		function limpiar2(){
			
			$('#localidad').val("");
			$('#distancia').val("");
			$('#via').val("");
			$('#medio').val("");
			$('#tiempo').val("");
			$('#tipoveiculo').val("");
			$('#nplacas').val("");
			$('#cantidadVe').val(0);
			$('#costo').val("");
			$('#electores').val("");
			$('#meta').val("");
		}

		function cargarR(id){
			var ruta = "../public/cargarResponsable/"+id;			

			$.get(ruta, function (resultado) {	

				$("#edresponsable").text(resultado.nombre);
				$("#idResponsable").val(resultado.id);

				
				

			});
		}
		function recargarRutas(seccion){

			var ruta = "../public/rutas/"+seccion;
			$.get(ruta, function (resultado) {
				$("#data").empty();
				$.each(resultado, function(index,subCatObj){
					nombre = subCatObj.nombre;
					nombres = nombre.split(" ");
					r = subCatObj.numruta;
						// alert(nombre);
						cadena = "<tr> <td> "+subCatObj.seccion+"</td> <td>"+subCatObj.numruta+" </td> <td>"+nombre+" </td>  <td> <button type='button' onClick=cargarDatos();datos(";
						cadena2 = ");cargarDatos(); class='btn btn-default' class='btn btn-primary' data-toggle='modal' data-target='#myModal' > <span class='glyphicon glyphicon-road'></span></button><button class='btn btn-success' data-toggle='modal'  onClick='cargarR("+subCatObj.id+")' data-target='#editarResponsable' '> <span class='glyphicon glyphicon-pencil'> </span> </button> </td></tr>";
						nombresFinal = "";
						for (var i = 0; i < nombres.length; i++) {
							nombresFinal = nombresFinal+ nombres[i];
						}
						cadenaFinal = cadena+"'"+nombres+"',"+r +cadena2;

						$('#data').append(cadenaFinal);

					});

			});
		}
		function editarR(){
			if (confirm("¿ESTA SEGURO DE REALIZAR EL CAMBIO DE RESPONSABLE?")) {
				var nom =	$("#re").val();
				var app=	$("#ap").val();
				var apm=	$("#am").val();
				if (nom.length < 4 || app.length < 4 || apm.length < 4) {
					alert("ES NECESARIO EL NOMBRE, APELLIDO PATERNO Y MATERNO PARA EL CAMBIO DE REPRESENTANTE");
				}else{
					var id=	$("#idResponsable").val();
				var nombre =  nom+" "+app+" "+apm;				
				var seccion = $('#seccion').val();

				var ruta = "../public/editarResponsable/"+id+"/"+nombre;			

				$.get(ruta, function (resultado) {	

					$('#editarResponsable').modal('hide');
					recargarRutas(seccion);
					var nom =	$("#re").val("");
					var app=	$("#ap").val("");
					var apm=	$("#am").val("");

				});
				}
				
			}
			
		}

		function limpiar4(){
			
			$('#localida').val("");
			$('#distanci').val("");
			$('#vi').val("");
			$('#medi').val("");
			$('#tiemp').val("");
			$('#tipoveicul').val("");
			$('#nplaca').val("");
			$('#cantidadV').val(0);
			$('#cost').val("");
			$('#electore').val("");
			$('#met').val("");
		}

		function editar(id){
			var ruta = "../public/editarRuta/"+id ;
			$.get(ruta, function (resultado) {


				$("#localida").val(resultado.localidad);
				$("#identificador").val(resultado.id);
				$("#distanci").val(resultado.distancia);
				$("#vi").val(resultado.via);
				$("#medi").val(resultado.medio_transporte);
				$("#tiemp").val(resultado.tiempo_aprox);
				$("#tipoveicul").val(resultado.vehiculo);
				$("#nplaca").val(resultado.placas);
				$("#cantidadV").val(resultado.cantVehiculo);
				$("#cost").val(resultado.costo);
				$("#electore").val(resultado.electores);
				$("#met").val(resultado.meta);


				

			});
		}

		function Eliminar(id){
			if (confirm("¿ESTA SEGURO QUE DESEA ELIMINAR ESTE REGISTRO?")) {
				var ruta = "../public/eliminarRuta/"+id ;
				$.get(ruta, function (resultado) {

					if(resultado == 1){
						cargarDatos();
						alert("REGISTRO BORRADO CORRECTAMENTE");
					}else{
						alert("FAVOR DE ELIMINAR INFORMACIÓN DEL LISTADO ANTES DE BORRAR ESTE REGISTRO  ");
					}
				});
			}
			
		}



		function cargarDatos(){ 
			var seccion = $("#seccion").val();
			var rutaseleccionada =  $('#nru').text();
			
			var ruta = "../public/cargarTabla/"+seccion+"/"+rutaseleccionada;
			
			

			$.get(ruta, function (resultado) {	

				$("#data2").empty();

				if (resultado == 0) {

					$('#data2').append('<tr> <td> VACIO </td>  </tr>');


				}else{
					$.each(resultado, function(index,subCatObj){

						$('#data2').append('<tr> <td> '+subCatObj.localidad+' </td> <td> '+subCatObj.distancia+' </td> <td> '+subCatObj.via+' </td> <td> '+subCatObj.medio_transporte+' </td> <td> '+subCatObj.tiempo_aprox+' </td> <td> '+subCatObj.vehiculo +' </td>  <td> '+subCatObj.placas +' </td> <td> '+subCatObj.cantVehiculo+' </td>  <td> '+subCatObj.costo+' </td> <td> '+subCatObj.electores+' </td> <td> '+subCatObj.meta+' </td> <td><button class="btn btn-default class="btn btn-primary btn-lg" data-toggle="modal"  onclick="editar('+subCatObj.id+')" data-target="#MODALEDIT" "> <span class="glyphicon glyphicon-pencil"> </span> </button> <button class="btn btn-danger" onClick="Eliminar('+subCatObj.id+')"> <span class="glyphicon glyphicon-remove-circle"></span> </button>  </td>  </tr>');

					});
				}
				

			});

		}



		$(document).ready(function(){


			$('#editarRuta').click(function(){
				var id = $("#identificador").val();
				var localida =  $("#localida").val();
				var dis =	$("#distanci").val();
				var vi =	$("#vi").val();
				var medio =	$("#medi").val();
				var tiempo =		$("#tiemp").val();
				var vehiculo=		$("#tipoveicul").val();
				var placas =	$("#nplaca").val();
				var cantidadV =	$("#cantidadV").val();
				var costo =	$("#cost").val();
				var electores =	$("#electore").val();
				var meta =	$("#met").val();

				var ruta = "../public/editarRuta/"+id+"/"+localida+"/"+dis+"/"+vi+"/"+medio+"/"+tiempo+"/"+vehiculo+"/"+placas+"/"+cantidadV+"/"+costo+"/"+electores+"/"+meta;
				$.get(ruta, function (resultado) {
					if (resultado == 1) {
						alert("DATOS GUARDADOS CORRECTAMENTE");
						$('#MODALEDIT').modal('hide');
						limpiar4();
						cargarDatos();
					}else{
						alert("OPSS!! HUBO UN PROBLEMA AL GUARDAR SUS DATOS, COMPRUEBE QUE NINGUN CAMPO ESTÉ VACIO");
					}

				});
			});




			$("#seccion").change(function () {
				var seccion = $("#seccion").val();

				if (seccion == 0) {
					alert("DEBE SELECCIONAR UNA SECCION");
				}else{
					var municipio = document.getElementById ('municipio').value;
					var ruta = "../public/rutas/"+seccion;



					$.get(ruta, function (resultado) {
						$("#data").empty();
						$("#data2").empty();
						$.each(resultado, function(index,subCatObj){
							nombre = subCatObj.nombre;
							nombres = nombre.split(" ");
							r = subCatObj.numruta;
						// alert(nombre);
						cadena = "<tr> <td> "+subCatObj.seccion+"</td> <td>"+subCatObj.numruta+" </td> <td>"+nombre+" </td>  <td> <button type='button' onClick=datos(";
						cadena2 = ");cargarDatos(); class='btn btn-default' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal' > <span class='glyphicon glyphicon-road'></span></button> <button class='btn btn-success' data-toggle='modal'  onClick='cargarR("+subCatObj.id+")' data-target='#editarResponsable' '> <span class='glyphicon glyphicon-pencil'> </span> </button> </td></tr>";
						nombresFinal = "";
						for (var i = 0; i < nombres.length; i++) {
							nombresFinal = nombresFinal+ nombres[i];
						}
						cadenaFinal = cadena+"'"+nombres+"',"+r +cadena2;

						$('#data').append(cadenaFinal);

					});

					});
				}


			});

			
			

			

			$('#guardar').click(function(){

				var nom = $('#responsable').val();
				var app = $('#appp').val();
				var apm = $('#apmm').val();
				nombre = nom + " "+app+ " "+ apm;
				nombre = nombre.toUpperCase();
				$longitud = nombre.length;
				seccion = $('#seccion').val();
				
				if (seccion <= 0) {
					alert("DEBE SELECCIONAR UNA SECCION PARA REGISTRAR UN REPRESENTANTE");
				}else if (nombre < 10) {
					alert("INGRESE EL NOMBRE DEL REPRESENTANTE DE RUTA PARA CONTINUAR");
				}
				else
				{
					if (confirm("¿ESTA SEGURO QUE DESEA AGREGAR A: "+nombre +" "+ "COMO RESPONSABLE?")) {
						var seccion = $('#seccion').val();
						var muni = document.getElementById('municipio')[document.getElementById('municipio').selectedIndex].text;



						var ruta = "../public/guardarResponsable/"+nombre+"/"+seccion+"/"+muni;


						$.get(ruta, function (resultado) {
							if (resultado == 1) {
								recargarRutas(seccion);
								limpiar();
							}

						});
					}else{
						limpiar();
					}
				}
				
				
			})	;



			$('#guardarruta').click(function(){

				ruta = $('#nru').text();
				seccion = $("#seccion").val();
				responsable = $('#rep').text();
				id_municipio = $("#municipio").val();
				cantidadvei =	$('#cantidadVe').val();
				
				localidadd =	$('#localidad').val();
				distanciaa =	$('#distancia').val();
				viass =	$('#via').val();
				medios =	$('#medio').val();
				tiempos =	$('#tiempo').val();
				tipos =	$('#tipoveiculo').val();
				nplacass = 	$('#nplacas').val();
				costos =	$('#costo').val();
				electoress =	$('#electores').val();
				metas =	$('#meta').val();


				if (localidadd == "" || distanciaa == "" || viass == "" || medios == "" || tiempos == "" || tipos == "" || nplacass == "" || costos == "" || electoress == "" || metas == "") { 
					alert("TODOS LOS CAMPOS SON NECESARIOS PARA CONTINUAR");
				}else if(cantidadvei <= 0){
					alert("LA CANTIDAD DE VEHÍCULOS DEBE SER MAYOR A 0");
				}else{
					var parametros = {
						'cantidad' : $('#cantidadVe').val(),
						'id_municipio' : id_municipio,
						'seccion' : seccion,
						'municipiog' :	$('#municipiog').val(),
						'responsable' : responsable,
						'ruta' : ruta,
						'localidad': $('#localidad').val(),
						'distancia':	$('#distancia').val(),
						'via':	$('#via').val(),
						'medio':	$('#medio').val(),
						'tiempo':	$('#tiempo').val(),
						'tipoveiculo':	$('#tipoveiculo').val(),
						'nplacas':	$('#nplacas').val(),
						'costo':	$('#costo').val(),
						'electores':	$('#electores').val(),
						'meta':	$('#meta').val()
					};



					var route = "../public/guardarruta2/1";
					var token = $("#token").val();

					$.ajax({
						url: route,
						headers: {'X-CSRF-TOKEN':token},
						type: 'PUT',
						dataType: 'json',
						processData: true,
						data: parametros,

						success:function(respuesta){
							if (respuesta == 1) {
								if (confirm("REGISTRO EXITOSO, ¿DESEA AGREGAR MAS LOCALIDADES A ESTA RUTA?") ) {
									cargarDatos();
									limpiar2();
								}{
									limpiar2();
								}
							}


						}

					});
				}

				

			})	;




			$("#municipio").change(function () {
				var municipio = $("#municipio").val();
				var ruta = "../public/secciones/"+municipio;
				var muni = document.getElementById('municipio')[document.getElementById('municipio').selectedIndex].text;
				$('#municipiog').val(muni);


				$("#seccion").empty();
				$("#data2").empty();
				$.get(ruta, function (resultado) {
					$("#seccion").empty();
					$('#seccion').append('<option value="0">SELECCIONE UNA SECCION </option>');
					$.each(resultado, function(index,subCatObj){

						$('#seccion').append('<option value="'+subCatObj.seccion+'">'+subCatObj.seccion+' </option>');

					});

				});

			});


		});

