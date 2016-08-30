@extends('layouts.app')

@section('content')
    {!! Form::model($organization, ['route' => ['organization.store'], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.organization.form')
    {!! Form::close() !!}
@stop