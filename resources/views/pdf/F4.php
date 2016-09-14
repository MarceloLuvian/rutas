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
	



	$codigohtml.="
	<pre>M-16                                                                                               F4</pre>
<div align='center'>
	<h3>CONCENTRADO DISTRITAL</h3>
</div>
	<div>
		<strong> DISTRITO:  </strong> <span > $distrito   </span> 
		<strong>CABECERA:  </strong> <span > $cabecera    </span>
		
	</div>
	<br>
	<table class='table' border='1'>
		
		<tr>
			<th> MUNICIPIO (S)  </th>
			<th> SECCIÓN (ES)  </th>
			<th>  RUTA (AS) </th>
			<th> LOCALIDAD (ES)  </th>	
			<th>  VEHÍCULO (S)</th>		
			<th>  COSTO ($) </th>
			<th>  ELECTORES </th>
			<th>  META </th>
			
			
		</tr>
		
		";
		
$nombre = $cabecera."-DISTRITAL".".pdf";

		$codigohtml.="
		
		<tr>
			<td class='domicilio'> - </td>
			<td class='domicilio'> - </td>
			<td class='domicilio'>- </td>
			<td class='domicilio'>- </td>
			<td class='domicilio'>- </td>
			<td class='domicilio'>- </td>
			<td class='domicilio'>- </td>
			<td class='domicilio'>- </td>
			
		</tr>	
		<tr>
			<td class='domicilio'> - </td>
			<td class='domicilio'>- </td>
			<td class='domicilio'>- </td>
			<td class='domicilio'>- </td>
			<td class='domicilio'>- </td>
			<td class='domicilio'>- </td>
			<td class='domicilio'>- </td>
			<td class='domicilio'>- </td>
			
		</tr>	";
		foreach ($municipiosTotales as $mun) {
			$codigohtml.="<tr>
			
			<td class='domicilio'>{$mun['MUNICIPIOS']}</td>
			<td class='domicilio'>{$mun['SECCIONES']}</td>
			<td class='domicilio'>{$mun['RUTA']}</td>
			<td class='domicilio'>{$mun['LOCALIDADES']}</td>
			<td class='domicilio'>{$mun['VEHICULOS']}</td>
			<td class='domicilio'>{$mun['COSTO']}</td>
			<td class='domicilio'>{$mun['ELECTORES']}</td>
			<td class='domicilio'>{$mun['META']}</td>

		</tr>";
	}



	$codigohtml.="	

	<tr>
		<td class='domicilio'> - </td>
		<td class='domicilio'> - </td>
		<td class='domicilio'>- </td>
		<td class='domicilio'>- </td>
		<td class='domicilio'>- </td>
		<td class='domicilio'>- </td>
		<td class='domicilio'>- </td>
		<td class='domicilio'>- </td>
		
	</tr>
	<tr>
		
		

		<td class='domicilio'><strong> TOTAL </strong></td>
		<td class='domicilio'>$seccion </td>
		<td class='domicilio'> $ruta </td>
		<td class='domicilio'> $localidad</td>
		<td class='domicilio'>$vehiculos </td>
		<td class='domicilio'>$ $costo </td>
		<td class='domicilio'> $electores</td>
		<td class='domicilio'> $meta </td>
		
		

	</tr>  

	

	
	";





	$codigohtml.="
	
</table>

</body>
</html>";
 // echo $codigohtml;
$dompdf=new DOMPDF();
$dompdf->load_html($codigohtml);
$dompdf->set_Paper('Letter', 'landscape');
$dompdf->render();
$dompdf->stream($nombre);




?>