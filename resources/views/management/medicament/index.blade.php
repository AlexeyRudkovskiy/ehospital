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
                {{ link_to(route('medicament.create'), 'создать', ['class' => 'btn btn-default']) }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($medicaments as $medicament)
            <tr>
                <td>{{ link_to(route('medicament.show', $medicament->id), $medicament->name) }}</td>
                <td>{{ $medicament->small_name }}</td>
                <td>
                    {{ $medicament->amount_in_a_package }}
                </td>
                <td>{{ isset($medicament->atcClassification) ? $medicament->atcClassification->name_ua : '' }}</td>
                <td align="right" style="text-align: right;">
                    <a href="{{ route('medicament.edit', $medicament->id) }}" class="mi-btn mi-btn-small">edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $medicaments->links('layouts.pagination') !!}
@stop