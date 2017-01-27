{!! Form::ehSelect('nomenclature_id', collect($item->id === null ? [] : [$item->nomenclature->id => $item->nomenclature->name]), null, null, [
    'data-title' => 'Номенклатура',
    'data-subtitle' => "Выберите номенклатуру",
    'data-search' => route('search.nomenclatures'),
    'data-search-placeholder' => 'Введите фразу для поиска номенклатуры',
    'data-empty' => trans('management.global.select.empty'),
    'data-preload' => $item->id !== null ? route('department.nomenclature_set.item.preload', [ $nomenclatureSet->id, $item->id ]) : ''
]) !!}

{!! Form::ehNumber('amount') !!}

{!! Form::ehSave(trans($item->id === null ? 'management.label.create' : 'management.label.save')) !!}