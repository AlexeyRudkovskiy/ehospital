<div class="form-group @if($errors->has('name')) has-error @endif">
    {!! Form::label('name', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @if($errors->has('name'))
            <span class="error-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('name_for_department')) has-error @endif">
    {!! Form::label('name_for_department', 'For department', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name_for_department', null, ['class' => 'form-control']) !!}
        @if($errors->has('name_for_department'))
            <span class="error-block">{{ $errors->first('name_for_department') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('small_name')) has-error @endif">
    {!! Form::label('small_name', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('small_name', null, ['class' => 'form-control']) !!}
        @if($errors->has('small_name'))
            <span class="error-block">{{ $errors->first('small_name') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('amount_in_a_package')) has-error @endif">
    {!! Form::label('amount_in_a_package', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::number('amount_in_a_package', null, ['class' => 'form-control']) !!}
        @if($errors->has('amount_in_a_package'))
            <span class="error-block">{{ $errors->first('amount_in_a_package') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('nds')) has-error @endif">
    {!! Form::label('nds', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::number('nds', null, ['class' => 'form-control']) !!}
        @if($errors->has('nds'))
            <span class="error-block">{{ $errors->first('nds') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('barcode')) has-error @endif">
    {!! Form::label('barcode', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::number('barcode', null, ['class' => 'form-control']) !!}
        @if($errors->has('barcode'))
            <span class="error-block">{{ $errors->first('barcode') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if($errors->has('morion_code')) has-error @endif">
    {!! Form::label('morion_code', null, ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::number('morion_code', null, ['class' => 'form-control']) !!}
        @if($errors->has('morion_code'))
            <span class="error-block">{{ $errors->first('morion_code') }}</span>
        @endif
    </div>
</div>
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