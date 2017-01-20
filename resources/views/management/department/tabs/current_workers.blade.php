<table class="table">
    <thead>
    <tr>
        <th>@lang('management.department.tabs.workers.name')</th>
        <th width="150">@lang('management.department.tabs.workers.position_name')</th>
        <th width="185" class="pull-right">@lang('management.department.tabs.workers.current_cures_count')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->fullName() }}</td>
        <td width="150">{{ $user->position->name }}</td>
        <td width="185" class="pull-right">{{ $user->getCurrentCuresCount() }}</td>
    </tr>
    @endforeach
    </tbody>
</table>

{!! $users->appends([
    'department_patients_page' => request()->get('department_patients_page', 1),
    'department_storage_page' => request()->get('department_storage_page', 1)
])->fragment('workers')->links('layouts.pagination') !!}