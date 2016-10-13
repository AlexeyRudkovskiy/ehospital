{!! Form::ehText('firstName', 'First name') !!}
{!! Form::ehText('lastName', 'Last name') !!}
{!! Form::ehText('middleName', 'Middle name') !!}
{!! Form::ehText('phone', 'Phone') !!}
{!! Form::ehText('email', 'email') !!}
{!! Form::ehText('password', 'Password') !!}
{!! Form::ehSelect('user_position_id', \App\UserPosition::pluck('name', 'id'), 'Position') !!}
{!! Form::ehSelect('permission_id', \App\Permission::pluck('name', 'id'), 'Permissions') !!}
{!! Form::ehSelect('organization_id', \App\Organization::pluck('name', 'id'), 'Organization') !!}
{!! Form::ehSelect('parent_id', \App\User::pluck('firstName', 'id'), 'Parent') !!}
{!! Form::ehSelect('department_id', \App\Department::pluck('name', 'id'), 'Department') !!}

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
