@extends('layouts.app', [
    'no_content_paddings' => true,
    'tabs_as_sidebar' => true,
    'classes' => ['user-page'],
    'content_scrollable' => false
])

@section('content')

    <div class="tabs">
        <nav class="tabs-navigation">
            <a href="javascript:" data-default data-target="info">@lang('management.label.user.info')</a>
            <a href="javascript:" data-target="schedule">@lang('management.label.user.schedule')</a>
        </nav>

        <div class="tabs-contents">
            <div data-tab="info">
                <div class="info-compact">
                    <div class="header underline">
                        <h3>{{ $user->fullName() }}</h3>
                        <nav class="links">
                            <a href="{{ route('user.edit', $user->id) }}">@lang('management.global.edit')</a><!--
                        --><a href="javascript:" class="danger">@lang('management.global.delete')</a>
                        </nav>
                    </div>
                    <table class="table table-striped-on-hover">
                        <tr>
                            <td width="200">Phone:</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Position:</td>
                            <td>{{ isset($user->position) ? $user->position->name : trans('management.property.empty') }}</td>
                        </tr>
                        <tr>
                            <td>Parent:</td>
                            <td>{{ isset($user->parent) ? $user->parent->fullName() : trans('management.property.empty') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div data-tab="schedule">
                <div class="cards">
                @foreach($user->schedule as $schedule)
                    <div class="card">
                        <div class="card-header" data-icon="today">
                            <p class="title">@lang('datetime.day.week.' . $schedule->getDayOfWeek())</p>
                            <p class="subtitle">{{ $schedule->period() }}</p>
                        </div>
                        <div class="card-content">
                            <div class="schedule-time">
                                <div class="time_period">
                                    <p></p>
                                    <p>@lang('management.label.user.timeDelta', ['delta' => $schedule->getPerPatientFormated()])</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

@stop