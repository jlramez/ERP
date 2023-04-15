<div class="box box-info padding-1">
    <div class="box-body">
    <div class="row">       
                <div class="form-group col-sm-4">
                    {{ Form::label('cantidad') }}
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                        {{ Form::text('cantidad', $inventario->piezas, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => '# de  productos']) }}
                        {!! $errors->first('contenido', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>  
                <div class="form-group col-sm-8 ">
                                    <div>
                                        <label for="categorias" >Productos</label>
                                    </div> 
                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-product-hunt"></i></span>   
                                    <select  name="productos_id" id="productos_id" class="form-control">
                                            <option value="{{$inventario->productos->id ?? '0'}}">{{$inventario->productos->contenido ?? ''}} 
                                                {{$inventario->productos->tipos->descripcion ?? ''}} {{$inventario->productos->colores->clave ?? ''}} {{$inventario->productos->colores->descripcion ?? '--Seleccione--'}}</option>  
                                            @foreach ($productos as $row) 
                                            <option  value="{{ $row->id }}">{{$row->contenido}} {{$row->tipos->descripcion}} {{$row->colores->clave}} {{$row->colores->descripcion}}</option>
                                            @endforeach
                                        </select>
                        </div> 
                </div> 
            </div>               
       
    </div>
    <div class="row">       
            <div class="form-group col-sm-6 ">
                    <div>
                        <label for="Units" >Unidades</label>
                    </div> 
                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-boxes"></i></span>   
                                    <select  name="units_id" id="units_id" class="form-control">
                                            <option value="{{$inventario->units->id ?? '0'}}">{{$inventario->units->descripcion ?? '--Seleccione--'}}</option>  
                                            @foreach ($units as $row) 
                                            <option  value="{{ $row->id }}">{{$row->descripcion}}</option>
                                            @endforeach
                                        </select>
                    </div> 
            </div>  
                <div class="form-group col-sm-6 ">
                                    <div>
                                        <label for="Locations" >Locación</label>
                                    </div> 
                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-thumbtack"></i></span>   
                                    <select  name="locations_id" id="locarions_id" class="form-control">
                                            <option value="{{$inventario->locationss->id ?? '0'}}">{{$inventario->locations->descripcion ?? '--Seleccione--'}}</option>  
                                            @foreach ($locations as $row) 
                                            <option  value="{{ $row->id }}">{{$row->descripcion}}</option>
                                            @endforeach
                                        </select>
                        </div> 
                </div>        
    </div>
    <div class="box-footer mt20" align="right">
        <button type="submit" class="btn btn-primary">Guardar</button>
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