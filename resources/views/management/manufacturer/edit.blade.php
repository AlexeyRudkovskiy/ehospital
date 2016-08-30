@extends('layouts.app')

@section('content')
    {!! Form::model($manufacturer, ['route' => ['manufacturer.update', $manufacturer->id], 'method' => 'put', 'class' => "form-horizontal"]) !!}
    @include('management.manufacturer.form')
    {!! Form::close() !!}
@stop