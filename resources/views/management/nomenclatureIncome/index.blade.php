@extends('layouts.app')

@section('content')

    {!! Form::model($model, ['class' => 'form form-compact']) !!}

        {!! Form::ehSelect('source_of_financing_id', \App\SourceOfFinancing::pluck('name', 'id')) !!}

        {!! Form::ehSelect('contractor_id', \App\Contractor::pluck('name', 'id')) !!}

        <income-nomenclatures></income-nomenclatures>

    {!! Form::close() !!}

@endsection