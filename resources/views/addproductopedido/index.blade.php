@extends('layouts.app')

@section('template_title')
    Addproductopedido
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Addproductopedido') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('addproductopedidos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Pedidos Id</th>
										<th>Poductos Id</th>
										<th>Cantidad</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($addproductopedidos as $addproductopedido)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $addproductopedido->pedidos_id }}</td>
											<td>{{ $addproductopedido->poductos_id }}</td>
											<td>{{ $addproductopedido->cantidad }}</td>

                                            <td>
                                                <form action="{{ route('addproductopedido.delete',$addproductopedido->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('addproductopedidos.show',$addproductopedido->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('addproductopedidos.edit',$addproductopedido->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $addproductopedidos->links() !!}
            </div>
        </div>
    </div>
@endsection
