@extends('management.layout')

@section('page')
    {!! Form::model($medicament, ['route' => ['medicament.store'], 'method' => 'post', 'class' => "form-horizontal"]) !!}
    @include('management.medicament.form')
    {!! Form::close() !!}
@stop