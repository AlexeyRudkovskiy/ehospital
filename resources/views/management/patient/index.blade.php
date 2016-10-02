@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>ФИО</th>
            <th>Дата рождения</th>
            <th>Отделение</th>
            <th width="100"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($patients as $patient)
            <tr>
                <td><a href="{{ route('patient.show', $patient->id) }}">{{ $patient->name }}</a></td>
                <td>{{ $patient->birthday }}</td>
                <td><a href="{{ route('department.show', $patient->cures->first()->department->id) }}">{{ $patient->cures->first()->department->name or '' }}</a></td>
                <td align="right" style="text-align: right;">
                    <a href="javascript:" class="mi-btn mi-btn-small">edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
