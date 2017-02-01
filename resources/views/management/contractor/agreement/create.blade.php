@extends('layouts.app')

@section('content')

<div class="popup-content">
    {!! Form::open(['route' => ['contractor.agreement.store', $contractor->id], 'method' => 'post', 'class' => "form form-compact"]) !!}

    {!! Form::ehDate('from') !!}

    {!! Form::ehDate('until') !!}

    {!! Form::ehNumber('price', null, null, ['step' => '0.01']) !!}

    {!! Form::ehSave() !!}

    {!! Form::close() !!}
</div>

@endsection