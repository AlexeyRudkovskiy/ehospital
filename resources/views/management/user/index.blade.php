@extends('management.layout')

@section('page')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ФИО</th>
            <th width="100">Должность</th>
            <th width="150" align="right" style="text-align: right;">
                {{ link_to(route('user.create'), 'создать', ['class' => 'btn btn-default']) }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><a href="{{ route('user.show', $user->id) }}">{{ $user->lastName }} {{ $user->firstName }} {{ $user->middleName }}</a></td>
                <td>
                    {{ isset($user->position) ? $user->position->name : '' }}
                </td>
                <td align="right">
                    <a href="{{ route('user.edit', $user->id) }}">редактировать</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $users->render() !!}
@stop