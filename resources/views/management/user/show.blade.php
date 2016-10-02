@extends('layouts.app')

@section('content')

    <div class="user-page">
        <nav class="tabs tabs-vertical-offset" data-default=".tab-content-info">
            <a href="javascript:" data-target=".tab-content-info">@lang('management.label.user.info')</a>
            <a href="javascript:" data-target=".tab-content-schedule">@lang('management.label.user.schedule')</a>
        </nav>

        <div class="tab-content tab-content-info">
            <div class="info-compact">
                <div class="header underline">
                    <h3>{{ $user->fullName() }}</h3>
                    <nav class="links">
                        <a href="javascript:">edit</a><!--
                        --><a href="javascript:" class="danger">delete</a>
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

        <div class="tab-content tab-content-schedule">
            <div class="info-compact">
                @foreach($user->schedule as $schedule)
                    <div class="header underline">
                        <h3>
                            <i class="mi-btn mi-static mi-no-left-padding">today</i><!--
                            --><span class="day_of_week">@lang('datetime.day.week.' . $schedule->getDayOfWeek())</span>
                        </h3>
                        <div class="clear"></div>
                        <div class="schedule-time">
                            <i class="mi-btn mi-static mi-no-left-padding mi-no-bottom-padding mi-no-top-padding">timer</i><!--
                            --><div class="time_period">
                                <p>{{ $schedule->period() }}</p>
                                <p>@lang('management.label.user.timeDelta', ['delta' => $schedule->getPerPatientFormated()])</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@stop