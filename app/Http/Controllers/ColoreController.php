<?php

namespace App\Http\Controllers;

use App\Models\Colore;
use App\Models\Proveedore;
use App\Models\Tipo;
use Illuminate\Http\Request;

/**
 * Class ColoreController
 * @package App\Http\Controllers
 */
class ColoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colores = Colore::paginate();

        return view('colore.index', compact('colores'))
            ->with('i', (request()->input('page', 1) - 1) * $colores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores=Proveedore::Latest()->get();
        $tipos=Tipo::Latest()->get();
        $colores = new Colore();
        return view('colore.create', compact('colores','proveedores','tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Colore::$rules);
        $id=Colore::max('id')+1;
        $tipos_id=$request->tipos_id;
        $proveedores_id=$request->proveedores_id;
        $nomenclatura=$this->generar_nomenclatura($id,$tipos_id,$proveedores_id);
        $lenght_nomenclatura=strlen($nomenclatura);
        if($lenght_nomenclatura!=10)
          {
            exit;
          } 
        $colore = Colore::create
        ([
            'clave' => $request->clave,
            'nomenclatura' => $nomenclatura,
            'descripcion' => $request->descripcion,
            'proveedores_id' => $request->proveedores_id,
            'tipos_id' => $request->tipos_id
        ]);

        return redirect()->route('colores.index')
            ->with('success', 'Color creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $colore = Colore::find($id);

        return view('colore.show', compact('colore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colores = Colore::find($id);
        $proveedores=Proveedore::Latest();
        $tipos=Tipo::Latest()->get();

        return view('colore.edit', compact('colores','proveedores','tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Colore $colore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colore $colore)
    {
        request()->validate(Colore::$rules);

        $colore->update($request->all());

        return redirect()->route('colores.index')
            ->with('success', 'Colore updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $colore = Colore::find($id)->delete();

        return redirect()->route('colores.index')
            ->with('success', 'Colore deleted successfully');
    }
    public function generar_nomenclatura($id,$tipos_id,$proveedores_id){
        $id = sprintf("%05d", $id);
        $proveedores_id= sprintf("%04d", $proveedores_id);
        $nomenclatura=$tipos_id.$proveedores_id.$id;
        return $nomenclatura;



    }
    public function generar_nomenclaturas(){
        $colore=Colore::all();
        foreach( $colore as $row)
        {
            $id = sprintf("%05d", $row->id);
            $proveedores_id= sprintf("%04d", $row->proveedores_id);
            $nomenclatura=$row->tipos_id.$proveedores_id.$id;
            $colore = Colore::find($row->id);
            $colore->nomenclatura = $nomenclatura;
            $colore->save();

        }
       
        return redirect()->route('colores.index')
        ->with('success', 'Nomenclaturas creadas satisfactoriamente.');



    }
}
