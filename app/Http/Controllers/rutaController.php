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
use RUTAS\responsable;

class rutaController extends Controller
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
      $estado = 0;
      $view = \View::make('ruta.index');

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
      $seccion = microregiones::where('id_municipio','=',$municipio)->orderby('seccion','ASC')->get();
      return $seccion;
    }

    public function guardarResponsable($nombre,$seccion,$municipio){

     $usuario = \Auth::user();
     $r = responsable::where('seccion','=', $seccion)->where('usuario','=',$usuario->id)->OrderBy('numruta','DESC')->get(); 


     if ($r->count() == 0) {
      $responsable = new responsable();
      $responsable->nombre = mb_strtoupper($nombre);
      $responsable->distrito = $usuario->distrito;
      $responsable->seccion = mb_strtoupper($seccion);
      $responsable->municipio = mb_strtoupper($municipio);
      $responsable->numruta = 1;
      $responsable->usuario = $usuario->id;
      $responsable->tipoUsuario = mb_strtoupper($usuario->tipoUsuario);
      $responsable->save();
    }
    else
    {
      $responsable = new responsable();
      $responsable->nombre = mb_strtoupper($nombre);
      $responsable->distrito = $usuario->distrito;
      $responsable->seccion = mb_strtoupper($seccion);
      $responsable->municipio = mb_strtoupper($municipio);
      if ($r[0]->numruta > 0) {
       $responsable->numruta = $r[0]->numruta +1;
     }else{
      $responsable->numruta = 1;
    }
    $responsable->usuario = $usuario->id;
    $responsable->tipoUsuario = mb_strtoupper($usuario->tipoUsuario);
    $responsable->save();
  }





  return 1;
}

public function cargarResponsable($id){
  $responsable = responsable::find($id);

  return $responsable;
}

public function editarResponsable($id, $nombre ){
  $usuario = \Auth::user();
  $responsable = responsable::find($id);

  $rutas = Ruta::where('usuario','=',$usuario->id)->where('seccion','=', $responsable->seccion)->where('numruta',$responsable->numruta)->get(); 

  if ($rutas->count() > 0) {
    foreach ($rutas as $r) {
      $ruta = Ruta::find($r->id);
      $ruta->responsable = mb_strtoupper($nombre);
      $ruta->save();
    }
    $responsable->nombre = mb_strtoupper ($nombre);
    $responsable->save();
    return 2;
  }else{
   $responsable->nombre = mb_strtoupper($nombre);
   $responsable->save();
   return 1;
 }

}

public function guardarRuta(Request $request){
  $usuario = \Auth::user();
  $r = Ruta::where('seccion','=', $request->seccion)->where('usuario','=',$usuario->id)->OrderBy('numruta','DESC')->get(); 
  $resultado = count($r);

  $ruta = new Ruta();
  $ruta->seccion = $request->seccion;
  $ruta->localidad = mb_strtoupper($request->localidad);
  $ruta->distancia = $request->distancia; 
  $ruta->via = $request->via;
  $ruta->medio_transporte = $request->medio;
  $ruta->tiempo_aprox = mb_strtoupper ($request->tiempo);
  $ruta->vehiculo = mb_strtoupper($request->tipoveiculo);
  $ruta->placas = mb_strtoupper($request->nplacas);
  $ruta->costo = $request->costo;
  $ruta->electores = mb_strtoupper($request->electores);
  $ruta->meta = $request->meta;
  $ruta->municipio_id = $request->municipio;  


  if ($resultado > 0) {

   $ruta->numruta = $r[0]->numruta + 1;

 }else{
  $ruta->numruta = 1;
}
$ruta->usuario = $usuario->id;
$ruta->responsable = mb_strtoupper($request->responsable);
$ruta->municipio = mb_strtoupper($request->municipiog);

$ruta->save();


$estado = 1;
$view = \View::make('ruta.index');

$municipios = $this->municipios($usuario->distrito);
$view->estado = $estado;
$view->municipios = $municipios;
return $view;
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function cargarTabla( $seccion, $ruta){
      $usuario = \Auth::user();

      $rutas = Ruta::where('seccion','=',$seccion)->where('numruta','=',$ruta)->where('usuario','=',$usuario->id)->OrderBy('id','desc')->get();

      if ($rutas->count() == 0) {
        return 0;
      }else{
       return $rutas;
     }
   }

   public function editar($id){
    $ruta = Ruta::find($id);
    return $ruta;
  }

  public function eliminarRuta($id){
    $ruta = Ruta::find($id);
    $usuario = \Auth::user();

    $nominales = Nominal::where('usuario',$usuario->id)->where('seccion',$ruta->seccion)->where('numruta',$ruta->numruta)->get();

    if ($nominales->count() > 0) {
      return 2;
    }else{
      $ruta->delete();

      return 1;
    }
    
  }

  public function editarRuta($id,$localidad,$dis,$vi,$medio,$tiempo,$vehiculo,$placas,$cantidadV,$costo,$electores,$meta){

    if (($id == "") || ($localidad == "") || ($dis == "") || ($vi == "") || ($medio == "") || ($tiempo == "") || ($vehiculo == "") || ($placas == "") || ($cantidadV == "") || ($costo == "") || ($electores == "") || ($meta == "")) {
      return 0; 

    }else{

      $ruta = Ruta::find($id);

      $ruta->localidad = mb_strtoupper($localidad);
      $ruta->distancia = $dis;
      $ruta->via = mb_strtoupper($vi);
      $ruta->medio_transporte = mb_strtoupper($medio);
      $ruta->tiempo_aprox = mb_strtoupper($tiempo);
      $ruta->vehiculo = mb_strtoupper($vehiculo);
      $ruta->placas = mb_strtoupper($placas);      
      $ruta->costo = $costo;
      $ruta->electores = $electores;
      $ruta->meta = $meta;    
      $ruta->cantVehiculo = $cantidadV;

      $ruta->save();

      return 1;
    }
    
  }

  public function update(Request $request)
  {
    $usuario = \Auth::user();

    $ruta = new Ruta();
    $ruta->seccion = $request->seccion;
    $ruta->localidad = mb_strtoupper($request->localidad);
    $ruta->distancia = $request->distancia;
    $ruta->via = mb_strtoupper($request->via);
    $ruta->medio_transporte = mb_strtoupper($request->medio);
    $ruta->tiempo_aprox = mb_strtoupper($request->tiempo);

    $ruta->vehiculo = mb_strtoupper($request->tipoveiculo);
    $ruta->placas = mb_strtoupper($request->nplacas);      
    $ruta->costo = $request->costo;
    $ruta->electores = $request->electores;
    $ruta->meta = $request->meta;
    $ruta->municipio_id = $request->id_municipio;
    $ruta->numruta = $request->ruta;
    $ruta->usuario = $usuario->id;
    $ruta->responsable = mb_strtoupper($request->responsable);
    $ruta->municipio = mb_strtoupper($request->municipiog);
    $ruta->cantVehiculo = $request->cantidad;
    $ruta->tipoUsuario = mb_strtoupper($usuario->tipoUsuario);


    $ruta->save();


    return 1;
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
  }
