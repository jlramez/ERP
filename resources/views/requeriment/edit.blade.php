@extends('adminlte::page')

@section('title', 'Requisición de mercancia')

@section('content_header')
    
@stop

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-info">
                    <div class="card-header">
                        <span class="card-title">Editar requisición</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('requeriments.update', $requeriment->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('requeriment.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
