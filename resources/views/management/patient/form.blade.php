<!-- ФИО -->
{!! Form::ehText('name') !!}

<!-- Телефон -->
{!! Form::ehText('phone') !!}

<!-- Опции(украинец или нет, работник больницы, бездомный или нет) -->
{!! Form::ehCheckboxGroup('&nbsp;', [
    [ 'ukrainian', true, trans('management.label.patient.ukrainian') ],
    [ 'homeless', true, trans('management.label.patient.homeless') ],
    [ 'hospital_employee', true, trans('management.label.patient.hospital_employee') ]
]) !!}

<!-- Дата рождения -->
{!! Form::ehDate('birthday') !!}

{!! Form::ehSave() !!}