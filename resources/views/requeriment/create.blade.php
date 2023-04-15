@extends('adminlte::page')

@section('title', 'Requisición de mercancia')

@section('content_header')
    
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-info">
                    <div class="card-header">
                        <span class="card-title">Nueva requisición</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('requeriments.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('requeriment.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
