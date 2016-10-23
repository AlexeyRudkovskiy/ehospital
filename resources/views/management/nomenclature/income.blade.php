<div class="header">
    <span class="title">@lang('management.label.nomenclature.income')</span>
</div>
<div class="popup-content">
    {!! Form::open(['route' => ['api.nomenclature.income.post', $nomenclature->id], 'method' => 'post', 'class' => "form form-compact"]) !!}

        @if ($nomenclature->keep_records_by_series)
            {!! Form::ehSelect('batch', $nomenclature->getBatchList()) !!}
        @else
            Don't keep records by series
        @endif

        {!! Form::ehText('income') !!}

    <div class="inline-popup-footer">
        {!! Form::hidden('user_id', auth()->id()) !!}
        {!! Form::ehSave(null, ['class' => 'btn btn-success btn-small'], true) !!}
    </div>

    {!! Form::close() !!}
</div>