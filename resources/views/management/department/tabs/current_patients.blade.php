<table class="table">
    <thead>
    <tr>
        <th>@lang('management.department.tabs.patients.name')</th>
        <th>@lang('management.department.tabs.patients.diagnosis')</th>
        <th width="200" class="pull-right">@lang('management.department.tabs.patients.hospitalization_date')</th>
    </tr>
    </thead>
    <tbody>
    @php($patients = $department->patients())
    @foreach($patients as $patient)
    <tr>
        <td><a href="{{ route('patient.show', $patient->id) }}">{{ $patient->name }}</a></td>
        <td class="has-list">
            <ul>
                @foreach($patient->getCurrentCures() as $cure)
                <li><a href="{{ route('cure.show', $cure->id) }}">{{ $cure->diagnosis }}</a></li>
                @endforeach
            </ul>
        <td class="has-list pull-right">
            <ul>
                @foreach($patient->getCurrentCures() as $cure)
                <li>{{ $cure->hospitalization_date->format('d.m.Y') }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

{!! $patients->appends([
    'department_users_page' => request()->get('department_users_page', 1),
    'department_storage_page' => request()->get('department_storage_page', 1)
])->fragment('patients')->links('layouts.pagination') !!}