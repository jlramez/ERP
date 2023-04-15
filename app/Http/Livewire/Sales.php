<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Sale;

class Sales extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $noarticulos, $subtotal, $total, $fecha, $locations_id;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.sales.view', [
            'sales' => Sale::latest()
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('noarticulos', 'LIKE', $keyWord)
						->orWhere('subtotal', 'LIKE', $keyWord)
						->orWhere('total', 'LIKE', $keyWord)
						->orWhere('fecha', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->descripcion = null;
		$this->noarticulos = null;
		$this->subtotal = null;
		$this->total = null;
		$this->fecha = null;
    }

    public function store()
    {
        /*$this->validate([
		'descripcion' => 'required',
		'noarticulos' => 'required',
		'subtotal' => 'required',
		'total' => 'required',
		'fecha' => 'required',
        ]);*/
      
        Sale::create([ 
            'locations_id' => 2,
			'descripcion' => "Venta de mercancia",
			'noarticulos' => 0,
			'subtotal' => 0,
			'total' => 0,
			'fecha' => now(),
        ]);

        $sales_id=Sale::max('id');
        return redirect(route('addventaproducts.venta',$sales_id));

        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Sale Successfully created.');
    }

    public function edit($id)
    {
        $record = Sale::findOrFail($id);
        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		$this->noarticulos = $record-> noarticulos;
		$this->subtotal = $record-> subtotal;
		$this->total = $record-> total;
		$this->fecha = $record-> fecha;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
		'noarticulos' => 'required',
		'subtotal' => 'required',
		'total' => 'required',
		'fecha' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Sale::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion,
			'noarticulos' => $this-> noarticulos,
			'subtotal' => $this-> subtotal,
			'total' => $this-> total,
			'fecha' => $this-> fecha
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Sale Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Sale::where('id', $id)->delete();
        }
    }
}