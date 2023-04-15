@extends('adminlte::page')

@section('title', 'Transferencia a tienda')

@section('content_header')
    
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Trade') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('trades.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            <table class="table table-striped table-hover">
                                <thead class="thead bg-info">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Descripcion</th>
										<th>Fecha</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trades as $trade)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $trade->descripcion }}</td>
											<td>{{ $trade->fecha }}</td>

                                            <td align="right">
                                                <form action="{{ route('trades.destroy',$trade->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('trades.show',$trade->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-warning" href="{{ route('trades.edit',$trade->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('trades.edit',$trade->id) }}"><i class="fa fa-fw fa-plus"></i></a>
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
                {!! $trades->links() !!}
            </div>
        </div>
    </div>
@endsection
