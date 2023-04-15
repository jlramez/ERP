@extends('adminlte::page')

@section('title', 'Agregar productos')

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
                                {{ __('Addproduct') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('addproducts.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Productos Id</th>
										<th>Solicitados</th>
										<th>Transferidos</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($addproducts as $addproduct)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $addproduct->productos_id }}</td>
											<td>{{ $addproduct->solicitados }}</td>
											<td>{{ $addproduct->transferidos }}</td>

                                            <td>
                                                <form action="{{ route('addproducts.destroy',$addproduct->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('addproducts.show',$addproduct->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('addproducts.edit',$addproduct->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $addproducts->links() !!}
            </div>
        </div>
    </div>
@endsection
