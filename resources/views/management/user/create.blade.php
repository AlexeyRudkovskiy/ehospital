@extends('management.layout')

@section('page')
    {!! Form::model($user, ['route' => ['user.store'], 'method' => 'post', 'class' => "form-horizontal"]) !!}
    @include('management.user.form')
    {!! Form::close() !!}
@stop