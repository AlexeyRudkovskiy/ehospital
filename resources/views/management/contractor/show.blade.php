@extends('layouts.app')

@section('content')

    <nav class="tabs tabs-vertical-offset" data-default=".tab-content-info">
        <a href="javascript:" data-target=".tab-content-info">@lang('management.label.contractor.info')</a>
        <a href="javascript:" data-target=".tab-content-addresses">@lang('management.label.contractor.addresses')</a>
        <a href="javascript:" data-target=".tab-content-documents">@lang('management.label.contractor.documents')</a>

        <div class="right">
            <a href="javascript:" class="mi-btn" id="add_address">add_location</a>
        </div>
    </nav>

    <div class="tab-contents">
        <div class="tab-content tab-content-info">

            <div class="info-compact">
                <div class="header underline">
                    <h3>{{ strlen($contractor->fullName) > 0 ? $contractor->fullName : $contractor->name }}</h3>
                    <nav class="links">
                        <a href="{{ route('contractor.edit', $contractor->id) }}">@lang('management.global.edit')</a><!--
                --><a href="javascript:" class="danger">@lang('management.global.delete')</a>
                    </nav>
                </div>

                <table class="table table-striped-on-hover">
                    <tr>
                        <td width="200">@lang('management.label.contractor.name')</td>
                        <td>{{ $contractor->name }}</td>
                    </tr>
                    <tr>
                        <td width="200">@lang('management.label.contractor.fullName')</td>
                        <td>{{ $contractor->fullName }}</td>
                    </tr>
                    <tr>
                        <td width="200">@lang('management.label.contractor.edrpou')</td>
                        <td>{{ $contractor->edrpou }}</td>
                    </tr>
                    <tr>
                        <td width="200">@lang('management.label.contractor.type')</td>
                        <td>{{ $contractor->type }}</td>
                    </tr>
                    <tr>
                        <td width="200">@lang('management.label.contractor.description')</td>
                        <td>{{ $contractor->description }}</td>
                    </tr>
                    <tr>
                        <td width="200">@lang('management.label.contractor.phone')</td>
                        <td>@if(!empty($contractor->phone))<a href="tel:{{ $contractor->phone }}">{{ $contractor->phone }}</a>@endif</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="tab-content tab-content-addresses">

            <div class="card">
                Test
            </div>

        </div>
        <div class="tab-content tab-content-documents">

        </div>
    </div>
@endsection

@push('scripts')
<script>
    window.contractor = JSON.parse('{!! $contractor->toJson() !!}');
</script>
@endpush