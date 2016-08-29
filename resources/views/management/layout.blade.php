@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <nav class="sidebar">
                    <a href="{{ route('organization.index') }}" @if($controller == 'organization') class="active" @endif>Organizations</a>
                    <a href="{{ route('user.index') }}" @if($controller == 'user') class="active" @endif>Users</a>
                    <a href="{{ route('permission.index') }}" @if($controller == 'permission') class="active" @endif>Permissions</a>
                    <a href="{{ route('atcClassification.index') }}" @if($controller == 'atcClassification') class="active" @endif>Atc Classification</a>
                    <a href="{{ route('contractor.index') }}" @if($controller == 'contractor') class="active" @endif>Contractors</a>
                    <a href="{{ route('medicament.index') }}" @if($controller == 'medicament') class="active" @endif>Medicaments</a>
                    <a href="{{ route('manufacturer.index') }}" @if($controller == 'manufacturer') class="active" @endif>Manufacturers</a>
                    <a href="{{ route('department.index') }}" @if($controller == 'department') class="active" @endif>Department</a>
                </nav>
            </div>
            <div class="col-lg-10">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                @yield('page')
            </div>
        </div>
    </div>
@stop