<?php

namespace RUTAS;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
   protected $table = "ruta";
   protected $primaryKey = "id";
   protected $fillable = ['seccion','localidad','distancia','via','medio_transporte','tiempo_aprox','vehiculo','placas','costo','electores','meta', 'municipio_id','numruta','usuario','responsable','municipio','cantVehiculo','tipoUsuario'];


public function municipio(){
   		return $this->belongsTo('RUTAS\municipio','id');
   }



   public $timestamps =false;
}
