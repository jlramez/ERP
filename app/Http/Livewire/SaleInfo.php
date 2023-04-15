<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;

class SaleInfo extends Component
{
    public $sale;
 
    public function mount($id)
    {       
        $this->sale = Sale::find($id);
    }
    public function render()
    {
        $sale=$this->sale;
        return view('livewire/sales.sale-info',[
            'sale',

        ]);
    }
}
