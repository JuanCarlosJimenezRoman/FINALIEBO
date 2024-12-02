<div class="box box-info padding-1">
    <div class="box-body row">
        <!-- Campo de nombre del cliente -->
        <div class="form-group col-md-4">
            <!-- Etiqueta para el campo de nombre -->
            {{ Form::label('nombre') }}

            <!-- Campo de texto para el nombre del cliente, prellenado con el valor actual de $cliente->nombre si existe.
                 Agrega la clase 'is-invalid' si hay un error de validación para mostrar el estilo de error -->
            {{ Form::text('nombre', $cliente->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}

            <!-- Muestra el primer mensaje de error relacionado con el campo 'nombre' si la validación falla -->
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Campo de teléfono del cliente -->
        <div class="form-group col-md-3">
            <!-- Etiqueta para el campo de teléfono -->
            {{ Form::label('telefono') }}

            <!-- Campo de texto para el teléfono del cliente, prellenado con el valor de $cliente->telefono si existe.
                 Agrega la clase 'is-invalid' en caso de error de validación -->
            {{ Form::text('telefono', $cliente->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Teléfono']) }}

            <!-- Muestra el mensaje de error para el campo 'telefono' si la validación falla -->
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Campo de dirección del cliente -->
        <div class="form-group col-md-5">
            <!-- Etiqueta para el campo de dirección -->
            {{ Form::label('direccion') }}

            <!-- Campo de texto para la dirección del cliente, prellenado con el valor de $cliente->direccion si existe.
                 Agrega la clase 'is-invalid' si hay un error de validación -->
            {{ Form::text('direccion', $cliente->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Dirección']) }}

            <!-- Muestra el mensaje de error para el campo 'direccion' si la validación falla -->
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <!-- Footer del formulario con botones para cancelar y enviar -->
    <div class="box-footer mt20 text-right">
        <!-- Botón para cancelar la operación y regresar a la lista de clientes -->
        <a href="/clientes" class="btn btn-danger">{{ __('Cancel') }}</a>

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
