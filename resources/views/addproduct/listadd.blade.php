<div class="box box-info padding-1">
@if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if ($message = Session::get('danger'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
    <div class="box-body">
        <div class="table-responsive mt-4">
                            <table class="table table-striped table-hover">
                                <thead class="thead bg-info">
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
                                            
											<td>{{ $addproduct->productos->contenido }} {{ $addproduct->productos->tipos->descripcion }}
                                            {{ $addproduct->productos->colores->clave }} {{ $addproduct->productos->colores->descripcion }} </td>
											<td>{{ $addproduct->solicitados }}</td>
											<td>{{ $addproduct->transferidos }}</td>
                                            <td align="right">
                                                    
                                            <a class="btn btn-sm btn-danger " href="{{ route('addproducts.cancel',$addproduct->id) }}" title="Regresar mercancia a almacén"><i class="fas fa-backward"></i></a>        
                                            <a class="btn btn-sm btn-success " href="{{ route('addproducts.transfer',$addproduct->id) }}" title="Transferir mercancia"><i class="fas fa-forward"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
        </div>
    </div>
</div>
<script>
       $(function() {
           $('#productos_id').select2({
           placeholder: 'selecione'
           });
           $('#locations_id').select2({
           placeholder: 'selecione'
           });
           $('#units_id').select2({
           placeholder: 'selecione'
           });
       });
   </script>