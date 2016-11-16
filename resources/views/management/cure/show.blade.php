@inject('miicon', 'App\Services\MiIconService')

@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['cure-page'],
    'content_scrollable' => false
])

@section('content')
    <nav class="tabs" data-default=".tab-content-cure-card">
        <a href="javascript:" data-target=".tab-content-cure-card">@lang('management.label.patient.card')</a>
        <a href="javascript:" data-target=".tab-content-cure-cure-card">@lang('management.label.cure.card.title')</a>
        <a href="javascript:" data-target=".tab-content-cure-comments">@lang('management.label.cure.comments')</a>
        @if($cure->review['accepted'])
        <a href="javascript:" data-target=".tab-content-cure-flow">@lang('management.label.cure.flow')</a>
        @else
            @if($cure->isHeadNurse(auth()->user()))
            <a href="javascript:" data-target=".tab-content-cure-review">@lang('management.label.cure.review.title')</a>
            @endif
        @endif
    </nav>
    <div class="tabs-contents scrollable">
        <!-- patient-card -->
        <div class="tab-content tab-content-cure-card">
            @if($cure->granted(auth()->user()))
                @include('management.cure.tabs.card')
            @else
                <div class="alert alert-danger">@lang('management.error.403')</div>
            @endif
        </div>
        <!-- end patient card -->

        <!--  cure card-->
        <div class="tab-content tab-content-cure-cure-card">
            @include('management.cure.tabs.cure_card')
        </div>
        <!-- end cure card -->

        <!-- patient cures -->
        <div class="tab-content tab-content-cure-comments">
            @include('management.cure.tabs.comments')
        </div>

        @if($cure->review['accepted'])
        <div class="tab-content tab-content-cure-flow tab-full-size tab-horizontal-scroll">
            @include('management.cure.tabs.flow')
        </div>
        @else
            @if($cure->isHeadNurse(auth()->user()))
            <div class="tab-content tab-content-cure-review">
                @include('management.cure.tabs.review')
            </div>
            @endif
        @endif
        <!-- end patient cures -->
    </div>
@endsection