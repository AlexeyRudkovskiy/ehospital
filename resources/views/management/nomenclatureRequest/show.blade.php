@extends('layouts.app', [
    'classes' => ['nomenclatureRequest-page'],
])

@section('content')
    {!! Form::open(['method' => 'post', 'class' => 'nomenclature_request']) !!}
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Номенклатура</th>
            <th width="150">Запрошено</th>
            <th width="150">Доступно</th>
            <th width="150">Ед. измерения</th>
            <th width="250">К выдаче</th>
        </tr>
        </thead>
        <tbody>
        @foreach($requestedData as $key => $item)
        <tr>
            <td><a href="{{ route('nomenclature.show', $item->nomenclature->id) }}" target="_blank">{{ $item->nomenclature->name }}</a></td>
            <td>{{ number_format($item->amount, 2) }}</td>
            <td>{{ $item->balance }}</td>
            <td>{{ $item->nomenclature->basicUnit->text }}</td>
            @if(!$isAccepted)
            <td class="has-input">{!! Form::text('nomenclature[' . $item->nomenclature->id . ']', null, ['placeholder' => 'введите значение']) !!}</td>
            @else
            <td>
                {!! $accepted[$item->nomenclature->id] !!}
            </td>
            @endif
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