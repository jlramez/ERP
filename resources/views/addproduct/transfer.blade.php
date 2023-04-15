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
                        <span class="card-title">Transferencia de producto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('addproducts.update_transfer', $addproduct->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('addproduct.formtransfer')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
