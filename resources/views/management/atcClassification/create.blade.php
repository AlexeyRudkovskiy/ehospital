@extends('layouts.app')

@section('content')
    {!! Form::model($classification, ['route' => ['atcClassification.store'], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.atcClassification.form')
    {!! Form::close() !!}
@stop