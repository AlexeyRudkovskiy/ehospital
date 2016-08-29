<div class="form-group @if($errors->has('firstName')) has-error @endif">
    {!! Form::label('firstName', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('firstName', null, ['class' => 'form-control']) !!}
        @if($errors->has('firstName'))
            <span class="error-block">{{ $errors->first('firstName') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('lastName')) has-error @endif">
    {!! Form::label('lastName', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('lastName', null, ['class' => 'form-control']) !!}
        @if($errors->has('lastName'))
            <span class="error-block">{{ $errors->first('lastName') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('middleName')) has-error @endif">
    {!! Form::label('middleName', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('middleName', null, ['class' => 'form-control']) !!}
        @if($errors->has('middleName'))
            <span class="error-block">{{ $errors->first('middleName') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('phone')) has-error @endif">
    {!! Form::label('phone', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        @if($errors->has('phone'))
            <span class="error-block">{{ $errors->first('phone') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('email')) has-error @endif">
    {!! Form::label('email', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
        @if($errors->has('email'))
            <span class="error-block">{{ $errors->first('email') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('password')) has-error @endif">
    {!! Form::label('password', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::password('password', null, ['class' => 'form-control', 'type' => 'password']) !!}
        @if($errors->has('password'))
            <span class="error-block">{{ $errors->first('password') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('user_position_id')) has-error @endif">
    {!! Form::label('user_position_id', 'Position', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('user_position_id', \App\UserPosition::pluck('name', 'id'), null, ['class' => 'form-control']) !!}
        @if($errors->has('user_position_id'))
            <span class="error-block">{{ $errors->first('user_position_id') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('permission_id')) has-error @endif">
    {!! Form::label('permission_id', 'Permissions', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('permission_id', \App\Permission::pluck('name', 'id'), null, ['class' => 'form-control']) !!}
        @if($errors->has('permission_id'))
            <span class="error-block">{{ $errors->first('permission_id') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('organization_id')) has-error @endif">
    {!! Form::label('organization_id', 'Organization', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('organization_id', \App\Organization::pluck('name', 'id'), null, ['class' => 'form-control']) !!}
        @if($errors->has('organization_id'))
            <span class="error-block">{{ $errors->first('organization_id') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('parent_id')) has-error @endif">
    {!! Form::label('parent_id', 'Parent', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('parent_id', \App\User::pluck('firstName', 'id'), null, ['class' => 'form-control']) !!}
        @if($errors->has('parent_id'))
            <span class="error-block">{{ $errors->first('parent_id') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('department_id')) has-error @endif">
    {!! Form::label('department_id', 'Parent', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('department_id', \App\Department::pluck('name', 'id'), null, ['class' => 'form-control']) !!}
        @if($errors->has('department_id'))
            <span class="error-block">{{ $errors->first('department_id') }}</span>
        @endif
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Schedule:</label>
    <div class="col-sm-10">
        <schedule></schedule>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</div>
