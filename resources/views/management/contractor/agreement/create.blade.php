<div class="header">
    <span class="title">@lang('management.label.contractor.addressPopup.header')</span>
</div>
<div class="popup-content">
    {!! Form::open(['route' => ['api.contractor.agreement.store', $contractor->id], 'method' => 'post', 'class' => "form form-compact"]) !!}

    {!! Form::ehDate('from') !!}

    {!! Form::ehDate('until') !!}

    {!! Form::ehNumber('price', null, null, ['step' => '0.01']) !!}

    <div class="inline-popup-footer">
        {!! Form::hidden('user_id', auth()->id()) !!}
        {!! Form::ehSave(null, ['class' => 'btn btn-success btn-small'], true) !!}
    </div>

    {!! Form::close() !!}
</div>