<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pedido;

class Pedidos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $fecha;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.pedidos.view', [
            'pedidos' => Pedido::latest()
						->orWhere('descripcion', 'LIKE', $keyWord)
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
		$this->fecha = null;
    }

    public function store()
    {
        $this->validate([
		'descripcion' => 'required',
		'fecha' => 'required',
        ]);

        Pedido::create([ 
			'descripcion' => $this-> descripcion,
			'fecha' => $this-> fecha
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Pedido Successfully created.');
    }

    public function edit($id)
    {
        $record = Pedido::findOrFail($id);
        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		$this->fecha = $record-> fecha;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
		'fecha' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Pedido::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion,
			'fecha' => $this-> fecha
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Pedido Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Pedido::where('id', $id)->delete();
        }
    }
}