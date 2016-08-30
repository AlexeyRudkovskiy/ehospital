@extends('layouts.app')

@section('content')
    {!! Form::model($department, ['route' => ['department.store'], 'method' => 'post', 'class' => "form-horizontal"]) !!}
    @include('management.department.form')
    {!! Form::close() !!}
@stop