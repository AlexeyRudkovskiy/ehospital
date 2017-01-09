@extends('layouts.app')

@section('content')
    {!! Form::model($department, ['route' => ['department.update', $department->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.department.form')
    {!! Form::close() !!}
@stop