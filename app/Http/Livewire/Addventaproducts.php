<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Addventaproduct;
use App\Models\Sale;
use App\Models\Inventario;
use App\Models\Unit;
class Addventaproducts extends Component
{
    public $sale;
    public function mount($id)
    {       
        
        $this->sale=sale::find($id);
        
       


    }
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $sales_id, $units_id, $cantidad, $productos_id;

    public function render()
    {
        $keyWord = '%'.$this->keyWord .'%';
        $this->sales_id = $this->sale->id; 
        return view('livewire.addventaproducts.view', [ 
            'sales' => Sale::find($this->sale->id),
            'units' => Unit::all(),
            'inventarios'=> Inventario::where('locations_id',$this->sale->locations_id)
                                        ->where('piezas','>',0)
                                        ->get(),
            'addventaproducts' => Addventaproduct::where('sales_id',$this->sale->id)->
                        latest()->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->sales_id = null;
		$this->units_id = null;
		$this->cantidad = null;
		$this->productos_id = null;
    }

    public function store()
    {
        $this->validate([
		'sales_id' => 'required',
		'units_id' => 'required',
		'cantidad' => 'required',
		'productos_id' => 'required',
        ]);
         
        $this->sales_id = $this->sale->id; 
        Addventaproduct::create([ 
			'sales_id' => $this-> sales_id,
			'units_id' => $this-> units_id,
			'cantidad' => $this-> cantidad,
			'productos_id' => $this-> productos_id
        ]);
        $record_update=$this->sale_update($this->sale->id);
        $check_producto=$this->thereisproduct($this->productos_id,$this->sale->locations_id);
        if($check_producto)
         {
            $calcular=$this->calculos_store($this->productos_id,$this->sale->locations_id);
         }


        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Addventaproduct Successfully created.');
    }

    public function edit($id)
    {
        $record = Addventaproduct::findOrFail($id);
        $this->selected_id = $id; 
		$this->sales_id = $record-> sales_id;
		$this->units_id = $record-> units_id;
		$this->cantidad = $record-> cantidad;
		$this->productos_id = $record-> productos_id;
    }

    public function update()
    {
        $this->validate([
		'sales_id' => 'required',
		'units_id' => 'required',
		'cantidad' => 'required',
		'productos_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Addventaproduct::find($this->selected_id);
            $calcular=$this->calculos_update($this->productos_id,$this->sale->locations_id);
            $record->update([ 
			'sales_id' => $this-> sales_id,
			'units_id' => $this-> units_id,
			'cantidad' => $this-> cantidad,
			'productos_id' => $this-> productos_id
            ]);
            $record_update=$this->sale_update($this->sale->id);
            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Addventaproduct Successfully updated.');
        }
    }

    public function destroy($id)
    {
        
        if ($id) {
            $this->selected_id=$id;
            $record=Addventaproduct::find($id);
            $calcular=$this->calculos_destroy($record->productos_id,$this->sale->locations_id);
            $record->delete();
        }
        $record_update=$this->sale_update($this->sale->id);
    }
    public function calculate($id)
    {
        if ($id) 
        {
            $subtotal=0;
            Addventaproduct::find($id);
            $no_prods=Addventaproduct::where('sales_id', $id)->count();
            $prods=Addventaproduct::where('sales_id', $id)->get();
            foreach($prods as $row)
            {
            $subtotal=$subtotal+($row->productos->precio*$row->cantidad);
            }
            return $subtotal;

        }
    }
    public function sale_update($id)
    {       
        $noarticulos=Addventaproduct::where('sales_id',$id)->count();
        $total=$this->calculate($id);
        $subtotal=$total/1.16;    
       
        if ($id) 
        {
            $record = Sale::find($id);
            $record->noarticulos = $noarticulos;
            $record->subtotal = $subtotal;
            $record->total = $total;
            $record->save();            
        }
    }
    public function thereisproduct($productos_id)
    {
        $existe=Inventario::where('productos_id',$productos_id)
                              ->where('locations_id',$this->sale->locations_id)->count();      
            return $existe;
    }
    public function calculos_store($productos_id,$locations_id)
    {
        
        $existencia=Inventario::where('productos_id',$productos_id)
        ->where('locations_id',$locations_id)->first();
        $restante=$existencia->piezas-$this->cantidad;
        $existencia->piezas=$restante;
        $existencia->save();
    }
    public function calculos_update($productos_id,$locations_id) //actualizar inventario si edita o borra articulo de venta 
    {
        
        $existencia=Inventario::where('productos_id',$productos_id)
        ->where('locations_id',$locations_id)->first();
        $record=Addventaproduct::find($this->selected_id);
        if($this->cantidad<$record->cantidad)
        {
            $recalculo=$record->cantidad-$this->cantidad;
            //dd('<',$recalculo);
            $restante=$existencia->piezas+$recalculo;
        }
        if($this->cantidad>$record->cantidad)
        {
            $recalculo=$this->cantidad-$record->cantidad;
             //dd('>',$recalculo);
            $restante=$existencia->piezas-$recalculo;
        }    
        $existencia->piezas=$restante;
        $existencia->save();
    }
    public function calculos_destroy($productos_id,$locations_id) //actualizar inventario si edita o borra articulo de venta 
    {
        
        $existencia=Inventario::where('productos_id',$productos_id)
        ->where('locations_id',$locations_id)->first();
        $record=Addventaproduct::find($this->selected_id);
        $restante=$existencia->piezas+$record->cantidad;
        $existencia->piezas=$restante;
        $existencia->save();
    }
}