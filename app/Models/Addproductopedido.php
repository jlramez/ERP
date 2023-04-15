<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

/**
 * Class Addproductopedido
 *
 * @property $id
 * @property $pedidos_id
 * @property $productos_id
 * @property $cantidad
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Addproductopedido extends Model
{
    
    static $rules = [
		'pedidos_id' => 'required',
		'productos_id' => 'required',
		'cantidad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['pedidos_id','productos_id','cantidad'];

    public function productos()
    {
  
      return $this->HasOne(Producto::class,'id','productos_id');//relacion con tipos
  
    }


}
