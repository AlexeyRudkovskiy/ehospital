@extends('layouts.app')

@section('content')

    <form class="form">
        {!! dd($current->toArray()) !!}
    </form>

@endsection
