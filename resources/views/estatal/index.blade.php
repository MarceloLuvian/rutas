@extends('layouts.app')

@section('content')



<div class="container">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<select name="distritos" id="distritos" class="form-control">
				<option value="0"> SELECCIONE UN DISTRITO</option>
				<option value="1"> PANUCO</option>
				<option value="2"> TANTOYUCA</option>
				<option value="3"> TUXPAN </option>
				<option value="4"> ALAMO</option>
				<option value="5"> POZA RICA</option>
				<option value="6"> PAPANTLA </option>
				<option value="7"> MARTINEZ DE LA TORRE</option>
				<option value="8"> MISANTLA</option>
				<option value="9"> PEROTE </option>
				<option value="10">XALAPA I </option>
				<option value="11"> XALAPA II</option>
				<option value="12"> COATEPEC</option>
				<option value="13">EMILIANO ZAPATA </option>
				<option value="14"> VERACRUZ I </option>
				<option value="15"> VERACRUZ II </option>
				<option value="16"> BOCA DEL RIO</option>
				<option value="17"> MEDELLIN</option>
				<option value="18"> HUATUSCO </option>
				<option value="19">CORDOBA </option>
				<option value="20"> ORIZABA </option>
				<option value="21"> CAMERINO Z. MENDOZA</option>
				<option value="22"> ZONGOLICA</option>
				<option value="23"> COSAMALOAPAN </option>
				<option value="24"> SANTIAGO TUXTLA </option>
				<option value="25"> SAN ANDRES TUXTLA</option>
				<option value="26"> COSOLEACAQUE</option>
				<option value="27"> ACAYUCAN</option>
				<option value="28"> MINATITLAN</option>
				<option value="29"> COATZACOALCOS I </option>
				<option value="30"> COATZACOALCOS II </option>

			</select>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

			<span class="input-group-btn">
				<a type="button" class="btn btn-success" id="exportarMunicipal" onclick="javascript:window.location.reload();">VER TODO</a>
			</span>
			<!-- <span class="input-group-btn">
				<a type="button" href="{{route('/candidatos')}}" class="btn btn-success"  id="exportarMunicipal">CANDIDATOS</a>
			</span> -->
			
			<span class="input-group-btn">
				<a class="btn btn-success" type="button" onClick ="$('#tabla').tableExport({type:'excel',escape:'false'});"  > <span class="glyphicon glyphicon-download "></span> EXPORTAR EXCEL</a>
			</span>
			<span class="input-group-btn">
				<a class="btn btn-success" type="button" onClick ="$('#tabla2').tableExport({type:'excel',escape:'false'});"  > <span class="glyphicon glyphicon-download "></span> EXPORTAR MUNICIPIO SELECCIONADO</a>
			</span>


		</div>
	</div>
	
	<br>
	
	



</div>
<div class="container" align="center">
	<h2>ESTRUCTURA</h2>
</div>
<div class="panel-body" id="contenerdorbueno">
	<div class="table-responsive">
		<table id="tabla" class="table table-hover table-bordered">
			<thead>
				<tr>
					<th align="center"  class="success">DISTRITO</th>
					<th align="center" class="success">MUNICIPIO (S)</th>
					<th align="center" class="success">SECCIÓN (ES)</th>
					<th align="center" class="success">RUTA (S)</th>
					<th align="center" class="success">RUTA (S) NO DESCRITAS</th>
					<th align="center" class="success">LOCALIDAD (ES)</th>
					<th align="center" class="success">VEHÍCULOS</th>
					<th align="center" class="success">COSTO</th>
					<th align="center" class="success">ELECTORES</th>
					<th align="center" class="success">META</th>
					
					<th align="center" class="success">NOMINAL (NÚM)</th>
					
				</tr>
			</thead>
			<tbody id ="data">

				@foreach($distritos as $dis)
				<tr > 
					<td  > {{ $dis["DISTRITO"] }} </td>
					<td align="center"> {{ $dis["MUNICIPIOS"] }} </td>
					<td align="center"> {{ $dis["SECCIONES"] }} </td>
					<td align="center"> {{ $dis["RUTA"] }} </td>
					<td align="center">  {{ $dis["RUTAN"] }} </td>
					<td align="center"> {{ $dis["LOCALIDADES"] }} </td>
					<td align="center"> {{ $dis["VEHICULOS"] }} </td>
					<td align="center"> ${{ number_format($dis["COSTO"]) }} </td>
					<td align="center"> {{ number_format( $dis["ELECTORES"] )}} </td>
					<td align="center"> {{ number_format($dis["META"]) }} </td>					
					<td align="center"> {{ number_format($dis["AVANCE_NOMINAL"]) }} </td>

				</tr>
				@endforeach

				<tr> 
					<td align="center"> <h5><strong>TOTAL</strong> </h5> </td>
					<td align="center"> {{$totalmunicipios}} </td>
					<td align="center">  {{$totalsecciones}} </td>
					<td align="center"> {{$totalrutas}} </td>
					<td align="center"> {{$totalrutasnodescritas}} </td>
					<td align="center"> {{$totalLocalidades}} </td>
					<td align="center"> {{$totalvehiculos}}  </td>
					<td align="center"> <h5><strong> $ {{ number_format($sumacosto)}}</strong> </h5></td>
					<td align="center"> <h5> <strong> {{ number_format( $sumaelectores)}}  </strong> </h5></td>
					<td align="center"> <h5> <strong> {{number_format($sumameta)}} </strong> </h5></td>
					<!-- <td align="center"> <h5> <strong>  {{ $porcentajenominal}} % </strong> </h5></td> -->
					<td align="center"> <h5> <strong> {{ number_format($sumanominal)}} </strong> </h5></td>

				</tr>
			</tbody>
		</table>
	</div>
</div>

<div class="panel-body" id ="containeraux">
	<div class="table-responsive">
		<table id="tabla2" class="table table-hover table-bordered">
			<thead>
				<tr>
					<th class="success">DISTRITO</th>
					<th class="success">MUNICIPIO (S)</th>
					<th class="success">SECCIÓN (ES)</th>
					<th class="success">RUTA (S)</th>
					<th class="success">LOCALIDAD (ES)</th>
					<th class="success">VEHÍCULOS</th>
					<th class="success">COSTO</th>
					<th class="success">ELECTORES</th>
					<th class="success">META</th>
					<th class="success">NOMINAL (%)</th>
					<th class="success">NOMINAL (NÚM)</th>
					
				</tr>
			</thead>
			<tbody id ="data2">

			</tbody>

		</table>
	</div>
</div>


<script type="text/javascript" src="/rutas/public/assets/js/estatal/estatal.js"></script>
<script type="text/javascript" src="../public/assets/js/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="../public/assets/js/jspdf/jspdf.js"></script>
<script type="text/javascript" src="../public/assets/js/jspdf/libs/base64.js"></script>
<script type="text/javascript" src="../public/assets/js/tableExport.js"></script>
<script type="text/javascript" src="../public/assets/js/jquery.base64.js"></script>



@endsection