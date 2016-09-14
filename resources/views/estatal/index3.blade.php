@extends('layouts.app')

@section('content')
<br>
<br>
<div class="container">
<div class="row">
<div align="center">
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="well">
			<span > <a href="{{route('/estatalestructura')}}">ESTRUCTURA</a></span>	
			</div>	
		</div>	
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="well">
				<span > <a href="{{route('/candidatos')}}">CANDIDATOS</a></span>	
			</div>	
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="well">
				<span > <a href="{{route('/municipalesusuarios')}}">MUNICIPALES</a></span>	
			</div>	
		</div>
		</div>
</div>
</div>
@endsection