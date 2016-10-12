@extends('layouts.app')

@section('content')
    {!! Form::model($manufacturer, ['route' => ['manufacturer.update', $manufacturer->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.manufacturer.form')
    {!! Form::close() !!}
@stop