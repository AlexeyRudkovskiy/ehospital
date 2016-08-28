@extends('management.layout')

@section('page')
    <table class="table table-striped">
        <thead>
        <tr>
            <th width="75">id</th>
            <th width="200">Название</th>
            <th width="200">Полное название</th>
            <th>Тип</th>
            <th width="150">ЄДРПОУ</th>
            <th width="150" align="right" style="text-align: right;">
                {{ link_to(route('atcClassification.create'), 'создать', ['class' => 'btn btn-default']) }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($contractors as $contractor)
            <tr>
                <td>{{ $contractor->id }}</td>
                <td>{{ $contractor->name }}</td>
                <td>
                    {{ $contractor->fullName }}
                </td>
                <td>{{ $contractor->type }}</td>
                <td>{{ $contractor->edrpou }}</td>
                <td align="right">
                    <a href="{{ route('contractor.edit', $contractor->id) }}">редактировать</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $contractors->render() !!}
@stop