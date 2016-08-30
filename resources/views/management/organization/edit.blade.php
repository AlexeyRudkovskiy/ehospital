@extends('layouts.app')

@section('content')
    {!! Form::model($organization, ['route' => ['organization.update', $organization->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.organization.form')
    {!! Form::close() !!}
@stop