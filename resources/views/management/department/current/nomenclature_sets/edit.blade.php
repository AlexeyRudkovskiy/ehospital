@extends('layouts.app')

@section('content')

    {!! Form::model('item', [ 'url' => route('department.nomenclature_set.item.update', [$nomenclatureSet->id, $item->id]), 'class' => 'form' ]) !!}

    @include('management.department.current.nomenclature_sets.form')

    {!! Form::close() !!}

@endsection