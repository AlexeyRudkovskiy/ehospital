@extends('layouts.app')

@section('content')

    {!! Form::model('item', [ 'route' => [ 'department.nomenclature_set.store' ], 'class' => 'form' ]) !!}

    @include('management.department.current.nomenclature_sets.form')

    {!! Form::close() !!}

@endsection