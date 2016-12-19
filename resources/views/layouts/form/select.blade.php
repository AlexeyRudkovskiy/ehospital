<div class="form-group">
    <div class="label">
        {!! Form::label($title ?? $name, null, [ ]) !!}
    </div>
    <div class="input-wrapper">
        {!! Form::select($name, $elements, $current, array_merge([
            'class' => 'input'
        ], $attributes ?? [])) !!}
    </div>
</div>