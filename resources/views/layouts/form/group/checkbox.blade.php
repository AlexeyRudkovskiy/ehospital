<div class="form-group label-force-top">
    <div class="label no-top-padding">
        {!! Form::label($title, null, [ ]) !!}
    </div>
    <div class="input-wrapper checkbox-group">
        @foreach($options as $option)
            {!! \Form::ehCheckbox($option[0], $option[1] ?? null, $option[2] ?? null, $option[3] ?? null) !!}
        @endforeach
    </div>
</div>
