@extends('management.layout')

@section('page')
    {!! Form::model($organization, ['route' => ['organization.update', $organization->id], 'method' => 'put', 'class' => "form-horizontal"]) !!}
    @include('management.organization.form')
    {!! Form::close() !!}
@stop