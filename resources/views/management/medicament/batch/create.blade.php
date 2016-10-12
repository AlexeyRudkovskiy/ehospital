@extends('layouts.app')

@section('content')
    {!! Form::model($batch, ['route' => ['medicament.batch.store', $medicament->id], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.medicament.batch.form')
    {!! Form::close() !!}
@endsection