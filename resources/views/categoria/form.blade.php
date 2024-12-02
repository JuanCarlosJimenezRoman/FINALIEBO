<div class="box box-info padding-1">
    <div class="box-body row">
        <div class="form-group col-md-12">
            <!-- Etiqueta para el campo de nombre -->
            {{ Form::label('nombre') }}

            <!-- Campo de texto para el nombre de la categoría, relleno con el valor actual de $categoria->nombre -->
            {{ Form::text('nombre', $categoria->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}

            <!-- Mensaje de error para el campo nombre si ocurre una validación fallida -->
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <!-- Footer del formulario con botones de cancelar y enviar -->
    <div class="box-footer mt20 text-right">
        <!-- Botón para cancelar y volver a la lista de categorías -->
        <a href="/categorias" class="btn btn-danger">{{ __('Cancel') }}</a>

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
