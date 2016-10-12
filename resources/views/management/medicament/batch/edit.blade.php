@extends('layouts.app')

@section('content')
    {!! Form::model($batch, ['route' => ['medicament.batch.update', $medicament->id, $batch->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.medicament.batch.form')
    {!! Form::close() !!}
@endsection