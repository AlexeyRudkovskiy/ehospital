{!! Form::ehText('name_ua') !!}

{!! Form::ehText('name_en') !!}

{!! Form::ehCheckboxGroup(trans('management.label.atcClassification.noParentCategory'), [
    [ 'has_parent_category', 'yes', trans('management.global.yes') ]
]) !!}

{!! Form::ehSelect('parent_id', \App\AtcClassification::pluck('name_en', 'id')) !!}

{!! Form::ehSave() !!}
