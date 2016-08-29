@extends('management.layout')

@section('page')
    {!! Form::model($medicament, ['route' => ['medicament.update', $medicament->id], 'method' => 'put', 'class' => "form-horizontal"]) !!}
    @include('management.medicament.form')
    {!! Form::close() !!}
@stop