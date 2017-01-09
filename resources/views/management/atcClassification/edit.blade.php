@extends('layouts.app')

@section('content')
    {!! Form::model($classification, ['route' => ['atcClassification.update', $classification->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.atcClassification.form')
    {!! Form::close() !!}
@stop