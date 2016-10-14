@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>ФИО</th>
            <th width="140">Дата рождения</th>
            <th width="140">Отделение</th>
            <th width="120" style="text-align: right;">
                <a href="{{ route('patient.create') }}" class="btn">@lang('management.global.create')</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($patients as $patient)
            <tr>
                <td><a href="{{ route('patient.show', $patient->id) }}">{{ $patient->name }}</a></td>
                <td>{{ $patient->birthday }}</td>
                @if($patient->cures->count() > 0)
                <td><a href="{{ route('department.show', $patient->cures->first()->department->id) }}">{{ $patient->cures->first()->department->name or '' }}</a></td>
                @else
                <td><span class="empty-placeholder">@lang('management.label.patient.noCures')</span></td>
                @endif
                <td align="right" style="text-align: right;">
                    <a href="javascript:" class="mi-btn mi-btn-small mi-background mi-round">edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    {!! $patients->links('layouts.pagination') !!}
@endsection
