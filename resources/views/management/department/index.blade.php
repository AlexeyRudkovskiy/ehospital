@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th width="280">Руководитель</th>
            <th width="100">Кол-во коек</th>
            <th width="150" align="right" style="text-align: right;">
                {{ link_to(route('department.create'), 'создать', ['class' => 'btn btn-default']) }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($departments as $department)
            <tr>
                <td>{{ $department->name }}</td>
                <td>{{ isset($department->leader) ? $department->leader->fullName() : '' }}</td>
                <td>{{ $department->beds_amount }}</td>
                <td align="right">
                    <a href="{{ route('department.edit', $department->id) }}">редактировать</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $departments->links('layouts.pagination') !!}
@stop