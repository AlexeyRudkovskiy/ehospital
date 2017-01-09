@extends('layouts.app')

@section('content')
    {!! Form::model($patient, ['route' => ['patient.store'], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.patient.form')
    {!! Form::close() !!}
@stop