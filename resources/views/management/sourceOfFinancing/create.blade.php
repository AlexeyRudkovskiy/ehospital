@extends('layouts.app')

@section('content')
    {!! Form::model($item, ['route' => ['sourceOfFinancing.store'], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.sourceOfFinancing.form')
    {!! Form::close() !!}
@stop