@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<select name="distritos" id="distritos" class="form-control">
				<option value="0"> SELECCIONE UN NOMBRE</option>
				@foreach($usuarios as $usuario)
				<option value="$usuario['NOMBRE']"> {{ $usuario["NOMBRE"] }}</option>
				@endforeach

			</select>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<span class="input-group-btn">
				<a type="button"  class="btn btn-warning"  onclick="javascript:window.location.reload();">VER TODO</a>
			</span>
			<!-- <span class="input-group-btn">
				<a type="button" href="{{route('/reportesEstatales')}}" class="btn btn-warning" id="exportarMunicipal">ESTRUCTURA</a>
			</span> -->
			<span class="input-group-btn">
				<a class="btn btn-warning" type="button" onClick ="$('#tabla').tableExport({type:'excel',escape:'false'});"  > <span class="glyphicon glyphicon-download "></span> EXPORTAR EXCEL</a>
			</span>
			

		</div>
	</div>
	
	<br>
	



</div>

<div class="panel-body">
	<div align="center">
		<h2>MUNICIPALES</h2>
	</div>
	<div class="table-responsive">
		<table id="tabla" class="table table-hover table-bordered">
			<thead>
				<tr>
					<th class="warning">DISTRITO</th>
					<th class="warning">MUNICIPIO</th>
					<th class="warning">NOMBRE</th>
					
					<th class="warning">SECCIONES</th>
					<th class="warning">RUTAS</th>
					<th class="warning">LOCALIDAD</th>
					<th class="warning">VEHÍCULOS</th>
					<th class="warning">COSTO</th>
					<th class="warning">ELECTORES</th>
					<th class="warning">META</th>
					<th class="warning">NOMINAL(NUM)</th>
				</tr>
			</thead>
			<tbody id="datos">
				@foreach($usuarios as $usuario)
				<tr> 
					<td > {{ $usuario["DISTRITO"] }} </td>
					<td > {{ $usuario["MUNICIPIO"] }} </td>
					<td > {{ $usuario["NOMBRE"] }} </td>
					<td> {{ $usuario["SECCIONES"] }} </td>
					<td>{{ $usuario["RUTAS"] }}</td>
					<td>{{ $usuario["LOCALIDADES"] }}</td>
					<td> {{ $usuario["VEHICULOS"] }}</td>
					<td>{{ $usuario["COSTO"] }}</td>
					<td>{{ $usuario["ELECTORES"] }}</td>
					<td>{{ $usuario["META"] }}</td>
					<td>{{ $usuario["NOMINAL"] }}</td>



				</tr>
				@endforeach


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