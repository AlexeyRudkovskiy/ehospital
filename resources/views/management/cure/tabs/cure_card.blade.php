<div class="info-compact">
    <table class="table table-striped-on-hover">
        <tr>
            <td width="200">@lang('management.label.cure.card.diagnosis')</td>
            <td>{{ $cure->diagnosis }}</td>
        </tr>
        <tr>
            <td width="200">@lang('management.label.cure.card.comment')</td>
            <td>{{ $cure->comment }}</td>
        </tr>
        <tr>
            <td width="200">@lang('management.label.cure.card.hospitalization_date')</td>
            <td>{{ $cure->hospitalization_date->format('d.m.Y') }}</td>
        </tr>
        @if($cure->discharge_date != null)
            <tr>
                <td width="200">@lang('management.label.cure.card.discharge_date')</td>
                <td>{{ $cure->discharge_date->format('d.m.Y') }}</td>
            </tr>
        @endif
    </table>
</div>