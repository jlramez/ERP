@extends('adminlte::page')


@section('title', 'Inventarios')

@section('content_header')
   &nbsp
@stop
@section('plugins.Select', true)
@section('template_title')
    {{ $inventario->name ?? 'Show Inventario' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Inventario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('inventarios.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Poductos Id:</strong>
                            {{ $inventario->poductos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $inventario->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Units Id:</strong>
                            {{ $inventario->units_id }}
                        </div>
                        <div class="form-group">
                            <strong>Locations Id:</strong>
                            {{ $inventario->locations_id }}
                        </div>
                        <div class="form-group">
                            <strong>Uodated At:</strong>
                            {{ $inventario->uodated_at }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
