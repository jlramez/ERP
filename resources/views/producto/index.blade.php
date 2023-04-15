@extends('adminlte::page')

@section('title', 'Productos')
@section('css')


@section('content_header')
   &nbsp
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                            {{ __('Productos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nuevo producto') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="products" class="table table-striped table-hover">
                                <thead class="thead bg-info">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Contenido</th>
										<th>Marcas</th>
										<th>Categoría</th>
                                        <th>Color</th>
                                        <th>Precio</th>
                                        <th>Presentación</th>
                                       

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $producto->contenido }}</td>
											<td>{{ $producto->marcas->contenido }}</td>
											<td>{{ $producto->tipos->descripcion }}</td>
                                            <td>{{ $producto->colores->clave}} {{ $producto->colores->descripcion ?? 'No Aplica'}}</td>
                                            <td>$ {{ number_format($producto->precio,2) }}</td>
                                            <td>presentaciones</td>
                                            <td align="right">
                                                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST">
                                                    <!--<a class="btn btn-sm btn-secondary " href="{{ route('productos.show',$producto->id) }}" title="Ver"><i class="fa fa-fw fa-eye"></i></a>-->
                                                    <a class="btn btn-sm btn-warning" href="{{ route('productos.edit',$producto->id) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--{!! $productos->links() !!}-->
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#products').DataTable();
        responsive: true;
    });
</script>
@endsection