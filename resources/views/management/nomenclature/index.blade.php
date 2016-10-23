@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th width="200">Короткое название</th>
            <th width="200">Кол-вл в упаковке</th>
            <th width="160">АТС классификация</th>
            <th width="150" align="right" style="text-align: right;">
                {{ link_to(route('nomenclature.create'), 'создать', ['class' => 'btn btn-default']) }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($nomenclatures as $nomenclature)
            <tr>
                <td>{{ link_to(route('nomenclature.show', $nomenclature->id), $nomenclature->name) }}</td>
                <td>{{ $nomenclature->small_name }}</td>
                <td>
                    {{ $nomenclature->amount_in_a_package }}
                </td>
                <td>{{ isset($nomenclature->atcClassification) ? $nomenclature->atcClassification->name_ua : '' }}</td>
                <td align="right" style="text-align: right;">
                    <a href="{{ route('nomenclature.edit', $nomenclature->id) }}" class="mi-btn mi-btn-small">edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $nomenclatures->links('layouts.pagination') !!}
@stop