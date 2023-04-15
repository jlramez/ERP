@extends('adminlte::page')

@section('title', 'Agregar productos')

@section('content_header')
  &nbsp
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Addproduct</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('addproducts.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Productos Id:</strong>
                            {{ $addproduct->productos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Solicitados:</strong>
                            {{ $addproduct->solicitados }}
                        </div>
                        <div class="form-group">
                            <strong>Transferidos:</strong>
                            {{ $addproduct->transferidos }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
