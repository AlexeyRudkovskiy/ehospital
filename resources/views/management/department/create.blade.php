@extends('layouts.app')

@section('content')
    {!! Form::model($department, ['route' => ['department.store'], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.department.form')
    {!! Form::close() !!}
@stop