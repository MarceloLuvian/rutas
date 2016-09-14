
function cargarF4(distrito){
	var ruta = "../public/reportef4get2/"+distrito;


			$("#data").empty();
			$.get(ruta, function (resultado) {
				i=1;
				$.each(resultado, function(index,subCatObj){
					// alert(subCatObj.DISTRITO);
					avance = subCatObj.AVANCE_NOMINAL;
					meta = subCatObj.META;
					porcentaje = 0;
					if(avance>0 && meta>0){
						porcentaje =  (( avance / meta )*100);
					}
					$('#data').append('<tr> <td> '+subCatObj.DISTRITO+' </td> <td> '+subCatObj.MUNICIPIOS+' </td> <td> '+subCatObj.SECCIONES+' </td> <td> '+subCatObj.RUTA+' </td> <td> '+subCatObj.LOCALIDADES+' </td> <td> '+subCatObj.VEHICULOS+' </td> <td> $'+subCatObj.COSTO+' </td><td> '+subCatObj.ELECTORES+' </td> <td> '+meta+' </td><td> '+porcentaje.toFixed(2)+' % </td><td> '+avance+'</td></tr>');

				});


			});
}

$(document).ready(function(){


	$("#distritos").change(function () {
			var distrito = $("#distritos").val();
			$('#distrito').val(distrito);
			var ruta = "../public/municipios/"+distrito;
			cargarF4(distrito);

		

		});
	});