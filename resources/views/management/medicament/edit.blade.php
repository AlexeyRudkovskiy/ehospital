@extends('layouts.app')

@section('content')
    {!! Form::model($medicament, ['route' => ['medicament.update', $medicament->id], 'method' => 'put', 'class' => "form-horizontal"]) !!}
    @include('management.medicament.form')
    {!! Form::close() !!}
@stop