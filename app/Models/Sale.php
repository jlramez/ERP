<?php 

namespace App\Models;
use App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'sales';

    protected $fillable = ['descripcion','noarticulos','subtotal','total','fecha','locations_id'];

    public function locations()
    {
  
      return $this->HasOne(Location::class,'id','locations_id');//relacion con colores
  
    }
	
}
