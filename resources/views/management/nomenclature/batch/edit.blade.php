@extends('layouts.app')

@section('content')
    {!! Form::model($batch, ['route' => ['nomenclature.batch.update', $nomenclature->id, $batch->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.nomenclature.batch.form')
    {!! Form::close() !!}
@endsection