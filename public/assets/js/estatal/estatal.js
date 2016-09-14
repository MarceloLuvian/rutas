
function cargarF4(distrito){
	var ruta = "../public/reportef4get/"+distrito;


			$("#data2").empty();
			$.get(ruta, function (resultado) {
				i=1;
				$.each(resultado, function(index,subCatObj){
					// alert(subCatObj.DISTRITO);
					avance = subCatObj.AVANCE_NOMINAL;
					meta = subCatObj.META;
					// alert(avance+" "+meta);
					porcentaje = 0;
					if(avance>0 && meta>0){
						porcentaje =  (( avance / meta )*100);
					}
					$('#data2').append('<tr> <td> '+subCatObj.DISTRITO+' </td> <td> '+subCatObj.MUNICIPIOS+' </td> <td> '+subCatObj.SECCIONES+' </td> <td> '+subCatObj.RUTA+' </td> <td> '+subCatObj.LOCALIDADES+' </td> <td> '+subCatObj.VEHICULOS+' </td> <td> $'+subCatObj.COSTO+' </td><td> '+subCatObj.ELECTORES+' </td> <td> '+meta+' </td><td> '+porcentaje.toFixed(2)+' % </td><td> '+avance+'</td></tr>');

				});


			});
}



$(document).ready(function(){
$('#containeraux').hide();

	$("#distritos").change(function () {
			var distrito = $("#distritos").val();
			$('#containeraux').show();
			$('#contenerdorbueno').hide();
			$('#distrito').val(distrito);
			var ruta = "../public/municipios/"+distrito;
			cargarF4(distrito);

		

		});
	});