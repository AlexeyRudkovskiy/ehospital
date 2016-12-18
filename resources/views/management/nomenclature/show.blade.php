@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['nomenclature-page'],
    'content_scrollable' => false
])

@section('content')
    <div class="tabs">
        <nav class="tabs-navigation normal-right-padding">
            <a href="javascript:" data-default data-target="info">@lang('management.label.nomenclature.info')</a>
            <a href="javascript:" data-target="revisions">@lang('management.label.nomenclature.revisions')</a>
            <a href="javascript:" data-target="batches" data-icon="add">@lang('management.label.nomenclature.series')</a>
            <a href="javascript:" data-target="statistic">@lang('management.label.nomenclature.statistic')</a>
        </nav>
        <div class="tabs-contents">
            <div data-tab="info">
                @include('management.nomenclature.tabs.info')
            </div>
            <div data-tab="revisions" class="no-left-padding no-right-padding">
                @include('management.nomenclature.tabs.revisions')
            </div>
            <div data-tab="batches" class="no-left-padding no-right-padding">
                @include('management.nomenclature.tabs.batches')
            </div>
            <div data-tab="statistic">
                @include('management.nomenclature.tabs.statistic')
            </div>
        </div>
    </div>

    {{--<nav class="tabs" data-default=".tab-content-info">--}}
        {{--<a href="javascript:" data-target=".tab-content-info">@lang('management.label.nomenclature.info')</a>--}}
        {{--<a href="javascript:" data-target=".tab-content-revisions">@lang('management.label.nomenclature.revisions')</a>--}}
        {{--<a href="javascript:" data-target=".tab-content-batches" data-icon="add">@lang('management.label.nomenclature.series')</a>--}}
        {{--<a href="javascript:" data-target=".tab-content-statistic">@lang('management.label.nomenclature.statistic')</a>--}}

        {{--<a href="javascript:" id="nomenclature_income" data-icon="file_download">Поступление</a>--}}
        {{--<a href="javascript:" id="nomenclature_outgoing" data-icon="file_upload">Расход</a>--}}
    {{--</nav>--}}

    {{--<div class="tabs-contents scrollable">--}}
        {{--<!-- Информация об медикаменте -->--}}
        {{--<div class="tab-content tab-content-info">--}}
            {{--@include('management.nomenclature.tabs.info')--}}
        {{--</div>--}}

        {{--<!-- Изменения медикамета -->--}}
        {{--<div class="tab-content tab-content-revisions">--}}
            {{--@include('management.nomenclature.tabs.revisions')--}}
        {{--</div>--}}

        {{--<div class="tab-content tab-content-batches">--}}
            {{--@include('management.nomenclature.tabs.batches')--}}
        {{--</div>--}}

        {{--<div class="tab-content tab-content-statistic">--}}
            {{--@include('management.nomenclature.tabs.statistic')--}}
        {{--</div>--}}

        {{--<div class="clear"></div>--}}
    {{--</div>--}}
@stop

@push('scripts')
<script>
    window.nomenclature = {
        id: {{ $nomenclature->id }},
        name: '{{ $nomenclature->name }}'
    };
</script>
@endpush