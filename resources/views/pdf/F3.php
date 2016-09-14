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
<pre>M-16                                                                                               F3</pre>
<div align='center'>
	<h3>CONCENTRADO MUNICIPAL</h3>
</div>
<div>
	<strong> DISTRITO:  </strong> <span > $distrito   </span> 
	<strong>CABECERA:  </strong> <span > $cabecera    </span>
	<strong> MUNICIPIO:   </strong> <span > $municipio    </span>	
	<strong>RESPONSABLE: </strong><span > $representante   </span>
</div>
<br>
<table class='table' border='1'>
		
			<tr>
				<th> SECCIÓN (ES)  </th>
				<th>  RUTA (AS) </th>
				<th> LOCALIDAD (ES)  </th>	
				<th>  VEHÍCULO (S)</th>		
				<th>  COSTO ($) </th>
				<th>  ELECTORES </th>
				<th>  META </th>
				
				
			</tr>
		
";
			


	$codigohtml.="
						
						<tr>
							
				<td class='domicilio'> - </td>
					<td class='domicilio'>- </td>
						<td class='domicilio'>- </td>
							<td class='domicilio'>- </td>
								<td class='domicilio'>- </td>
									<td class='domicilio'>- </td>
										<td class='domicilio'>- </td>
				
						</tr>	
							<tr>
							
					<td class='domicilio'>- </td>
						<td class='domicilio'>- </td>
							<td class='domicilio'>- </td>
								<td class='domicilio'>- </td>
									<td class='domicilio'>- </td>
										<td class='domicilio'>- </td>
											<td class='domicilio'>- </td>
				
						</tr>	


	<tr>
				
				


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
$nombre = $municipio.".pdf";
 // echo $codigohtml;
$dompdf=new DOMPDF();
$dompdf->load_html($codigohtml);
$dompdf->set_Paper('Letter', 'landscape');
$dompdf->render();
$dompdf->stream($nombre);




?>