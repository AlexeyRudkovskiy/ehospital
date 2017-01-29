@extends('layouts.app')

@section('content')

    {!! Form::model('item', [ 'route' => [ 'department.nomenclature_set.update', $item->id ], 'class' => 'form' ]) !!}

        @include('management.department.current.nomenclature_sets.form')

    {!! Form::close() !!}

@endsection