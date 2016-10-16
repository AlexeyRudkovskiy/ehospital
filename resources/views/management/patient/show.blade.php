@inject('miicon', 'App\Services\MiIconService')

@extends('layouts.app')

@section('content')

    <div class="patient-page">
        <!-- base page content -->
        <nav class="tabs tabs-bottom-offset tabs-vertical-offset" data-default=".tab-content-patient-card">
            <a href="javascript:" data-target=".tab-content-patient-card">@lang('management.label.patient.card')</a>
            <a href="javascript:" data-target=".tab-content-patient-cures">@lang('management.label.patient.cures')</a>
        </nav>

        <div class="tab-contents">
            <!-- patient-card -->
            <div class="tab-content tab-content-patient-card">
                <div class="info-compact">
                    <div class="header underline">
                        <h3>{{ $patient->name }}</h3>
                        <nav class="links">
                            <a href="{{ route('patient.edit', $patient->id) }}">@lang('management.global.edit')</a><!--
                            --><a href="{{ route('patient.inspection.edit', $patient->id) }}">@lang('management.label.patient.inspection.edit')</a><!--
                            --><a href="javascript:" class="danger">@lang('management.global.delete')</a>
                        </nav>
                    </div>
                    <table class="table table-striped-on-hover">
                        <tr>
                            <td width="200">@lang('management.label.patient.phone')</td>
                            <td>{{ $patient->phone }}</td>
                        </tr>
                        <tr>
                            <td width="200">@lang('management.label.patient.birthday')</td>
                            <td>{{ $patient->birthday }}</td>
                        </tr>
                        @if($patient->inspection != null)
                        <tr>
                            <td width="200">@lang('management.label.patient.inspection.bloodGroup')</td>
                            <td>
                                {{ $patient->inspection->blood_group }}
                            </td>
                        </tr>
                        <tr>
                            <td width="200">@lang('management.label.patient.inspection.rhFactor')</td>
                            <td>
                                {{ $patient->inspection->getRhFactor() }}
                            </td>
                        </tr>
                        <tr>
                            <td width="200">@lang('management.label.patient.inspection.bloodTransfusions')</td>
                            <td class="no-paddings">
                                <ul class="info-list">
                                    @foreach($patient->inspection->bloodTransfusions as $bloodTransfusion)
                                        <li>{{ $bloodTransfusion->data }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td width="200">@lang('management.label.patient.ukrainian')</td>
                            <td>{!! $miicon->toggle($patient->ukrainian) !!}</td>
                        </tr>
                        <tr>
                            <td width="200">@lang('management.label.patient.homeless')</td>
                            <td>{!! $miicon->toggle($patient->homeless) !!}</td>
                        </tr>
                        <tr>
                            <td width="200">@lang('management.label.patient.hospital_employee')</td>
                            <td>{!! $miicon->toggle($patient->hospital_employee) !!}</td>
                        </tr>
                        <tr>
                            <td width="200">@lang('management.label.patient.doctors')</td>
                            <td class="no-paddings">
                                <ul class="info-list">
                                    @foreach($patient->getDoctors() as $doctor)
                                    <li><a href="{{ route('user.show', $doctor->id) }}">{{ $doctor->fullName() }}</a></li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- end patient card -->

            <!-- patient cures -->
            <div class="tab-content tab-content-patient-cures">
                <div class="card">
                    test
                </div>
            </div>
            <!-- end patient cures -->
        </div>
        <!-- end base page content -->
    </div>

@endsection
