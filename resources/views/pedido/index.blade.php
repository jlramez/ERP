@extends('adminlte::page')

@section('title', 'Pedido  de mercancia a proveedor')

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
                                {{ __('Pedido') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('pedidos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nuevo pedido') }}
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
                            <table id="pedidos" class="table table-striped table-hover">
                                <thead class="thead bg-info">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Descripcion</th>
                                        <th>Proveedor</th>
										<th>Fecha</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedidos as $pedido)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $pedido->descripcion }}</td>
                                            <td>{{ $pedido->proveedores->descripcion }}</td>
											<td>{{ $pedido->fecha }}</td>

                                            <td align="right">
                                                <form action="{{ route('pedidos.destroy',$pedido->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success " href="{{ route('addproductopedido.report',$pedido->id) }}"><i class="fas fa-file-excel"></i></a>
                                                    <a class="btn btn-sm btn-secondary " href="{{ route('addproductopedido.addproductos', $pedido->id)}}" title="Agregar productos"><i class="fa fa-fw fa-plus"></i></a>

                                                    <a class="btn btn-sm btn-warning" href="{{ route('pedidos.edit',$pedido->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $pedidos->links() !!}
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
        $('#pedidos').DataTable();
        responsive: true;
    });
</script>
@endsection
