@extends('management.layout')

@section('page')
    @php($days = [ 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun' ])
    <div>
        <h3>{{ $user->lastName }} {{ $user->firstName }} {{ $user->middleName }}</h3>
    </div>
    <table class="table">
        <tr>
            <td width="100">Phone:</td>
            <td>{{ $user->phone }}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Position:</td>
            <td>{{ isset($user->position) ? $user->position->name : '' }}</td>
        </tr>
        <tr>
            <td>Parent:</td>
            <td>{{ isset($user->parent) ? $user->parent->fullName() : '' }}</td>
        </tr>
    </table>
    <h3>График работы:</h3>
    <table class="table">
        @foreach($user->schedule as $schedule)
        <tr>
            <td width="100">{{ $days[$schedule->day_of_week - 1] }}</td>
            <td>
                <p>
                    {{ $schedule->from }} - {{ $schedule->to }}
                </p>
                <p>На пациента отведено: {{ $schedule->per_patient }}</p>
            </td>
        </tr>
        @endforeach
    </table>
@stop