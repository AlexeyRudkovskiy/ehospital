@extends('layouts.app')

@section('content')
    {!! Form::model($contractor, ['route' => ['contractor.update', $contractor->id], 'method' => 'put', 'class' => "form form-compact"]) !!}
    @include('management.contractor.form')
    {!! Form::close() !!}
@stop