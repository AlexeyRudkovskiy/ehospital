@extends('layouts.app')

@section('content')
{!! Form::model($batch, ['route' => ['medicament.batch.store', $medicament->id], 'method' => 'post', 'class' => "form form-compact"]) !!}
{!! Form::number('batch_number') !!}
<br>
{!! Form::date('expiration_date') !!}
<br>
{!! Form::number('price') !!}
{!! Form::submit() !!}
{!! Form::close() !!}
@endsection