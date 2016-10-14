@extends('layouts.app')

@section('content')
    {!! Form::model($patient, ['route' => ['patient.update', $patient->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.patient.form')
    {!! Form::close() !!}
@stop