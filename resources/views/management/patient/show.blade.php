@extends('layouts.app')

@section('content')

    <div class="grid grid-fixed patient-page">
        <div class="col-9">
            <!-- base page content -->
            <nav class="tabs tabs-bottom-offset tabs-vertical-offset" data-default=".tab-content-patient-card">
                <a href="javascript:" data-target=".tab-content-patient-card">@lang('management.label.patient.card')</a>
                <a href="javascript:" data-target=".tab-content-patient-cures">@lang('management.label.patient.cures')</a>
            </nav>

            <div class="tab-contents">
                <!-- patient-card -->
                <div class="tab-content tab-content-patient-card">
                    Patient
                </div>
                <!-- end patient card -->

                <!-- patient cures -->
                <div class="tab-content tab-content-patient-cures">
                    Cures
                </div>
                <!-- end patient cures -->
            </div>
            <!-- end base page content -->
        </div>
        <div class="col-3 patient-discussion">
            <!-- discussion -->
            <form class="discussion-form discussion-form-hidden">
                <textarea name="comment" placeholder="Enter your comment there"></textarea>
            </form>

            <discussions :patient-id="{{ $patient->id }}"></discussions>
            <!-- end discussion -->
        </div>
    </div>

@endsection