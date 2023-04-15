@extends('layouts.app')
@section('title', __('Reporte de venta'))
@section('content_header')
    &nbsp
@stop

<div class="box box-info padding-1">
    <div class="container col-sm-12"> 
        <div class="card">
			<div class="card-header bg bg-info">							
								<div class="float-left">
									<h4><i class="fas fa-circle-info"></i>   Información del reporte de venta </h4>
								</div>							
			</div>
			<div class="card-body" align="center">   
			      <div class="row" >
                            <div class="form-group col-sm-6">
                                <label for="Tipo de información">Fecha inicial</label>
                                <input wire:model="fecha_inicial" type="date" class="form-control" id="fecha_inicial" placeholder="Fecha inicial">@error('fecha_inicial') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="Tipo de información">Fecha final</label>
                                <input wire:model="fecha_final" type="date" class="form-control" id="fecha_final" placeholder="Fecha final">@error('fecha_final') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                    </div>      
            </div>
           <!-- <div class="modal-footer">
                <button type="button" wire:click.prevent="calcular()" class="btn btn-primary">Consultar</button>
            </div>  -->
            <div class="row" >
                <div class="card col-sm-4">
                    <div class="card-header bg bg-info">
                        Productos más vendidos
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead ">
                                    <tr> 
                                        <td>#</td> 
                                        <th>Producto</th>
                                        <th># Ventas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($productos as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> 
                                        <td><i class="fas fa-medal"></i> {{ $row->productos->contenido}} {{ $row->productos->tipos->descripcion}} {{ $row->productos->colores->descripcion}}</td> 
                                        <td>{{ $row->total }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">No data Found </td>
                                    </tr>
                                    @endforelse
                                </tbody>
					        </table>
                        </div>
                    </div>

                </div>
                <div class="card col-sm-4">
                    <div class="card-header bg bg-info">
                        Ventas $ mas altas
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead ">
                                    <tr> 
                                        <td>#</td> 
                                        <th>Monto</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ventas as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> 
                                        <td><i class="fas fa-medal"></i> $ {{number_format($row->total ?? '',2)}}</td> 
                                        <td>{{ $row->fecha ?? ''}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">No data Found </td>
                                    </tr>
                                    @endforelse
                                </tbody>
					        </table>
                        </div>
                    </div>

                </div>
                <div class="card col-sm-4">
                    <div class="card-header bg bg-info">
                        Venta por rango de fecha
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead ">
                                    <tr> 
                                        
                                        <th>Fecha inicial</th>
                                        <th>Fecha final</th>
                                        <th>Monto Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                        <td>{{$fecha_1 ?? ''}}</td>
                                        <td>{{$fecha_2 ?? ''}}</td>
                                        <td>$ {{number_format($venta_rango->suma_total ?? '0',2)}}</td> 
                                       
                                    </tr>
                                </tbody>
					        </table>
                        </div>
                    </div>

                </div>
                
            </div>
            <div class="row" >
            <div class="card col-sm-4">
                    <div class="card-header bg bg-info">
                        Venta del día
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead ">
                                    <tr> 
                                        
                                        <th># Artículos</th>
                                        <th>Monto Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                        <td>{{$venta_hoy->suma_articulos ?? ''}}</td>
                                        <td>$ {{number_format($venta_hoy->suma_total ?? '0',2)}}</td> 
                                       
                                    </tr>
                                </tbody>
					        </table>
                        </div>
                    </div>

                </div>
                <div class="card col-sm-4">
                    <div class="card-header bg bg-info">
                        Venta del mes
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead ">
                                    <tr> 
                                        
                                        <th># Artículos</th>
                                        <th>Monto Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                        <td>{{$venta_mes->suma_articulos ?? '0'}}</td>
                                        <td>$ {{number_format($venta_mes->suma_total ?? '0',2)}}</td> 
                                       
                                    </tr>
                                </tbody>
					        </table>
                        </div>
                    </div>
                </div>
                <div class="card col-sm-4">
                    <div class="card-header bg bg-info">
                        Venta del año (actual)
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead ">
                                    <tr> 
                                        
                                        <th># Artículos</th>
                                        <th>Monto Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                        <td>{{$venta_year->suma_articulos ?? '0'}}</td>
                                        <td>$ {{number_format($venta_year->suma_total ?? '0',2)}}</td> 
                                       
                                    </tr>
                                </tbody>
					        </table>
                        </div>
                    </div>

                </div>
            </div>
                
		</div>
	</div> 
</div>
