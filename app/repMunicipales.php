<?php

namespace RUTAS;

use Illuminate\Database\Eloquent\Model;

class repMunicipales extends Model
{
  protected $table = "respo_muni";
 	protected $primaryKey = "id";
 	protected $fillable = ['id_distrito', 'distrito', 'usuario' , 'numeromunicipio' , 'municipio' , 'nombre'];

 	public $timestamps =false;
}
