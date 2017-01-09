@extends('layouts.app')

@section('content')
    {!! Form::model($contractor, ['route' => ['contractor.store'], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.contractor.form')
    {!! Form::close() !!}
@stop