@extends('management.layout')

@section('page')
    {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put', 'class' => "form-horizontal"]) !!}
    @include('management.user.form')
    {!! Form::close() !!}
@stop