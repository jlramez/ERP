@extends('adminlte::page')


@section('title', 'Units')

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
                        <span class="card-title">Create Unit</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('units.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('unit.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
