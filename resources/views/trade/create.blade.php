@extends('adminlte::page')

@section('title', 'Tranferencia a tienda')

@section('content_header')
    
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Trade</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('trades.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('trade.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
