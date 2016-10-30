@inject('miicon', 'App\Services\MiIconService')

@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['patient-page'],
    'content_scrollable' => false
])

@section('content')
    <nav class="tabs" data-default=".tab-content-patient-card">
        <a href="javascript:" data-target=".tab-content-patient-card">@lang('management.label.patient.card')</a>
        <a href="javascript:" data-target=".tab-content-patient-cures">@lang('management.label.patient.cures.title')</a>
        <a href="javascript:" data-target=".tab-content-patient-hospitalization">@lang('management.label.patient.hospitalization')</a>
    </nav>
    <div class="tabs-contents scrollable">
        <!-- patient-card -->
        <div class="tab-content tab-content-patient-card">
            @include('management.patient.tabs.card')
        </div>
        <!-- end patient card -->

        <!-- patient cures -->
        <div class="tab-content tab-content-patient-cures">
            @include('management.patient.tabs.cures')
        </div>

        <div class="tab-content tab-content-patient-hospitalization">
            @include('management.patient.tabs.hospitalization')
        </div>
        <!-- end patient cures -->
    </div>
@endsection
