<?php

namespace App\Http\Controllers;

use App\Models\Requeriment;
use App\Models\Addproduct;
use Illuminate\Http\Request;

/**
 * Class RequerimentController
 * @package App\Http\Controllers
 */
class RequerimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requeriments = Requeriment::paginate();

        return view('requeriment.index', compact('requeriments'))
            ->with('i', (request()->input('page', 1) - 1) * $requeriments->perPage());
    }
    public function listreq()
    {
        $requeriments = Requeriment::paginate();

        $nototalprods=Addproduct::where('requeriments_id',4)->count();
        $nosurtidos=Addproduct::where('requeriments_id',4)->where('transferidos','!=',0)->count();
        if($nototalprods==0)
          {
            $nototalprods=1;
          }
        $surtida=$nosurtidos/$nototalprods;
        return view('requeriment.listreq', compact('surtida','nototalprods','nosurtidos','requeriments'))
            ->with('i', (request()->input('page', 1) - 1) * $requeriments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $requeriment = new Requeriment();
        return view('requeriment.create', compact('requeriment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Requeriment::$rules);

        $requeriment = Requeriment::create($request->all());

        return redirect()->route('requeriments.index')
            ->with('success', 'Requeriment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requeriment = Requeriment::find($id);

        return view('requeriment.show', compact('requeriment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requeriment = Requeriment::find($id);

        return view('requeriment.edit', compact('requeriment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Requeriment $requeriment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requeriment $requeriment)
    {
        request()->validate(Requeriment::$rules);

        $requeriment->update($request->all());

        return redirect()->route('requeriments.index')
            ->with('success', 'Requeriment updated successfully');
    }
    public function check(Request $request, Requeriment $requeriment)
    {
        if ($requeriment->estatus==1)
         {
            $valor=0;
         }
         else
         {
            $valor=1;
         }
        $requeriment->estatus = $valor;
        $requeriment->save();        

        if($requeriment->estatus==1)
        {
        return redirect()->route('requeriments.listreq')
            ->with('success', 'Requisición completada');
        }
        if($requeriment->estatus==0)
        {
        return redirect()->route('requeriments.listreq')
            ->with('success', 'Requisición pendiente');
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $requeriment = Requeriment::find($id)->delete();

        return redirect()->route('requeriments.index')
            ->with('success', 'Requeriment deleted successfully');
    }
}
