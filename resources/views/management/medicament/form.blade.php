{!! Form::ehText('name') !!}

{!! Form::ehText('name_for_department') !!}

{!! Form::ehText('small_name') !!}

{!! Form::ehNumber('amount_in_a_package') !!}

{!! Form::ehNumber('nds') !!}

{!! Form::ehNumber('barcode') !!}

{!! Form::ehNumber('morion_code') !!}

{!! Form::ehSelect('atc_classification_id', \App\AtcClassification::pluck('name_ua', 'id')) !!}

{!! Form::ehSelect('base_unit_id', \App\Unit::pluck('text', 'id')) !!}

{!! Form::ehSelect('basic_unit_id', \App\Unit::pluck('text', 'id')) !!}

{!! Form::ehSelect('manufacturer_id', \App\Manufacturer::pluck('name', 'id')) !!}

{!! Form::ehSave() !!}
