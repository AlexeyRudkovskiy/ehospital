<div class="info-compact">
    <div class="header underline">
        <h3>{{ $department->name }}</h3>
        <nav class="links">
            <a href="{{ route('department.edit', $department->id) }}">@lang('management.global.edit')</a><!--
                --><a href="javascript:" class="danger">@lang('management.global.delete')</a>
        </nav>
    </div>

    <table class="table table-striped-on-hover">
        <tr>
            <td width="250">@lang('management.department.tabs.statistic.code')</td>
            <td>{{ $department->department_code }}</td>
        </tr>
        <tr>
            <td width="250">@lang('management.department.tabs.statistic.beds_amount')</td>
            <td>{{ $department->beds_amount }}</td>
        </tr>
        <tr>
            <td width="250">@lang('management.department.tabs.statistic.beds_amount_in_repair')</td>
            <td>{{ $department->beds_amount_in_repair }}</td>
        </tr>
        <tr>
            <td width="250">@lang('management.department.tabs.statistic.male_beds_amount')</td>
            <td>{{ $department->male_beds_amount }}</td>
        </tr>
        <tr>
            <td width="250">@lang('management.department.tabs.statistic.female_beds_amount')</td>
            <td>{{ $department->female_beds_amount }}</td>
        </tr>
    </table>
</div>