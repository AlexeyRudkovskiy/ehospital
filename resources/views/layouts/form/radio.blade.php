<label class="input-radio">
    <div class="wrapper">
        {!! Form::radio($name, $value) !!}
        <span class="wrapper"></span>
    </div>
    <span class="label-text">{{ $label ?? $value }}</span>
</label>