{!! Form::ehText('name') !!}

{!! Form::ehText('fullName') !!}

{!! Form::ehRadioGroup('type', [
    [ 'type', 'legal', 'Legal' ],
    [ 'type', 'private', 'Private' ]
]) !!}

{!! Form::ehNumber('edrpou') !!}

{!! Form::ehSelect('contractor_group_id', \App\ContractorGroup::pluck('name', 'id')) !!}

{!! Form::ehTextarea('description', null, null, [ 'class' => 'input input-textarea-small' ]) !!}

{!! Form::ehText('phone') !!}

{!! Form::ehSave() !!}