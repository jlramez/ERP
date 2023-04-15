<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('pedidos_id') }}
            {{ Form::text('pedidos_id', $addproductopedido->pedidos_id, ['class' => 'form-control' . ($errors->has('pedidos_id') ? ' is-invalid' : ''), 'placeholder' => 'Pedidos Id']) }}
            {!! $errors->first('pedidos_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <div>
                <label for="categorias" >Productos</label>
            </div>            
            <select  name="productos_id" id="productos_id" class="form-control">
                    <option value="{{$addproductopedido->productos->id ?? '0'}}"> {{$addproductopedido->productos->contenido}} {{$addproductopedido->productos->tipos->descripcion}} {{$addproductopedido->productos->colores->clave}} {{$addproductopedido->productos->colores->descripcion ?? '--Seleccione--'}}</option>  
                    @foreach ($productos as $row) 
                    <option  value="{{ $row->id }}">{{$row->contenido}} {{$row->tipos->descripcion}} {{$row->colores->clave}} {{$row->colores->descripcion}}</option>
                    @endforeach
            </select>                        
        </div>
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $addproductopedido->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20" align="right">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>
<script>
       $(function() 
       {
           $('#productos_id').select2({
           placeholder: 'selecione'
           });
           
       });
   </script>