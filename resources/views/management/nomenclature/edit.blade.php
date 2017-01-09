@extends('layouts.app')

@section('content')
    {!! Form::model($nomenclature, ['route' => ['nomenclature.update', $nomenclature->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.nomenclature.form')
    {!! Form::close() !!}
@stop