@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th width="75">id</th>
            <th>Название</th>
            <th width="250">Название(en.)</th>
            <th width="250">Родительская классификация</th>
            <th width="150" align="right" style="text-align: right;">
                {{ link_to(route('atcClassification.create'), trans('management.global.create'), ['class' => 'btn btn-default']) }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($classifications as $classification)
            <tr>
                <td>{{ $classification->id }}</td>
                <td>{{ $classification->name_ua }}</td>
                <td>
                    {{ $classification->name_en }}
                </td>
                <td>{{ isset($classification->parent) ? $classification->parent->name_ua : '' }}</td>
                <td align="right" style="text-align: right">
                    <a href="{{ route('atcClassification.edit', $classification->id) }}" class="mi-btn mi-btn-small mi-round mi-background">edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $classifications->links('layouts.pagination') !!}
@stop