<div class="form-group @if($errors->has('name_ua')) has-error @endif">
    {!! Form::label('name_ua', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name_ua', null, ['class' => 'form-control']) !!}
        @if($errors->has('name_ua'))
            <span class="error-block">{{ $errors->first('name_ua') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('name_en')) has-error @endif">
    {!! Form::label('name_en', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name_en', null, ['class' => 'form-control']) !!}
        @if($errors->has('name_en'))
            <span class="error-block">{{ $errors->first('name_en') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('parent_id')) has-error @endif">
    {!! Form::label('parent_id', 'Parent', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('parent_id', \App\AtcClassification::pluck('name_en', 'id'), null, ['placeholder' => 'Empty', 'class' => 'form-control']) !!}
        @if($errors->has('parent_id'))
            <span class="error-block">{{ $errors->first('parent_id') }}</span>
        @endif
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</div>