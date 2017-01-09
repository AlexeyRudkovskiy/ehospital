@extends('layouts.app')

@section('content')
    {!! Form::model($nomenclature, ['route' => ['nomenclature.store'], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.nomenclature.form')
    {!! Form::close() !!}
@stop