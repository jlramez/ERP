<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
        <label for="contenido" >Nombre de la marca</label>
            <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-comment"></i></span>
            {{ Form::text('contenido', $marca->contenido, ['class' => 'form-control' . ($errors->has('contenido') ? ' is-invalid' : ''), 'placeholder' => 'Contenido']) }}
            {!! $errors->first('contenido', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="form-group ">
                            <label for="proveedores" >Proveedor</label>
                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-store"></i></span>
                                  <select name="proveedores_id" id="proveedores_id" class="form-control">
                                     <option value="{{$marca->proveedores->id ?? 0}}" selected>{{$marca->proveedores->descripcion ?? '--Seleccione--'}}</option>  
                                     @foreach ($proveedores as $row) 
                                      <option  value="{{ $row->id }}">{{ $row->descripcion }}</option>
                                     @endforeach
                                </select> 
                            </div>
             </div>

    </div>
    <div class="box-footer mt20" align="right">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>