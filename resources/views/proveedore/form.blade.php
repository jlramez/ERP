<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
        <div>
            <label for="colores" >Nombre del proveedor</label>
        </div> 
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comment"></i></span>  
                {{ Form::text('descripcion', $proveedore->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

    </div>
    <div class="box-footer mt20" align="right">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>