@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['contractor-page'],
    'content_scrollable' => false
])

@section('content')

    <div class="tabs">
        <nav class="tabs-navigation">
            <a href="javascript:" data-default data-target="info">@lang('management.label.contractor.info')</a>
            <a href="javascript:" data-target="addresses">@lang('management.label.contractor.addresses')</a>
            <a href="javascript:" data-target="documents">@lang('management.label.contractor.documents')</a>

            {{--<a href="javascript:" id="add_address" data-contractor-id="{{ $contractor->id }}">@lang("management.label.contractor.address.create")</a>--}}
            {{--<a href="javascript:" id="add_agreement" data-contractor-id="{{ $contractor->id }}">@lang("management.label.contractor.agreement.create")</a>--}}
        </nav>
        <div class="tabs-contents">
            <div data-tab="info">
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
            <div data-tab="addresses">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Адрес</th>
                        <th width="130" class="pull-right">
                            <a href="{{ route('contractor.address.create', $contractor->id) }}" class="btn">создать</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contractor->addresses as $addresses)
                        <tr>
                            <td>
                                {{ $addresses->country->name }}
                                {{ $addresses->city }}
                                {{ $addresses->street }}
                                {{ $addresses->house_number }}
                                {{ $addresses->apartment }}
                            </td>
                            <td class="pull-right">
                                <a href="{{ route('contractor.address.delete', [$contractor->id, $addresses->id]) }}">Удалить</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div data-tab="documents">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Срок</th>
                        <th width="100" class="pull-right">Цена</th>
                        <th width="130" class="pull-right">
                            <a href="{{ route('contractor.agreement.create', $contractor->id) }}" class="btn">создать</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contractor->agreements as $agreement)
                        <tr>
                            <td>{{ $agreement->from }} - {{ $agreement->until }}</td>
                            <td class="pull-right">{{ $agreement->price }}</td>
                            <td class="pull-right">
                                <a href="{{ route('contractor.agreement.delete', [$contractor->id, $agreement->id]) }}">Удалить</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    window.contractor = JSON.parse('{!! str_replace('\\', '\\\\', $contractor->toJson()) !!}');
</script>
@endpush