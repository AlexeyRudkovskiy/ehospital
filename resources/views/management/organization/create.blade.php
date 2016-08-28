@extends('management.layout')

@section('page')
    {!! Form::model($organization, ['route' => ['organization.store'], 'method' => 'post', 'class' => "form-horizontal"]) !!}
    @include('management.organization.form')
    {!! Form::close() !!}
@stop