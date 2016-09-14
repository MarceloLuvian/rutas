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
				<a type="button"  class="btn btn-danger"  onclick="javascript:window.location.reload();">VER TODO</a>
			</span>
			<!-- <span class="input-group-btn">
				<a type="button" href="{{route('/reportesEstatales')}}" class="btn btn-danger" id="exportarMunicipal">ESTRUCTURA</a>
			</span> -->
			<span class="input-group-btn">
				<a class="btn btn-danger" type="button" onClick ="$('#tabla').tableExport({type:'excel',escape:'false'});"  > <span class="glyphicon glyphicon-download "></span> EXPORTAR EXCEL</a>
			</span>
			

		</div>
	</div>
	
	<br>
	



</div>
<div class="container" align="center" id="contenerdorbueno">
	<h2>CANDIDATOS</h2>
</div>
<div class="panel-body" >
	<div class="table-responsive">
		<table id="tabla" class="table table-hover table-bordered">
			<thead>
				<tr>
					<th class="danger">DISTRITO</th>
					<th class="danger">MUNICIPIO (S)</th>
					<th class="danger">SECCIÓN (ES)</th>
					<th class="danger">RUTA (S)</th>
					<th class="danger">LOCALIDAD (ES)</th>
					<th class="danger">VEHÍCULOS</th>
					<th class="danger">COSTO</th>
					<th class="danger">ELECTORES</th>
					<th class="danger">META</th>
					<th class="danger">NOMINAL (%)</th>
					<th class="danger">NOMINAL (NÚM)</th>
					
				</tr>
			</thead>
			<tbody id ="data">

				@foreach($distritos as $dis)
				<tr> 
					<td > {{ $dis["DISTRITO"] }} </td>
					<td align="center"> {{ $dis["MUNICIPIOS"] }} </td>
					<td align="center"> {{ $dis["SECCIONES"] }} </td>
					<td align="center"> {{ $dis["RUTA"] }} </td>
					<td align="center"> {{ $dis["LOCALIDADES"] }} </td>
					<td align="center"> {{ $dis["VEHICULOS"] }} </td>
					<td align="center"> ${{ number_format( $dis["COSTO"]) }} </td>
					<td align="center"> {{ number_format($dis["ELECTORES"]) }} </td>
					<td align="center"> {{ number_format($dis["META"]) }} </td>
					@if( $dis["META"] >0)	
					<?php 
					$aux = ( $dis["AVANCE_NOMINAL"] /  $dis["META"] ) * 100;
					$aux = round($aux,2);
					?>						
					<td align="center"> {{ $aux }} % </td>
					@else
					<td align="center"> {{ number_format($dis["META"]) }} %</td>
					@endif
					<td align="center"> {{ number_format($dis["AVANCE_NOMINAL"]) }} </td>

				</tr>
				@endforeach
				<tr> 
					<td align="center"> <h5><strong>TOTAL</strong> </h5> </td>
					<td align="center"> {{$totalmunicipios}} </td>
					<td align="center">  {{$totalsecciones}} </td>
					<td align="center">{{$totalrutas}}  </td>
					<td align="center"> {{$totalLocalidades}} </td>
					<td align="center"> {{$totalvehiculos}}  </td>
					<td align="center"> <h5><strong> $ {{ number_format( $sumacosto)}}</strong> </h5></td>
					<td align="center"> <h5> <strong> {{number_format($sumaelectores)}}  </strong> </h5></td>
					<td align="center"> <h5> <strong> {{number_format($sumameta)}} </strong> </h5></td>
					<td align="center"> <h5> <strong>  {{ number_format( $porcentajenominal)}} % </strong> </h5></td>
					<td align="center"> <h5> <strong> {{ number_format($sumanominal)}} </strong> </h5></td>

				</tr>
			</tbody>

		</table>
	</div>
</div>



<script type="text/javascript" src="/rutas/public/assets/js/estatal/candidatos.js"></script>
<script type="text/javascript" src="../public/assets/js/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="../public/assets/js/jspdf/jspdf.js"></script>
<script type="text/javascript" src="../public/assets/js/jspdf/libs/base64.js"></script>
<script type="text/javascript" src="../public/assets/js/tableExport.js"></script>
<script type="text/javascript" src="../public/assets/js/jquery.base64.js"></script>



@endsection