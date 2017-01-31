@extends('layouts.app')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th width="200">Department</th>
            <th>Pharmacist</th>
            <th width="170" class="pull-right">Nomenclatures</th>
            <th width="120" class="pull-right">Date</th>
            <th width="130" class="pull-right">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($requests as $request)
        <tr>
            <td>{!! $request->department->name !!}</td>
            <td>{{ $request->pharmacist != null ? $request->pharmacist->fullName() : '' }}</td>
            <td class="pull-right">{{ count($request->requested) }}</td>
            <td class="pull-right">
                {!! $request->created_at->format('d.m.Y') !!}
            </td>
            <td class="pull-right">
                <a href="{{ route('nomenclature.request.show', $request->id) }}">Open</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {!! $requests->links('layouts.pagination') !!}

@endsection