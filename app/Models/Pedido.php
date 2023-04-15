<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Proveedore;

/**
 * Class Pedido
 *
 * @property $id
 * @property $proveedores_id
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 * @property $fecha
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pedido extends Model
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
    protected $fillable = ['descripcion','fecha','proveedores_id'];
    public function proveedores()
    {
  
      return $this->HasOne(Proveedore::class,'id','proveedores_id');//relacion con colores
  
    }




}
