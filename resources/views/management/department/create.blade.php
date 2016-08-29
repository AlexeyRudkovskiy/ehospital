@extends('management.layout')

@section('page')
    {!! Form::model($department, ['route' => ['department.store'], 'method' => 'post', 'class' => "form-horizontal"]) !!}
    @include('management.department.form')
    {!! Form::close() !!}
@stop