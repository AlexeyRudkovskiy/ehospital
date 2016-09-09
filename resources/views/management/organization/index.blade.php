@extends('layouts.app')

@section('content')
    <table class="table table-striped table-last-td-pull-right">
        <thead>
        <tr>
            <th>Название</th>
            <th width="100">Тип</th>
            <th width="150" align="right" style="text-align: right;">
                {{ link_to(route('organization.create'), 'создать', ['class' => 'btn btn-default']) }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($organizations as $organization)
            <tr>
                <td>{{ $organization->name }}</td>
                <td>
                    @lang('management.organization.type.' . $organization->type)
                </td>
                <td align="right">
                    <a href="{{ route('organization.edit', $organization->id) }}">редактировать</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $organizations->links('layouts.pagination') !!}
@stop

{{--@push('breadcrumbs-right')--}}
    {{--<a href="javascript:" class="btn btn-small btn-success">create new item</a>--}}
{{--@endpush--}}