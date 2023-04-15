@extends('adminlte::page')

@section('title', 'Tranferencia a tienda')

@section('content_header')
@stop

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Trade</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('trades.update', $trade->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('trade.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
