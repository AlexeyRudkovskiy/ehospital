@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['nomenclature-page'],
    'content_scrollable' => false
])

@section('content')
    <nav class="tabs" data-default=".tab-content-info">
        <a href="javascript:" data-target=".tab-content-info">@lang('management.label.nomenclature.info')</a>
        <a href="javascript:" data-target=".tab-content-revisions">@lang('management.label.nomenclature.revisions')</a>
        <a href="javascript:" data-target=".tab-content-batches" data-icon="add">@lang('management.label.nomenclature.series')</a>
        <a href="javascript:" data-target=".tab-content-statistic">@lang('management.label.nomenclature.statistic')</a>

        <a href="javascript:" id="nomenclature_income" data-icon="file_download">Поступление</a>
        <a href="javascript:" id="nomenclature_outgoing" data-icon="file_upload">Расход</a>
    </nav>

    <div class="tabs-contents scrollable">
        <!-- Информация об медикаменте -->
        <div class="tab-content tab-content-info">
            @include('management.nomenclature.tabs.info')
        </div>

        <!-- Изменения медикамета -->
        <div class="tab-content tab-content-revisions">
            @include('management.nomenclature.tabs.revisions')
        </div>

        <div class="tab-content tab-content-batches">
            @include('management.nomenclature.tabs.batches')
        </div>

        <div class="tab-content tab-content-statistic">
            @include('management.nomenclature.tabs.statistic')
        </div>

        <div class="clear"></div>
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