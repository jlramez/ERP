@extends('adminlte::page')


@section('title', 'Inventarios')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
@section('content_header')
   &nbsp
@stop
@section('plugins.Select', true)

@section('content')
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/inventarios" class="nav-link">Inventarios</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/requeriments" class="nav-link">Órdenes</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/transferens" class="nav-link">Transferencias</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/units" class="nav-link">Unidades</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/locations" class="nav-link">Locaciones</a>
    </li>  
  </ul>
</nav>
    <div class="container-fluid mt-4">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{$name ?? 'Inventario General'}}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('inventarios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                Nuevo Inventario {{ $name ?? 'Inventario General' }}
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
                            <table class="table table-striped table-hover" id="inventario" >
                                <thead class="thead bg-info">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Poducto</th>
                                        <th>Color</th>
                                        <th>Proveedor</th>
                                        <th>Categoría</th>
										<!--<th>Existencia paquetes </th>
										<th>Unidad</th>-->
                                        <th>Existencia</th>
										                    <th>Ubicacion</th>
                                        <th>Disponibilidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventarios as $inventario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $inventario->productos->contenido }}</td>
                                            <td>{{ $inventario->productos->colores->clave}} {{ $inventario->productos->colores->descripcion ?? 'No aplica' }}</td>
											<td>{{ $inventario->productos->marcas->contenido}}
                                            <td>{{ $inventario->productos->tipos->descripcion }}</td>
                                            <!--<td>{{ number_format($inventario->cantidad,2) }}</td>
											<td>{{ $inventario->units->descripcion }}</td>-->
                                            <td>{{ $inventario->piezas }}</td>
											<td>{{ $inventario->locations->descripcion }}</td>
                                            @if (($inventario->piezas/$max*100)<=30)
                                                 <td> <div class="progress">
                                                    <div class="progress-bar bg-danger" style='width:{{($inventario->piezas/$max)*100}}' >{{number_format(($inventario->piezas/$max)*100,2)}} %</div>
                                                </div>
                                            </td>
                                            @endif
                                            @if( (($inventario->piezas/$max)*100>30) && (($inventario->piezas/$max)*100<=60) )
                                            <td> <div class="progress">
                                                    <div class="progress-bar bg-warning" style='width:{{($inventario->piezas/$max)*100}}' >{{number_format(($inventario->piezas/$max)*100,2)}} %</div>
                                                </div>
                                            </td>
                                            @endif
                                            @if (($inventario->piezas/$max)*100 > 60) 
                                            <td> <div class="progress">
                                                    <div class="progress-bar bg-success" style='width:{{($inventario->piezas/$max)*100}}' >{{number_format(($inventario->piezas/$max)*100,2)}} %</div>
                                                </div>
                                            </td>
                                            @endif
                                            <td align="right">
                                                <form action="{{ route('inventarios.destroy',$inventario->id) }}" method="POST">
                                                    <!--<a class="btn btn-sm btn-primary " href="{{ route('inventarios.show',$inventario->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success mex" href="#" title="Transferencia"><i class="fas fa-forward"></i> </a>-->
                                                    <a class="btn btn-sm btn-warning" href="{{ route('inventarios.edit',$inventario->id) }}" title="Editar"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $inventarios->links() !!}
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
        $('#inventario').DataTable();
        responsive: true;
    });
</script>
@endsection
