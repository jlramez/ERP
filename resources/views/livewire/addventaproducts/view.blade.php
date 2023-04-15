@extends('layouts.app')
@section('title', __('Detalle venta'))
@section('content_header')
    &nbsp
@stop

<div class="box box-info padding-1">
    <div class="container col-sm-12"> 
        <div class="card">
			<div class="card-header bg bg-info">							
								<div class="float-left">
									<h4><i class="fas fa-coins"></i> Información de la venta </h4>
								</div>							
			</div>
			<div class="card-body">   
				<div class="row">       
						<div class="form-group col-sm-4">
							{{ Form::label('Fecha') }}
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-calendar"></i></span>
								{{ Form::text('contenido', $sales->fecha, ['class' => 'form-control' . ($errors->has('contenido') ? ' is-invalid' : ''), 'placeholder' => 'Contenido']) }}
								{!! $errors->first('contenido', '<div class="invalid-feedback">:message</div>') !!}
							</div>
						</div>
						<div class="form-group col-sm-4">
							{{ Form::label('Sucursal') }}
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-store"></i></span>
								{{ Form::text('contenido', $sales->locations->descripcion, ['class' => 'form-control' . ($errors->has('contenido') ? ' is-invalid' : ''), 'placeholder' => 'Contenido']) }}
								{!! $errors->first('contenido', '<div class="invalid-feedback">:message</div>') !!}
							</div>
						</div>  
						<div class="form-group col-sm-4">
							{{ Form::label('TC#') }}
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-hashtag"></i></span>
								{{ Form::text('id', sprintf("%05d",$sales->id), ['class' => 'form-control' . ($errors->has('contenido') ? ' is-invalid' : ''), 'placeholder' => 'Contenido']) }}
								{!! $errors->first('contenido', '<div class="invalid-feedback">:message</div>') !!}
							</div>
						</div> 
				</div>
				<div class="row">       
						<div class="form-group col-sm-4">
							{{ Form::label('#Artículos') }}
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-hashtag"></i></span>
								{{ Form::text('contenido', $sales->noarticulos, ['class' => 'form-control' . ($errors->has('contenido') ? ' is-invalid' : ''), 'placeholder' => 'Contenido']) }}
								{!! $errors->first('contenido', '<div class="invalid-feedback">:message</div>') !!}
							</div>
						</div>
						<div class="form-group col-sm-4">
							{{ Form::label('Subtotal') }}
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
								{{ Form::text('contenido', number_format($sales->subtotal,2 ?? '0.00'), ['class' => 'form-control' . ($errors->has('contenido') ? ' is-invalid' : ''), 'placeholder' => 'Contenido']) }}
								{!! $errors->first('contenido', '<div class="invalid-feedback">:message</div>') !!}
							</div>
						</div>  
						<div class="form-group col-sm-4">
							{{ Form::label('total') }}
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
								{{ Form::text('id',number_format($sales->total,2 ?? '0.00'), ['class' => 'form-control' . ($errors->has('contenido') ? ' is-invalid' : ''), 'placeholder' => 'Contenido']) }}
								{!! $errors->first('contenido', '<div class="invalid-feedback">:message</div>') !!}
							</div>
						</div> 
				</div>                   
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div style="display: flex; justify-content: space-between; align-items: center;">
							<div class="float-left">
								<h4><i class="fas fa-boxes"></i> Productos de la venta </h4>
							</div>
							@if (session()->has('message'))
							<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
							@endif
							<div>
								<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar producto en venta">
							</div>
							<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
							<i class="fa fa-plus"></i>  Add Addventaproducts 
							</div>
						</div>
					</div>
					
					<div class="card-body">
							@include('livewire.addventaproducts.modals')
					<div class="table-responsive">
						<table class="table table-striped table-hover table-sm">
							<thead class="thead bg-color bg-info">
								<tr> 
									<td>#</td> 
									<th>#TC</th>
									<th>Unidad</th>
									<th>Cantidad</th>
									<th>Productos</th>
									<th>Venta $</th>
									<th>Precio unitario</th>
									<td>ACTIONS</td>
								</tr>
							</thead>
							<tbody>
								@forelse($addventaproducts as $row)
								<tr>
									<td>{{ $loop->iteration }}</td> 
									<td>{{ $row->sales_id }}</td>
									<td>{{ $row->units->descripcion}}</td>
									<td>{{ $row->cantidad }}</td>
									<td>{{ $row->productos->contenido }} {{ $row->productos->tipos->descripcion }} {{ $row->productos->colores->clave }} {{ $row->productos->colores->descripcion }}</td>
									<td>$ {{number_format($row->productos->precio*$row->cantidad,2)}}</td>
									<td>$ {{$row->productos->precio}}</td>
									<td width="90">
										<div class="dropdown">
											<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
												Actions
											</a>
											<ul class="dropdown-menu">
												<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a></li>
												<li><a class="dropdown-item" onclick="confirm('Confirm Delete Addventaproduct id {{$row->id}}? \nDeleted Addventaproducts cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a></li>  
											</ul>
										</div>								
									</td>
								</tr>
								@empty
								<tr>
									<td class="text-center" colspan="100%">No data Found </td>
								</tr>
								@endforelse
							</tbody>
						</table>						
						<div class="float-end">{{ $addventaproducts->links() }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>