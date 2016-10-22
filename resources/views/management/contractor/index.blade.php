@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th width="200">Полное название</th>
            <th width="200">Тип</th>
            <th width="150">ЄДРПОУ</th>
            <th width="150" align="right" style="text-align: right;">
                {{ link_to(route('contractor.create'), 'создать', ['class' => 'btn btn-default']) }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($contractors as $contractor)
            <tr>
                <td><a href="{{ route('contractor.show', $contractor->id) }}">{{ $contractor->name }}</a></td>
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

    {!! $contractors->links('layouts.pagination') !!}
@stop