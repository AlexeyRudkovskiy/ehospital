<div class="form-group @if($errors->has('name')) has-error @endif">
    {!! Form::label('name', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @if($errors->has('name'))
            <span class="error-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('department_code')) has-error @endif">
    {!! Form::label('department_code', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::number('department_code', null, ['class' => 'form-control']) !!}
        @if($errors->has('department_code'))
            <span class="error-block">{{ $errors->first('department_code') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('beds_amount')) has-error @endif">
    {!! Form::label('beds_amount', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::number('beds_amount', null, ['class' => 'form-control']) !!}
        @if($errors->has('beds_amount'))
            <span class="error-block">{{ $errors->first('beds_amount') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('beds_amount_in_repair')) has-error @endif">
    {!! Form::label('beds_amount_in_repair', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::number('beds_amount_in_repair', null, ['class' => 'form-control']) !!}
        @if($errors->has('beds_amount_in_repair'))
            <span class="error-block">{{ $errors->first('beds_amount_in_repair') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('female_beds_amount')) has-error @endif">
    {!! Form::label('female_beds_amount', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::number('female_beds_amount', null, ['class' => 'form-control']) !!}
        @if($errors->has('female_beds_amount'))
            <span class="error-block">{{ $errors->first('female_beds_amount') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('male_beds_amount')) has-error @endif">
    {!! Form::label('male_beds_amount', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::number('male_beds_amount', null, ['class' => 'form-control']) !!}
        @if($errors->has('male_beds_amount'))
            <span class="error-block">{{ $errors->first('male_beds_amount') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('leader_id')) has-error @endif">
    {!! Form::label('leader_id', 'Leader', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('leader_id', \App\User::pluck('firstName', 'id'), null, ['placeholder' => 'Empty', 'class' => 'form-control']) !!}
        @if($errors->has('leader_id'))
            <span class="error-block">{{ $errors->first('leader_id') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('organization_id')) has-error @endif">
    {!! Form::label('organization_id', 'Organization', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('organization_id', \App\Organization::pluck('name', 'id'), null, ['placeholder' => 'Empty', 'class' => 'form-control']) !!}
        @if($errors->has('organization_id'))
            <span class="error-block">{{ $errors->first('organization_id') }}</span>
        @endif
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</div>