<div class="form-group">
    <div class="col-label">
        {!! Form::label($title, null, ['class' => 'label']) !!}
    </div>
    <div class="col-input">
        @foreach($options as $option)
            {!! \Form::ehRadio($option[0], $option[1] ?? null, $option[2] ?? null, $option[3] ?? null) !!}
        @endforeach
    </div>
</div>
