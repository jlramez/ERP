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

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Transferencia de productos</span>
                    </div>
                    <div class="card-body">
                            @include('addproduct.listadd')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection