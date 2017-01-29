@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>Nomenclature</th>
            <th width="100" class="pull-right">amount</th>
            <th width="75" class="vertical-aligned pull-right small-right-padding no-vertical-paddings">
                <a href="{{ route('department.nomenclature_set.item.create', $nomenclatureSet->id) }}" class="mi-icon use-shadow">add</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->nomenclature->name_for_department }}</td>
            <td class="pull-right">{{ $item->amount }}</td>
            <td class="pull-right no-vertical-paddings small-right-padding vertical-aligned">
                <div class="inline-list pull-right">
                    <a href="{{ route('department.nomenclature_set.item.delete', [$nomenclatureSet->id, $item->id]) }}" class="mi-icon use-shadow">delete</a>
                    <a href="{{ route('department.nomenclature_set.item.edit', [$nomenclatureSet->id, $item->id]) }}" class="mi-icon use-shadow">edit</a>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection