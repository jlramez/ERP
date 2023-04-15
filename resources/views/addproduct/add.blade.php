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
                        <span class="card-title">Agregar productos a requisicion</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('addproducts.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('addproduct.formadd')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection