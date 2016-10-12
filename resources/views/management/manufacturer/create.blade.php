@extends('layouts.app')

@section('content')
    {!! Form::model($manufacturer, ['route' => ['manufacturer.store'], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.manufacturer.form')
    {!! Form::close() !!}
@stop