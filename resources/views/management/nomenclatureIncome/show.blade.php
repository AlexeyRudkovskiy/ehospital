@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['nomenclatureIncome-page'],
    'content_scrollable' => false
])

@section('content')

    <div class="tabs">
        <nav class="tabs-navigation">
            <a href="javascript:" data-default data-target="info">@lang('management.label.nomenclatureIncome.info')</a>
            <a href="javascript:" data-target="nomenclatures">@lang('management.label.nomenclatureIncome.nomenclatures')</a>
        </nav>
        <div class="tabs-contents">
            <div data-tab="info">
                @include('management.nomenclatureIncome.tabs.info')
            </div>
            <div data-tab="nomenclatures">
                @include('management.nomenclatureIncome.tabs.nomenclatures')
            </div>
        </div>
    </div>

@endsection