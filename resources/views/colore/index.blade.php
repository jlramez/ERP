@extends('adminlte::page')

@section('title', 'Colores')

@section('content_header')
    &nbsp
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row" style="float:right;">

                            <span id="card_title">
                           
                            </span>
                            <div class="from-group" style="float:right; margin:2px;">
                                <a href="{{ route('colore.nomenclaturas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Generar nomenclaturas') }}
                                </a>
                            </div>
                            <div class="from-group" style="float:right; margin:2px;">
                                <a href="{{ route('colores.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nuevo color') }}
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
                            <table class="table table-striped table-hover" id="colors">
                                <thead class="thead bg-info">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Clave</th>
										<th>Nomenclatura</th>
										<th>Descripción</th>										
                                        <th>Producto</th>
                                        <th>Proveedor</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colores as $colore)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $colore->clave }}</td>
											<td>{{ $colore->nomenclatura }}</td>
											<td>{{ $colore->descripcion }}</td>
                                            <td>{{ $colore->tipos->descripcion }}</td>
											<td>{{ $colore->proveedores->descripcion }}</td>

                                            <td align="right">
                                                <form action="{{ route('colores.destroy',$colore->id) }}" method="POST">
                                                    <!--<a class="btn btn-sm btn-primary " href="{{ route('colores.show',$colore->id) }}"><i class="fa fa-fw fa-eye"></i></a>-->
                                                    <a class="btn btn-sm btn-warning" href="{{ route('colores.edit',$colore->id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
                {!! $colores->links() !!}
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
        $('#colors').DataTable();
        responsive: true;
    });
</script>
@endsection