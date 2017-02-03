@extends('layouts.app')

@section('content')
    <div class="tabs">
        <nav class="tabs-navigation">
            <a href="javascript:" data-default data-target="statistic">@lang('management.department.statistic')</a>
            @if(policy()->dispatch($department, 'patients'))
            <a href="javascript:" data-target="patients">@lang('management.department.patients')</a>
            @endif
            <a href="javascript:" data-target="workers">@lang('management.department.workers')</a>
            <a href="javascript:" data-target="storage">@lang('management.department.storage')</a>
            <a href="javascript:" data-target="sets">@lang('management.department.sets')</a>
        </nav>
        <div class="tabs-contents">

            <!-- Statistic -->
            <div data-tab="statistic">
                @include('management.department.tabs.current_statistic')
            </div>
            <!-- End statistic -->

            @if(policy()->dispatch($department, 'patients'))
            <!-- Patients -->
            <div data-tab="patients">
                @include('management.department.tabs.current_patients')
            </div>
            <!-- End patients -->
            @endif

            <!-- Workers -->
            <div data-tab="workers">
                @include('management.department.tabs.current_workers')
            </div>
            <!-- End workers -->

            <!-- Storage -->
            <div data-tab="storage">
                @include('management.department.tabs.current_storage')
            </div>
            <!-- End storage -->

            <!-- Sets -->
            <div data-tab="sets">
                @include('management.department.tabs.current_sets')
            </div>
            <!-- End sets -->

        </div>
    </div>
@endsection