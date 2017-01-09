@inject('miicon', 'App\Services\MiIconService')

@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['patient-page'],
    'content_scrollable' => false
])

@section('content')
    <div class="tabs">
        <nav class="tabs-navigation">
            <a href="javascript:" data-default data-target="card">@lang('management.label.patient.card')</a>
            <a href="javascript:" data-target="cures">@lang('management.label.patient.cures.title')</a>
            <a href="javascript:" data-target="hospitalization">@lang('management.label.patient.hospitalization')</a>
        </nav>
        <div class="tabs-contents">
            <!-- patient-card -->
            <div data-tab="card">
                @include('management.patient.tabs.card')
            </div>
            <!-- end patient card -->

            <!-- patient cures -->
            <div data-tab="cures">
                @include('management.patient.tabs.cures')
            </div>

            <div data-tab="hospitalization">
                @include('management.patient.tabs.hospitalization')
            </div>
            <!-- end patient cures -->
        </div>
    </div>
@endsection
