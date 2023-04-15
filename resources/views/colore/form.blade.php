<div class="box box-info padding-1">
    <div class="container">        
         <div class="row">   
            <div class="form-group col-sm-3 ">
                {{ Form::label('Clave proveedor') }}
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-text-width"></i></span>
                    {{ Form::text('clave', $colores->clave, ['class' => 'form-control' . ($errors->has('clave') ? ' is-invalid' : ''), 'placeholder' => 'Clave']) }}
                    {!! $errors->first('clave', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="form-group col-sm-9">
                {{ Form::label('descripcion') }}
                <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
                    {{ Form::text('descripcion', $colores->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                    {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">  
            <div class="form-group col-sm-6 ">
                                <label for="tipo" >Tipo de producto</label>
                <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-product-hunt"></i></span>
                                    <select name="tipos_id" id="tipos_id" class="form-control">
                                        <option value="{{$colores->tipos->id ?? 0 }}" selected>{{ $colores->tipos->descripcion ?? ' --Seleccione el tipo de producto--'}}</option>  
                                        @foreach ($tipos as $row) 
                                        <option  value="{{ $row->id }}">{{ $row->descripcion }}</option>
                                        @endforeach
                                    </select> 
                </div>
            </div>
            <div class="form-group col-sm-6">
                                <label for="proveedores" >Proveedor</label>
                <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-store"></i></span>
                                    <select name="proveedores_id" id="proveedores_id" class="form-control">
                                        <option value="{{$colores->proveedores->id ?? 0 }}" selected>{{ $colores->proveedores->descripcion ?? ' --Seleccione el proveedor--' }}</option>  
                                        @foreach ($proveedores as $row) 
                                        <option  value="{{ $row->id }}">{{ $row->descripcion }}</option>
                                        @endforeach
                                    </select> 
                </div>
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
           $('#tipos_id').select2({
           placeholder: 'selecione'
           });
       });
   </script>