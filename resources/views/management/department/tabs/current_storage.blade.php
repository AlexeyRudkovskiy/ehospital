<table class="table">
    <thead>
    <tr>
        <th>@lang('management.department.tabs.storage.nomenclature')</th>
        <th width="125" class="pull-right">@lang('management.department.tabs.storage.in_stock')</th>
        <th width="125" class="pull-right">@lang('management.department.tabs.storage.armored')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($storage as $item)
    <tr>
        <td>{{ $item->nomenclature->name }}</td>
        <td class="pull-right">{{ $item->data['in_stock'] }}</td>
        <td class="pull-right">{{ $item->data['armored'] }}</td>
    </tr>
    @endforeach
    </tbody>
</table>


{!! $storage->appends([
    'department_patients_page' => request()->get('department_patients_page', 1),
    'department_users_page' => request()->get('department_users_page', 1),
])->fragment('workers')->links('layouts.pagination') !!}