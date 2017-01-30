{!! Form::ehSelect('nomenclature_id', collect($item->id === null ? [] : [$item->nomenclature->id => $item->nomenclature->name]), null, null, [
    'id' => 'nomenclature_id',
    'data-title' => 'Номенклатура',
    'data-subtitle' => "Выберите номенклатуру",
    'data-search' => route('search.nomenclatures'),
    'data-search-placeholder' => 'Введите фразу для поиска номенклатуры',
    'data-empty' => trans('management.global.select.empty'),
    'data-preload' => $item->id !== null ? route('department.nomenclature_set.item.preload', [ $nomenclatureSet->id, $item->id ]) : ''
]) !!}

{!! Form::ehSelect('unit_id', collect([]), null, null, [
    'id' => 'unit_id',
    'data-title' => 'Единица измерения',
    'data-subtitle' => "Выберите еденицу измерения",
    'data-empty' => trans('management.global.select.empty'),
    'data-search-alias' => route('search.units')
]) !!}

{!! Form::ehNumber('amount', null, $item->amount) !!}

{!! Form::ehSave(trans($item->id === null ? 'management.label.create' : 'management.label.save')) !!}