@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['nomenclature-page'],
    'content_scrollable' => false
])

@section('content')
    <div class="tabs">
        <nav class="tabs-navigation normal-right-padding">
            <a href="javascript:" data-default data-target="info"><nobr>@lang('management.label.nomenclature.info')</nobr></a>
            <a href="javascript:" data-target="revisions">@lang('management.label.nomenclature.revisions')</a>
            <a href="javascript:" data-target="batches" data-icon="add">@lang('management.label.nomenclature.series')</a>
            <a href="javascript:" data-target="receipts">@lang('management.label.nomenclature.receipts')</a>
            <a href="javascript:" data-target="expense">@lang('management.label.nomenclature.expense')</a>
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
            <div data-tab="receipts">
                @include('management.nomenclature.tabs.receipts')
            </div>
            <div data-tab="expense">
                @include('management.nomenclature.tabs.expense')
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    window.nomenclature = {
        id: {{ $nomenclature->id }},
        name: '{{ $nomenclature->name }}'
    };
</script>
@endpush