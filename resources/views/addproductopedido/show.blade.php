@extends('layouts.app')

@section('template_title')
    {{ $addproductopedido->name ?? 'Show Addproductopedido' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Addproductopedido</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('addproductopedidos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Pedidos Id:</strong>
                            {{ $addproductopedido->pedidos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Poductos Id:</strong>
                            {{ $addproductopedido->poductos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $addproductopedido->cantidad }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
