@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['nomenclature-page'],
    'content_scrollable' => false
])

@section('content')

    <nav class="tabs" data-default=".tab-content-info">
        <a href="javascript:" data-target=".tab-content-info">@lang('management.label.nomenclatureIncome.info')</a>
        <a href="javascript:" data-target=".tab-content-nomenclatures">@lang('management.label.nomenclatureIncome.nomenclatures')</a>
    </nav>

    <div class="tabs-contents">
        <div class="tab-content tab-content-info">
            Info tab
        </div>
        <div class="tab-content tab-content-nomenclatures">
            @foreach($income->nomenclatures as $nomenclature)
                Test
            @endforeach
        </div>
    </div>

@endsection