<div class="header">
    <span class="title">@lang('management.label.medicament.outgoing')</span>
</div>
<div class="popup-content">
    {!! Form::open(['route' => ['api.medicament.outgoing.post', $medicament->id], 'method' => 'post', 'class' => "form form-compact"]) !!}

    @if ($medicament->keep_records_by_series)
        {!! Form::ehSelect('batch', $medicament->getBatchList()) !!}
    @else
        Don't keep records by series
    @endif

    {!! Form::ehText('outgoing') !!}

    <div class="inline-popup-footer">
        {!! Form::hidden('user_id', auth()->id()) !!}
        {!! Form::ehSave(null, ['class' => 'btn btn-success btn-small'], true) !!}
    </div>

    {!! Form::close() !!}
</div>