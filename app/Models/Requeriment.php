<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

/**
 * Class Requeriment
 *
 * @property $id
 * @property $descripcion
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Requeriment extends Model
{
    
    static $rules = [
		'descripcion' => 'required',
		'fecha' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion','fecha'];

    public function productos()
    {
  
      return $this->HasOne(Producto::class,'id','productos_id');//relacion con colores
  
    }

}
