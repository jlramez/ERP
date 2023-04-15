<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
@extends('adminlte::page')


@section('title', 'Inventarios')

@section('content_header')
   &nbsp
@stop
@section('plugins.Select', true)

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-info">
                    <div class="card-header">
                        <span class="card-title">Actualizar Inventario piso de venta</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('inventarios.update', $inventario->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('inventario.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
