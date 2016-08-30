@extends('layouts.app')

@section('content')
    {!! Form::model($department, ['route' => ['department.update', $department->id], 'method' => 'put', 'class' => "form-horizontal"]) !!}
    @include('management.department.form')
    {!! Form::close() !!}
@stop