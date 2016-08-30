@extends('layouts.app')

@section('content')
    {!! Form::model($medicament, ['route' => ['medicament.store'], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.medicament.form')
    {!! Form::close() !!}
@stop