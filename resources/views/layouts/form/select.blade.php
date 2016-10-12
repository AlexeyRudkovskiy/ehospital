<div class="form-group">
    <div class="col-label">
        {!! Form::label($title ?? $name, null, ['class' => 'label']) !!}
    </div>
    <div class="col-input">
        {!! Form::select($name, $elements, $current, array_merge([
            'class' => 'input'
        ], $attributes ?? [])) !!}
    </div>
</div>