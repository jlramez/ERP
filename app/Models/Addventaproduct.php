<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Unit;

class Addventaproduct extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'addventaproducts';

    protected $fillable = ['sales_id','units_id','cantidad','productos_id'];

    public function sales()
    {
  
      return $this->HasOne(Sale::class,'id','sales_id');//relacion con colores
  
    }
    public function productos()
    {
  
      return $this->HasOne(Producto::class,'id','productos_id');//relacion con colores
  
    }
    public function units()
    {
  
      return $this->HasOne(Unit::class,'id','units_id');//relacion con colores
  
    }
	
}
