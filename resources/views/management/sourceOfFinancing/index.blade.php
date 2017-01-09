@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th width="150" align="right" style="text-align: right;">
                {{ link_to(route('sourceOfFinancing.create'), 'создать', ['class' => 'btn btn-default']) }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td align="right" style="text-align: right;" class="no-paddings">
                <!--<a href="{{ route('sourceOfFinancing.edit', $item->id) }}" class="mi-btn mi-btn-small mi-round mi-background">edit</a>
                    -->{!! Form::open(['route' => ['sourceOfFinancing.destroy', $item->id], 'method' => 'delete', 'style' => 'display: inline-block;']) !!}<a href="javascript:" class="mi-btn mi-btn-small mi-btn-danger mi-round mi-background" onclick="this.parentElement.submit()">delete</a>{!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $items->links('layouts.pagination') !!}

@endsection