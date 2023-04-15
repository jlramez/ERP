<div class="box box-info padding-1">
    <div class="container"> 
            <div class="row">       
                <div class="form-group col-sm-8">
                    {{ Form::label('contenido') }}
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-comment"></i></span>
                        {{ Form::text('contenido', $producto->contenido, ['class' => 'form-control' . ($errors->has('contenido') ? ' is-invalid' : ''), 'placeholder' => 'Contenido']) }}
                        {!! $errors->first('contenido', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>  
                <div class="form-group col-sm-4 ">
                                    <div>
                                        <label for="categorias" >Categorias</label>
                                    </div> 
                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-check"></i></span>   
                                    <select  name="tipos_id" id="tipos_id" class="form-control">
                                            <option value="{{$producto->tipos->id ?? 0}}">{{$producto->tipos->descripcion ?? '--Seleccione--'}}</option>  
                                            @foreach ($tipos as $row) 
                                            <option  value="{{ $row->id }}">{{$row->descripcion}}</option>
                                            @endforeach
                                        </select>
                        </div> 
                </div> 
            </div>                 
        <div class="row">
                <div class="form-group col-sm-4 ">
                                    <div>
                                        <label for="colores" >Color</label>
                                    </div> 
                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-palette"></i></span>  
                                    <select  name="colores_id" id="colores_id" class="form-control">
                                            <option value="{{$producto->colores->id ?? 0}}" selected>{{$producto->tipos->clave ?? ''}} {{$producto->colores->descripcion ?? '--Seleccione--'}}</option>  
                                            @foreach ($colores as $row) 
                                            <option  value="{{ $row->id }}"> {{ $row->clave }} {{ $row->descripcion }}</option>
                                            @endforeach
                                        </select>
                        </div> 
                </div> 
                                   
                        <div class="form-group col-sm-4">
                                    <div>
                                        <label for="marcas" >Marca</label>
                                    </div> 
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-copyright" ></i></span>
                                        <select  name="marcas_id" id="marcas_id" class="form-control" >
                                                <option value="{{$producto->marcas->id ?? 0}}" selected>{{$producto->marcas->contenido ?? '--Seleccione--'}}</option>  
                                                @foreach ($marcas as $row) 
                                                <option  value="{{ $row->id }}">{{ $row->contenido }}</option>
                                                @endforeach
                                            </select> 
                                    </div> 
                        </div> 
                        <div class="form-group col-sm-4"> 
                            <div>
                                <label for="colores" >Precio</label>
                            </div>      
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                {{ Form::text('precio', number_format($producto->precio,2), ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio $']) }}
                                {!! $errors->first('contenido', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
        </div>
    </div>
    <div class="box-footer mt20" align="right">
        <button type="submit" class="btn btn-primary mt-4">Guardar</button>
    </div>
</div>

<script>
       $(function() {
           $('#colores_id').select2({
           placeholder: 'selecione'
           });
           $('#marcas_id').select2({
           placeholder: 'selecione'
           });
           $('#tipos_id').select2({
           placeholder: 'selecione'
           });
       });
   </script>

       
