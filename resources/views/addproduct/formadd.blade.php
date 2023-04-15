<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row" >
        
                <div class="form-group col-sm-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                        {{ Form::text('requeriments_id', sprintf("%04d",$requeriments->id), ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''),'readonly' => 'true', 'placeholder' => 'fecha'])}}
                                {!! $errors->first('requeriments_id', '<div class="invalid-feedback">:message</div>') !!}
                    
                    </div>
                </div> 
                <div class="form-group col-sm-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        {{ Form::text('requeriments_date', $requeriments->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''),'readonly' => 'true', 'placeholder' => 'fecha'])}}
                                {!! $errors->first('requeriments_id', '<div class="invalid-feedback">:message</div>') !!}
                    
                    </div>
                </div>        
        </div>
        <div class="row">      
                <div class="form-group col-sm-2">
                    {{ Form::hidden('requeriments_id', $requeriments->id, ['class' => 'form-control' . ($errors->has('requeriments_id') ? ' is-invalid' : ''), 'placeholder' => 'requeriments_id']) }}
                            {!! $errors->first('requeriments_id', '<div class="invalid-feedback">:message</div>') !!}
                        {{ Form::label('cantidad') }}
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                            {{ Form::text('solicitados', $addproduct->solicitados, ['class' => 'form-control' . ($errors->has('solicitados') ? ' is-invalid' : ''), 'placeholder' => '# de  productos']) }}
                            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                </div>  
                <div class="form-group col-sm-10 ">
                                    <div>
                                        <label for="categorias" >Productos</label>
                                    </div> 
                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-product-hunt"></i></span>   
                                    <select  name="productos_id" id="productos_id" class="form-control">
                                            <option value="0"> --Seleccione--</option>  
                                            @foreach ($productos as $row) 
                                            <option  value="{{ $row->id }}">{{$row->contenido}} {{$row->tipos->descripcion}} {{$row->colores->clave}} {{$row->colores->descripcion}}</option>
                                            @endforeach
                                        </select>
                        </div> 
                </div> 
            </div>               
                <div align="right">
                    <button type="submit" class="btn btn-primary mb-4">Guardar</button>
                </div> 
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
        </div> 
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
                                                    <!--<a class="btn btn-sm btn-success " href="{{ route('addproducts.transfer',$addproduct->id) }}" title="Transferir"><i class="fas fa-forward"></i></a>-->
                                                    <a class="btn btn-sm btn-warning" href="{{ route('addproducts.edit',$addproduct->id) }}"><i class="fa fa-fw fa-edit" title="Editar"></i></a>
                                                    <a class="btn btn-sm btn-danger" href="{{ route('addproducts.delete',$addproduct->id) }}"><i class="fa fa-fw fa-trash" title="Eliminar"></i></button>
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