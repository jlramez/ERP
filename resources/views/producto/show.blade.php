@extends('layouts.app')

@section('template_title')
    {{ $producto->name ?? 'Show Producto' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('productos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Contenido:</strong>
                            {{ $producto->contenido }}
                        </div>
                        <div class="form-group">
                            <strong>Marcas Id:</strong>
                            {{ $producto->marcas_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tipos Id:</strong>
                            {{ $producto->tipos_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
