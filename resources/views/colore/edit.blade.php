@extends('adminlte::page')

@section('title', 'Colores de prodcutos')

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
                        <span class="card-title">Editar color</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('colores.update', $colores->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('colore.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
