<?php

namespace App\Models;
use App\Models\Provedore;
use App\Models\Tipo;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Colore
 *
 * @property $id
 * @property $clave
 * @property $nomenclatura
 * @property $descripcion
 * @property $proveedores_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Colore extends Model
{
    
    static $rules = [
		'clave' => 'required',
		'descripcion' => 'required',
		'proveedores_id' => 'required',
    'tipos_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['clave','nomenclatura','descripcion','proveedores_id','tipos_id','colores_id'];


    public function proveedores()
    {
  
      return $this->HasOne(Proveedore::class,'id','proveedores_id');//relacion con secciones
  
    }
    public function tipos()
    {
  
      return $this->HasOne(Tipo::class,'id','tipos_id');//relacion con tipos
  
    }
}
