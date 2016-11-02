@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['cure-page'],
    'content_scrollable' => false
])

@section('content')
    <nav class="tabs" data-default=".tab-content-cure-card">
        <a href="javascript:" data-target=".tab-content-cure-card">@lang('management.label.patient.card')</a>
        <a href="javascript:" data-target=".tab-content-cure-comments">@lang('management.label.cure.comments')</a>
        <a href="javascript:" data-target=".tab-content-cure-hospitalization">@lang('management.label.patient.hospitalization')</a>
    </nav>
    <div class="tabs-contents scrollable">
        <!-- patient-card -->
        <div class="tab-content tab-content-cure-card">
            1
        </div>
        <!-- end patient card -->

        <!-- patient cures -->
        <div class="tab-content tab-content-cure-comments">
            @include('management.cure.tabs.comments')
        </div>

        <div class="tab-content tab-content-cure-hospitalization">
            3
        </div>
        <!-- end patient cures -->
    </div>
@endsection