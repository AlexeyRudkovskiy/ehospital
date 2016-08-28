<div class="form-group @if($errors->has('name')) has-error @endif">
    {!! Form::label('name', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @if($errors->has('name'))
            <span class="error-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
</div>
<div class="form-group">
    {!! Form::label('type', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div class="checkbox">
            <label>
                {!! Form::radio('type', 'legal') !!}
                Юридическая
            </label>
            <br>
            <label>
                {!! Form::radio('type', 'private') !!}
                Частная
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</div>