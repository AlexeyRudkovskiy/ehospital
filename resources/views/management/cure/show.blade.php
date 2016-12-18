@inject('miicon', 'App\Services\MiIconService')

@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['cure-page'],
    'content_scrollable' => false
])

@section('content')
    <div class="tabs">
        <nav class="tabs-navigation">
            <a href="javascript:" data-default data-target="cure-card">@lang('management.label.cure.card.title')</a>
            @if($cure->patient->granted(auth()->user()))
                <a href="javascript:" data-target="card">@lang('management.label.patient.card')</a>
            @endif
            <a href="javascript:" data-target="comments">@lang('management.label.cure.comments')</a>
            @if($cure->review['accepted'])
                <a href="javascript:" data-target="flow">@lang('management.label.cure.flow')</a>
            @else
                @if($cure->isHeadNurse(auth()->user()))
                    <a href="javascript:" data-target="review">@lang('management.label.cure.review.title')</a>
                @endif
            @endif
        </nav>
        <div class="tabs-contents">
            <!--  cure card-->
            <div data-tab="cure-card">
                @include('management.cure.tabs.cure_card')
            </div>
            <!-- end cure card -->

            @if($cure->patient->granted(auth()->user()))
            <!-- patient-card -->
            <div data-tab="card">
                @if($cure->granted(auth()->user()))
                    @include('management.cure.tabs.card')
                @else
                    <div class="alert alert-danger">@lang('management.error.403')</div>
                @endif
            </div>
            <!-- end patient card -->
            @endif

            <!-- patient cures -->
            <div data-tab="comments">
                @include('management.cure.tabs.comments')
            </div>

            @if($cure->review['accepted'])
            <div data-tab="flow tab-full-size tab-horizontal-scroll">
                @include('management.cure.tabs.flow')
            </div>
            @else
                @if($cure->isHeadNurse(auth()->user()))
                <div data-tab="review">
                    @include('management.cure.tabs.review')
                </div>
                @endif
            @endif
            <!-- end patient cures -->
        </div>
    </div>
@endsection