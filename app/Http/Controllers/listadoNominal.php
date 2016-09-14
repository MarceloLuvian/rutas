<?php

namespace RUTAS\Http\Controllers;

use Illuminate\Http\Request;

use RUTAS\Http\Requests;
use RUTAS\municipio;
use RUTAS\microregiones;
use RUTAS\Nominal;
use RUTAS\listanominal;
use RUTAS\Ruta;
use RUTAS\Auth;
USE RUTAS\responsable;
use RUTAS\Http\Controllers\estatalController;

class listadoNominal extends Controller
{
 public function __construct()
 {
  $this->middleware('auth');
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $usuario = \Auth::user();
     if ($usuario->distrito == 50) {
      return redirect()->route('/reportesEstatales');
    }else{
     $view = \View::make('inicio.index');
     $view->usuario = $usuario;
     return $view;
   }

 }

 public function vistaNominal(){
  $usuario = \Auth::user();

  $estado = 0;
  $view = \View::make('nominal.index');

  $municipios = $this->municipios($usuario->distrito);
  $view->estado = $estado;
  $view->municipios = $municipios;
  return $view;

}

 public function municipios($distrito){
        $usuario = \Auth::user();
      if ($usuario->nivel == 53) {
        $municipios = microregiones::groupby('municipio')->get();
      return $municipios;
      }else if($usuario->nivel == 54){
       $municipios = microregiones::where('id_municipio',$usuario->municipio)->groupby('municipio')->get();
      return $municipios;
      }

      else{
        $municipios = microregiones::where('distrito','=',$distrito)->groupby('municipio')->get();
      return $municipios;
      }
    }

public function secciones($municipio){
  $seccion = microregiones::where('id_Municipio','=',$municipio)->orderby('seccion','asc')->get();
  return $seccion;

}

public function municipio($municipio){
  $resultado = municipio::where('numeromunicipio','=',$municipio)->get();
  return $resultado;
}

public function buscarnominal($clave_elector, $seccion, $ruta){
 $usuario = \Auth::user();

 $rutas = Ruta::where('usuario',$usuario->id)->where('seccion',$seccion)->where('numruta', $ruta)->count();    

 $comprobacion = $rutas;

 if ($comprobacion == 0) {
  return 4;
}else{
 $usuario = \Auth::user();
 // $persona = listanominal::where('seccion','=',$seccion)->where('claveElector','=',$clave_elector)->get();
 $persona  = 0;
 if ( count($persona) == 0) {
  return 0;
}else{
  return $persona;
}
}




}

public function eliminarNominal($id){
  $nominal = Nominal::find($id);
  $nominal->delete();

  
}

public function cargarNominal($ruta, $seccion){
   $usuario = \Auth::user();
$nominales = Nominal::where('usuario',$usuario->id)->where('seccion',$seccion)->where('numruta',$ruta)->get();

if ($nominales->count()==0) {
  return 2;
}else
{
  return $nominales;
}


}


public function nominalMunicipal($municipio){
   $usuario = \Auth::user();
$sumanominal = 0;
$secciones = $this->secciones($municipio);

foreach ($secciones as $seccion) {
  $nominal = Nominal::where('usuario',$usuario->id)->where('seccion',$seccion->seccion)->count();
 $sumanominal = $sumanominal + $nominal;
 
}
return $sumanominal;
}


function comprobarrutas($seccion, $ruta){   





}

public function guardarnominal(Request $request){
  $estado = 0;
  $usuario = \Auth::user();
  $per = Nominal::where('clave_elector','=',$request->clave_elector)->get();

  $persona = count($per);

  $telefonocel = $request->telefonocel;
  $telefonocasa = $request->telefonocasa;
  $otro = $request->otro;
  $referencia = $request->referencia;

  if ($telefonocasa == "") {
    $telefonocasa = "-";
  }else if ($telefonocel == ""){
    $telefonocel = "-";
  }else if($otro == ""){
    $otro = "-";
  }else if($referencia == ""){
    $referencia = "-";
  }


  if ($persona > 0) {

    $estado = 2;
    $usuario = \Auth::user();

    $view = \View::make('nominal.index');
    $municipios = $this->municipios($usuario->distrito);
    $view->estado = $estado;
    $view->municipios = $municipios;
    return $view;

  }
  else
  {

    $nominal = new Nominal();
    $nominal->nombre =  mb_strtoupper ($request->nombre);
    $nominal->apellidop = mb_strtoupper ($request->apellidop);
    $nominal->apellidom = mb_strtoupper ($request->apellidom);
    $domicilio = mb_strtoupper($request->calle);
    $nominal->domicilio = $domicilio;
    $nominal->clave_elector = mb_strtoupper($request->clave_elector);
    $nominal->telefono = $telefonocel;
    $nominal->numruta = $request->ruta;
    $nominal->seccion = $request->seccion;
    $nominal->telefono2 = $telefonocasa;
    $nominal->telefono3 = $otro;
    $nominal->descripcion = mb_strtoupper($referencia);
    $nominal->usuario = $usuario->id;
    $nominal->tipoUsuario = $usuario->tipoUsuario;  
    $estado = 1;
    $nominal->save();



    $view = \View::make('nominal.index');
    $municipios = $this->municipios($usuario->distrito);
    $view->estado = $estado;
    $view->municipios = $municipios;
    return $view;
  }



}

public function rutasregistradas($seccion){
  $usuario = \Auth::user();
  // $nominales = Nominal::where('usuario',$usuario->id)->where('seccion',$seccion)->where('numruta',$ruta)->get();

  $rutas = responsable::where('seccion','=',$seccion)->where('usuario','=',$usuario->id)->get();
  
  $resultado = count($rutas);

  if ($resultado == 0) {
    return 0;
  }else
  {
    return $rutas;
  }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      return "store";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     return "edit";
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

      $usuario = \Auth::user();
      $per = Nominal::where('clave_elector','=',$request->clave_elector)->where('usuario','=',$usuario->id)->get();


      $telefonocel = $request->telefonocel;
      $telefonocasa = $request->telefonocasa;
      $otro = $request->otro;
      $referencia = $request->referencia;

      if ($telefonocasa == "") {
        $telefonocasa = "-";
      }
      if ($telefonocel == ""){
        $telefonocel = "-";
      }
      if($otro == ""){
        $otro = "-";
      }
      if($referencia == ""){
        $referencia = "-";
      }


      if ($per->count() > 0) {
        return 0;

      }
      else
      {

        $nominal = new Nominal();
        $nominal->nombre =  mb_strtoupper ($request->nombre);
        $nominal->apellidop = mb_strtoupper ($request->apellidop);
        $nominal->apellidom = mb_strtoupper ($request->apellidom);
        $domicilio = mb_strtoupper ($request->calle);
        $nominal->domicilio = $domicilio;
        $nominal->clave_elector = mb_strtoupper($request->clave_elector);
        $nominal->telefono = $telefonocel;
        $nominal->numruta = $request->ruta;
        $nominal->seccion = $request->seccion;
        $nominal->telefono2 = $telefonocasa;
        $nominal->telefono3 = $otro;
        $nominal->descripcion = mb_strtoupper($referencia);
        $nominal->usuario = $usuario->id;  
        $nominal->tipoUsuario = $usuario->tipoUsuario;  
        $nominal->save();



        return 1;
      }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return "destroy";
    }
  }
