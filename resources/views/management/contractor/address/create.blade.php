@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['contractor.address.store', $contractor->id], 'method' => 'post', 'class' => "form form-compact"]) !!}

    {!! Form::ehSelect('country_id', \App\Country::pluck('name', 'id')) !!}

    {!! Form::ehText('city') !!}

    {!! Form::ehText('region') !!}

    {!! Form::ehText('street') !!}

    {!! Form::ehText('house_number') !!}

    {!! Form::ehText('apartment') !!}

    {!! Form::ehSave() !!}

    {!! Form::close() !!}
@endsection