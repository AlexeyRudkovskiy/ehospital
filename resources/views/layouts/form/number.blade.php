<div class="form-group @if($errors->has($name)) has-error @endif ">
    <div class="col-label">
        {!! Form::label($name, $label, ['class' => 'label']) !!}
    </div>
    <div class="col-input">
        {!! Form::number($name, $value, array_merge([
            'class' => 'input'
        ], $attributes ?? [])) !!}
        @if($errors->has($name))
            <div class="message">
                <p>{{ $errors->first($name) }}</p>
            </div>
        @endif
    </div>
</div>