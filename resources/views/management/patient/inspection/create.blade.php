@extends('layouts.app')

@section('content')
    {!! Form::model($patient->inspection, ['route' => ['patient.inspection.post', $patient->id], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.patient.inspection.form')
    {!! Form::close() !!}
@stop