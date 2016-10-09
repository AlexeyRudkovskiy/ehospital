{!! Form::ehText('name') !!}
{!! Form::ehText('name_for_department') !!}
{!! Form::ehText('small_name') !!}
{!! Form::ehNumber('amount_in_a_package') !!}
{!! Form::ehNumber('nds') !!}
{!! Form::ehNumber('barcode') !!}
{!! Form::ehNumber('morion_code') !!}

{!! Form::ehSelect('atc_classification_id', \App\AtcClassification::pluck('name_ua', 'id')) !!}


<div class="form-group @if($errors->has('atc_classification_id')) has-error @endif">
    {!! Form::label('atc_classification_id', 'ATC Classification', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('atc_classification_id', \App\AtcClassification::pluck('name_ua', 'id'), null, ['class' => 'form-control']) !!}
        @if($errors->has('atc_classification_id'))
            <span class="error-block">{{ $errors->first('atc_classification_id') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('base_unit_id')) has-error @endif">
    {!! Form::label('base_unit_id', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('base_unit_id', \App\Unit::pluck('text', 'id'), null, ['class' => 'form-control']) !!}
        @if($errors->has('base_unit_id'))
            <span class="error-block">{{ $errors->first('base_unit_id') }}</span>
        @endif
    </div>
</div>

{!! Form::ehSelect('basic_unit_id', \App\Unit::pluck('text', 'id')) !!}

<div class="form-group @if($errors->has('basic_unit_id')) has-error @endif">
    {!! Form::label('basic_unit_id', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('basic_unit_id', \App\Unit::pluck('text', 'id'), null, ['class' => 'form-control']) !!}
        @if($errors->has('basic_unit_id'))
            <span class="error-block">{{ $errors->first('basic_unit_id') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('manufacturer_id')) has-error @endif">
    {!! Form::label('manufacturer_id', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('manufacturer_id', \App\Manufacturer::pluck('name', 'id'), null, ['class' => 'form-control']) !!}
        @if($errors->has('manufacturer_id'))
            <span class="error-block">{{ $errors->first('manufacturer_id') }}</span>
        @endif
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</div>