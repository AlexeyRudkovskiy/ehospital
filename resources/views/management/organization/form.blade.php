{!! Form::ehText('name', trans('management.label.organization.name')) !!}

{!! Form::ehRadioGroup(trans('management.label.organization.type'), [
    ['type', 'legal', trans('management.label.organization.legal')],
    ['type', 'private', trans('management.label.organization.private')]
]) !!}

{!! Form::ehSave() !!}