<label class="input-checkbox">
    <div class="wrapper">
        {!! Form::checkbox($name, $value) !!}
        <span class="wrapper"></span>
    </div>
    <span class="label-text">{{ $label ?? $value }}</span>
</label>