<label>
    {!! Form::checkbox($name, $value) !!}
    <span class="input-wrapper"></span>
    <span class="input-label">{{ $label ?? $value }}</span>
</label>