<div class="header">
    <span class="title">@lang('management.label.contractor.addressPopup.header')</span>
</div>
<div class="popup-content">
    {!! Form::open(['route' => ['api.contractor.address.store', $contractor->id], 'method' => 'post', 'class' => "form form-compact"]) !!}

    {!! Form::ehSelect('country_id', \App\Country::pluck('name', 'id')) !!}

    {!! Form::ehText('city') !!}

    {!! Form::ehText('region') !!}

    {!! Form::ehText('street') !!}

    {!! Form::ehText('house_number') !!}

    <div class="inline-popup-footer">
        {!! Form::hidden('user_id', auth()->id()) !!}
        {!! Form::ehSave(null, ['class' => 'btn btn-success btn-small'], true) !!}
    </div>

    {!! Form::close() !!}
</div>