@extends('layouts.app')

@section('content')
    {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.user.form')
    {!! Form::close() !!}
@stop