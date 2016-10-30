<div class="cures">
    @if($patient->cures->count() < 1)
        <div class="alert alert-info">@lang('management.label.patient.cures.empty')</div>
    @endif
    @foreach($patient->cures as $cure)
        <div class="card cure">
            <p class="cure-department">{{ $cure->department->name }}</p>
            <p>@lang('management.label.patient.cure.hospitalized', ['date' => $cure->hospitalization_date->format('d.m.Y')])</p>
            <p>@lang('management.label.patient.cure.doctor', ['doctor' => $cure->doctor->fullName()])</p>
            @if($cure->discharge_date != null)
            <p>@lang('management.label.patient.cure.discharge', ['date' => $cure->discharge_date])</p>
            @endif
            <p>
                <a href="{{ route('cure.show', $cure->id) }}">@lang('management.label.patient.cure.show')</a>
            </p>
        </div>
    @endforeach
</div>