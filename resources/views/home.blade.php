@extends('adminlte::page')
@section('title', __('Dashboard'))
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header"><h5><span class="text-center fa fa-home"></span> @yield('title')</h5></div>
			<div class="card-body">
				<h5>Hola, <strong>{{ Auth::user()->name }},</strong> {{ __('Ingresaste al  ') }}{{ config('app.name', 'Laravel') }}</h5>
				</br> 
				<hr>
								
			<div class="row w-100">
				<div class="col-md-4">
					<div class="small-box bg-info">
						<div class="inner">
							<h3>{{$noproductos}}</h3>
							<p>Productos en existencia</p>
						</div>
						<div class="icon">
							<i class="fas fa-shopping-cart"></i>
						</div>
						<a href="#" class="small-box-footer">
							More info <i class="fas fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="small-box bg-success">
						<div class="inner">
							<h3>$ {{number_format($venta_mes->suma_total,2)}}</h3>
							<p>Ventas del mes</p>
						</div>
						<div class="icon">
							<i class="fas fa-money-bill"></i>
						</div>
						<a href="#" class="small-box-footer">
							More info <i class="fas fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="small-box bg-danger">
						<div class="inner">
							<h3>{{$productosoff}}</h3>
							<p>Productos sin stock</p>
						</div>
						<div class="icon">
						<i class="fas fa-ban"></i>
						</div>
						<a href="#" class="small-box-footer">
							More info <i class="fas fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>							
			</div>
			<div class="row w-100">
				<div class="col-md-4">
					<div class="small-box bg-primary">
						<div class="inner">
							<h3>{{$noproductos_pv}}</h3>
							<p>Productos existentes en piso de venta</p>
						</div>
						<div class="icon">
							<i class="fas fa-check"></i>
						</div>
						<a href="#" class="small-box-footer">
							More info <i class="fas fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="small-box bg-secondary">
						<div class="inner">
							<h3>$ {{number_format($venta_mes_anterior->suma_total,2)}} </h3>
							<p>Ventas del mes anterior</p>
						</div>
						<div class="icon">
							<i class="fas fa-money-bill"></i>
						</div>
						<a href="#" class="small-box-footer">
							More info <i class="fas fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="small-box bg-warning">
						<div class="inner">
							<h3>{{number_format($comparativa_mes_anterior,2)}} %</h3>
							<p>% de venta en comparación al mes anterior</p>
						</div>
						<div class="icon">
							<i class="fas fa-percent"></i>
						</div>
						<a href="#" class="small-box-footer">
							More info <i class="fas fa-arrow-circle-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection