@extends('layouts.app')

@section('content')
    {!! Form::model($medicament, ['route' => ['medicament.update', $medicament->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.medicament.form')
    {!! Form::close() !!}
@stop