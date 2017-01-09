<div class="form-group @if($errors->has($name)) has-error @endif ">
    <div class="label">
        {!! Form::label($name, $label, [ ]) !!}
    </div>
    <div class="input-wrapper">
        {!! Form::date($name, $value ?? \Carbon\Carbon::now(), array_merge([
            'class' => 'input'
        ], $attributes ?? [])) !!}
        @if($errors->has($name))
            <div class="message">
                <p>{{ $errors->first($name) }}</p>
            </div>
        @endif
    </div>
</div>