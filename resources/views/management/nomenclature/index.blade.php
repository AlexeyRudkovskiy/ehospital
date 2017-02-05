@extends('layouts.app')

@section('content')
    <div class="grid">
        <div class="col col-fixed-300">
            <div class="tree with-right-padding">
                @each('management.nomenclature.category', \App\NomenclatureCategory::parentless()->get(), 'category')
            </div>
        </div>
        <div class="col">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <th width="150" align="right" style="text-align: right;">
                        {{ link_to(route('nomenclature.create'), 'создать', ['class' => 'btn btn-default']) }}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($nomenclatures as $nomenclature)
                    <tr>
                        <td>{{ link_to(route('nomenclature.show', $nomenclature->id), $nomenclature->name) }}</td>
                        <td align="right" style="text-align: right;">
                            <a href="{{ route('nomenclature.edit', $nomenclature->id) }}" class="mi-btn mi-btn-small">edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $nomenclatures->links('layouts.pagination') !!}
        </div>
    </div>
@stop