@extends('management.layout')

@section('page')
    <table class="table table-striped">
        <thead>
        <tr>
            <th width="75">id</th>
            <th>Название</th>
            <th width="150" align="right" style="text-align: right;">
                {{ link_to(route('manufacturer.create'), 'создать', ['class' => 'btn btn-default']) }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($manufacturers as $manufacturer)
            <tr>
                <td>{{ $manufacturer->id }}</td>
                <td>{{ $manufacturer->name }}</td>
                <td align="right">
                    <a href="{{ route('manufacturer.edit', $manufacturer->id) }}">редактировать</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $manufacturers->render() !!}
@stop
