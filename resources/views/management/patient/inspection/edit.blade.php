@extends('layouts.app')

@section('content')
    @php($isEdit = true)
    {!! Form::model($patient->inspection, ['route' => ['patient.inspection.edit.post', $patient->id], 'method' => 'post', 'class' => "form form-compact"]) !!}
    @include('management.patient.inspection.form')
    {!! Form::close() !!}
@stop

@push('scripts')
<script>
    window.patient = JSON.parse('{!! $patient->toJson() !!}');
</script>
@endpush