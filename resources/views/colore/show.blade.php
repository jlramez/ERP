@extends('adminlte::page')

@section('title', 'Colores

@section('content_header')
    <h1>Mostrar color</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostar colores</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('colores.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Clave:</strong>
                            {{ $colore->clave }}
                        </div>
                        <div class="form-group">
                            <strong>Nomenclatura:</strong>
                            {{ $colore->nomenclatura }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $colore->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Proveedores Id:</strong>
                            {{ $colore->proveedores_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
