@extends('layouts.app')
@section('title', 'Ventas')
@section('content_header')
    &nbsp
@stop
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-coins text-info"></i>
							Listado de ventas </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Sales">
						</div>
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Nueva venta
						</div>
					</div>
				</div>
				<div class="card-body">
						@include('livewire.sales.modals')
				<div class="table-responsive">
					<table class="table table-striped table-hover table-sm">
						<thead class="thead bg-info">
							<tr> 
								<td>#</td> 
								<th>Descripcion</th>
								<th>Noarticulos</th>
								<th>Subtotal</th>
								<th>Total</th>
								<th>Fecha</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@forelse($sales as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->descripcion }}</td>
								<td>{{ $row->noarticulos }}</td>
								<td>$ {{ number_format($row->subtotal,2) }}</td>
								<td>$ {{ number_format($row->total,2) }}</td>
								<td>{{ $row->fecha }}</td>
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Acciones
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="{{route('addventaproducts.venta', $row->id)}}"><i class="fas fa-tasks"></i> Detalle </a></li>
											<!--<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a></li>-->
											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Sale id {{$row->id}}? \nDeleted Sales cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a></li>  
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
					<div class="float-end">{{ $sales->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>