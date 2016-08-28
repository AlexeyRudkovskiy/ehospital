@extends('management.layout')

@section('page')
    {!! Form::model($classification, ['route' => ['atcClassification.store'], 'method' => 'post', 'class' => "form-horizontal"]) !!}
    @include('management.atcClassification.form')
    {!! Form::close() !!}
@stop