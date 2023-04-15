<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="form-group col-sm-12">
                {{ Form::label('Producto') }}
                    {{ Form::hidden('productos_id', $addproduct->productos->id, ['class' => 'form-control' . ($errors->has('productos_id') ? ' is-invalid' : ''), 'placeholder' => 'Producto_id']) }}
                     <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-product-hunt"></i></span>   
                                    <select  name="productos_id" id="productos_id" class="form-control" disabled>
                                            <option value="{{$addproduct->productos->id ?? '0'}}"> {{$addproduct->productos->contenido ?? ''}} {{$addproduct->productos->tipos->descripcion ?? ''}} {{$addproduct->productos->colores->clave ?? ''}} {{$addproduct->productos->colores->descripcion ?? '--Seleccione--'}}</option>  
                                            @foreach ($productos as $row) 
                                            <option  value="{{ $row->id }}">{{$row->contenido}} {{$row->tipos->descripcion}} {{$row->colores->clave}} {{$row->colores->descripcion}}</option>
                                            @endforeach
                                        </select>
                        </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                {{ Form::label('solicitados') }}
                {{ Form::text('solicitados', $addproduct->solicitados, ['class' => 'form-control' . ($errors->has('solicitados') ? ' is-invalid' : ''), 'readonly' => 'true', 'placeholder' => 'Solicitados']) }}
                {!! $errors->first('solicitados', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {{ Form::label('transferidos') }}
                {{ Form::text('transferidos', $addproduct->transferidos, ['class' => 'form-control' . ($errors->has('transferidos') ? ' is-invalid' : ''),'placeholder' => 'Transferidos']) }}
                {!! $errors->first('transferidos', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

    </div>
    <div align="right">
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