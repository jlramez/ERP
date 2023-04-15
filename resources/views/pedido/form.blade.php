<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
                                    <div>
                                        <label for="proveeedores" >Proveedores</label>
                                    </div> 
                        <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-truck"></i></span>   
                                    <select  name="proveedores_id" id="proveedores_id" class="form-control">
                                            <option value="{{$pedido->proveedores->id ?? 0}}">{{$pedido->proveedores->descripcion ?? '--Seleccione--'}}</option>  
                                            @foreach ($proveedores as $row) 
                                            <option  value="{{ $row->id }}">{{$row->descripcion}}</option>
                                            @endforeach
                                        </select>
                        </div> 
                </div> 
            </div> 
        
        <div class="form-group">
            {{ Form::label('descripcion') }}
            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-comment"></i></span>
                {{ Form::text('descripcion', $pedido->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        
            </div>
        </div>
            <div class="form-group">
            {{ Form::label('fecha') }}
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                {{ Form::date('fecha', $pedido->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

    </div>
    <div class="box-footer mt20" align="right">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>
<script>
        $(function() {
           $('#proveedores_id').select2({
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