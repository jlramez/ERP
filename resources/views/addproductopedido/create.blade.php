@extends('adminlte::page')

@section('title', 'Agregar productos')

@section('content_header')
  &nbsp
@stop
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-info">
                    <div class="card-header">
                        <span class="card-title">Create Addproductopedido</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('addproductopedidos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('addproductopedido.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
