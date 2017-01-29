@extends('layouts.app')

@section('content')

    {!! Form::model('item', [ 'route' => ['department.nomenclature_set.item.store', $nomenclatureSet->id], 'class' => 'form' ]) !!}

    @include('management.department.current.nomenclature_sets.item.form')

    {!! Form::close() !!}

@endsection