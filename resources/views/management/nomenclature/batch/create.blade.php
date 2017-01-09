@extends('layouts.app')

@section('content')
    {!! Form::model($batch, ['route' => ['nomenclature.batch.store', $nomenclature->id], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.nomenclature.batch.form')
    {!! Form::close() !!}
@endsection