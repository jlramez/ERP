@extends('adminlte::page')

@section('title', 'Requisición de mercancia')

@section('content_header')
  &nbsp
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Requisición de mercancia') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('requeriments.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                            <table class="table table-striped table-hover" id="requeriments">
                                <thead class="Thead bg-info">
                                    <tr>
                                        <th >No</th>                                        
										<th>Descripcion</th>
										<th>Fecha</th>
                                        <th>Estátus</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requeriments as $requeriment)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $requeriment->descripcion }}</td>
											<td>{{ $requeriment->fecha }}</td>
                                            @if ($requeriment->estatus==0)
                                            <td><span class="badge badge-danger">Pendiente</span></td>
                                            @endif
                                            @if ($requeriment->estatus==1)
                                            <td><span class="badge badge-success">Completada</span></td>
                                            @endif
                                            <td align="right">
                                                <form action="{{ route('requeriments.destroy',$requeriment->id) }}" method="POST">
                                                    <!--<a class="btn btn-sm btn-primary " href="{{ route('requeriments.show',$requeriment->id) }}" title="Ver detalle"><i class="fa fa-fw fa-eye"></i></a>-->
                                                    <a class="btn btn-sm btn-success " href="{{ route('addproducts.add', $requeriment->id)}}" title="Agregar productos"><i class="fa fa-fw fa-plus"></i></a>
                                                    <a class="btn btn-sm btn-warning" href="{{ route('requeriments.edit',$requeriment->id) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
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
                {!! $requeriments->links() !!}
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
        $('#requeriments').DataTable();
        responsive: true;
    });
</script>
@endsection