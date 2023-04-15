@extends('adminlte::page')


@section('title', 'Locations')

@section('content_header')
   &nbsp
@stop
@section('plugins.Select', true)

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Nueva Locación</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('locations.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('location.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
