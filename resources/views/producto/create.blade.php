<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
@extends('adminlte::page')


@section('title', 'Productos')

@section('content_header')
   &nbsp
@stop
@section('plugins.Select2', true) 

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header bg-info">
                        <span class="card-title">Nuevo Producto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('productos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('producto.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

