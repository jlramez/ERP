@extends('adminlte::page')


@section('title', 'Units')

@section('content_header')
   &nbsp
@stop
@section('plugins.Select', true)

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Unit</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('units.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $unit->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Piezas:</strong>
                            {{ $unit->piezas }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
