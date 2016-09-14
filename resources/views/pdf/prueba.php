<?php
require_once("assets/dompdf/dompdf_config.inc.php");
$codigohtml ='
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" href="assets/css/estilos.css">	
	<title></title>
</head>
<body>
	
	
	';
	

	$dis= $distrito;


$codigohtml.="
<div>

	<strong> DISTRITO:</strong>  $dis</span>
	<strong> CABECERA:</strong>   <span>$cabecera</span>
</div>
<br>
<div>
	

	<table class='table' border='1'>
		
			<tr>
				<th>MUNICIPIO</th>
				<th>SECCIÓN (ES)</th>
				<th>RUTA (S)</th>
				<th>LOCALIDAD (ES)</th>
				<th>VEHÍCULOS</th>
				<th>PLACAS</th>
				<th> COSTO ($) </th>
				<th>ELECTORES</th>
				<th>META</th>
			</tr>

		";
$codigohtml.="";

foreach ($rutas as $ruta) {
	$codigohtml.="<tr>
				<td>{$ruta->municipio}</td>
				<td>{$ruta->seccion}</td>
				<td>{$ruta->numruta}°</td>
				<td>{$ruta->localidad}</td>
				<td>{$ruta->vehiculo}</td>
				<td> {$ruta->placas} </td>
				<td>$ {$ruta->costo}</td>
				<td>{$ruta->electores}</td>
				<td>{$ruta->meta}</td>

			</tr>";
}


	$codigohtml.="
			
		
	</table>
</div>
</body>
</html>";
 // echo $codigohtml;
$dompdf=new DOMPDF();
$dompdf->load_html($codigohtml);
$dompdf->set_Paper('Letter', 'landscape');
$dompdf->render();
$dompdf->stream('Reportedistrital.pdf');




?>