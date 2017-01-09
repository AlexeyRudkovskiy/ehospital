{!! Form::ehText('name') !!}

{!! Form::ehNumber('department_code') !!}

{!! Form::ehNumber('beds_amount') !!}

{!! Form::ehNumber('beds_amount_in_repair') !!}

{!! Form::ehNumber('female_beds_amount') !!}

{!! Form::ehNumber('male_beds_amount') !!}

{!! Form::ehSelect('leader_id', \App\User::pluck('firstName', 'id')) !!}

{!! Form::ehSelect('organization_id', \App\Organization::pluck('name', 'id')) !!}

{!! Form::ehSave() !!}