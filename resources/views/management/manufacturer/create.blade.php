@extends('management.layout')

@section('page')
    {!! Form::model($manufacturer, ['route' => ['manufacturer.store'], 'method' => 'post', 'class' => "form-horizontal"]) !!}
    @include('management.manufacturer.form')
    {!! Form::close() !!}
@stop