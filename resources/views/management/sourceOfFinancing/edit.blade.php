@extends('layouts.app')

@section('content')
    {!! Form::model($item, ['route' => ['sourceOfFinancing.update', $item->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.sourceOfFinancing.form')
    {!! Form::close() !!}
@stop