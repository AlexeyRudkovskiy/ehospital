<div class="cures">
    @if($patient->cures->count() < 1)
        <div class="alert alert-info">@lang('management.label.patient.cures.empty')</div>
    @endif
    @foreach($patient->cures as $cure)
        <div class="card">
            <div class="card-header">
                <p class="title">{{ $cure->department->name }}</p>
                <p class="subtitle">@lang('management.label.patient.cure.hospitalized', ['date' => $cure->hospitalization_date->format('d.m.Y')])</p>
            </div>
            <div class="card-content">
                <p>@lang('management.label.patient.cure.doctor', ['doctor' => $cure->doctor->fullName()])</p>
                @if($cure->discharge_date != null)
                    <p>@lang('management.label.patient.cure.discharge', ['date' => $cure->discharge_date])</p>
                @endif
            </div>
            <div class="card-footer pull-right">
                <a href="{{ route('cure.show', $cure->id) }}" class="ghost-btn ghost-btn-primary">@lang('management.label.patient.cure.show')</a>
            </div>
        </div>
    @endforeach
</div>