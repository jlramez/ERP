<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
@extends('adminlte::page')

@section('title', 'Agregar productos')

@section('content_header')
  &nbsp
@stop
@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-info">
                    <div class="card-header">
                        <span class="card-title">Actualizar pedido proveedor</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('addproductopedidos.update', $addproductopedido->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('addproductopedido.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
