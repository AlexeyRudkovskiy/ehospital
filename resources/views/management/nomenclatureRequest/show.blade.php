@extends('layouts.app', [
    'classes' => ['nomenclatureRequest-page'],
])

@section('content')
    {!! Form::open(['method' => 'post']) !!}
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Номенклатура</th>
            <th width="150">Запрошено</th>
            <th width="150">Ед. измерения</th>
            <th width="150">В упаковке</th>
            <th width="150">Доступно</th>
            <th width="250">К выдаче</th>
            <th width="250">Ед. измерения</th>
        </tr>
        </thead>
        <tbody>
        @foreach($requestedData as $key => $item)
        <tr>
            <td><a href="{{ route('nomenclature.show', $item->nomenclature->id) }}" target="_blank">{{ $item->nomenclature->name }}</a></td>
            <td>{{ number_format($item->amount, 2) }}</td>
            <td>{{ $item->unit->text }}</td>
            <td>{{ number_format($item->nomenclature->amount_in_a_package, 2) }}</td>
            <td>{{ number_format($item->balance, 2) }}</td>
            <td class="has-input"><input type="number" step="0.01" class="input" name="nomenclature[{{ $item->nomenclature->id }}][amount]" placeholder="Введите кол-во в это поле" value="{{ $item->accepted }}" @if(!empty($item->accepted)) disabled @endif /></td>
            <td class="has-input">
                <select class="input" name="nomenclature[{{ $item->nomenclature->id }}][unit_id]"  @if(!empty($item->accepted)) disabled @endif>
                    <option value="{{ $item->nomenclature->basicUnit->id }}" @if($item->accepted_unit_id == $item->nomenclature->basicUnit->id) selected @endif>{{ $item->nomenclature->basicUnit->text }}</option>
                    <option value="{{ $item->nomenclature->baseUnit->id }}" @if($item->accepted_unit_id == $item->nomenclature->baseUnit->id) selected @endif>{{ $item->nomenclature->baseUnit->text }}</option>
                </select>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    @if(!$isAccepted)
    <div class="pull-right save-button">
        <input type="submit" class="btn btn-success" value="Сохранить" />
    </div>
    @endif
    {!! Form::close() !!}
@endsection