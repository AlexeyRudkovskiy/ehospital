<div class="info-compact">
    <div class="header underline">
        <h3>{{ $cure->patient->name }}</h3>
        <nav class="links">
            <a href="{{ route('patient.edit', $cure->patient->id) }}">@lang('management.global.edit')</a><!--
            --><a href="{{ route('patient.inspection.edit', $cure->patient->id) }}">@lang('management.label.patient.inspection.edit')</a><!--
            --><a href="javascript:" class="danger">@lang('management.global.delete')</a>
        </nav>
    </div>
    <table class="table table-striped-on-hover">
        <tr>
            <td width="200">@lang('management.label.patient.phone')</td>
            <td><a href="tel:{{ $cure->patient->phone }}">{{ $cure->patient->phone }}</a></td>
        </tr>
        <tr>
            <td width="200">@lang('management.label.patient.birthday')</td>
            <td>{{ $cure->patient->birthday }}</td>
        </tr>
        @if($cure->patient->inspection != null)
            <tr>
                <td width="200">@lang('management.label.patient.inspection.bloodGroup')</td>
                <td>
                    {{ $cure->patient->inspection->blood_group }}
                </td>
            </tr>
            <tr>
                <td width="200">@lang('management.label.patient.inspection.rhFactor')</td>
                <td>
                    {{ $cure->patient->inspection->getRhFactor() }}
                </td>
            </tr>
            <tr>
                <td width="200">@lang('management.label.patient.inspection.bloodTransfusions')</td>
                <td class="no-paddings">
                    <ul class="info-list">
                        @foreach($cure->patient->inspection->bloodTransfusions as $bloodTransfusion)
                            <li>{{ $bloodTransfusion->data }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endif
        <tr>
            <td width="200">@lang('management.label.patient.ukrainian')</td>
            <td>{!! $miicon->toggle($cure->patient->ukrainian) !!}</td>
        </tr>
        <tr>
            <td width="200">@lang('management.label.patient.homeless')</td>
            <td>{!! $miicon->toggle($cure->patient->homeless) !!}</td>
        </tr>
        <tr>
            <td width="200">@lang('management.label.patient.hospital_employee')</td>
            <td>{!! $miicon->toggle($cure->patient->hospital_employee) !!}</td>
        </tr>
        <tr>
            <td width="200">@lang('management.label.patient.doctors')</td>
            <td class="no-paddings">
                <ul class="info-list">
                    @foreach($cure->patient->getDoctors() as $doctor)
                        <li><a href="{{ route('user.show', $doctor->id) }}">{{ $doctor->fullName() }}</a></li>
                    @endforeach
                </ul>
            </td>
        </tr>
    </table>
</div>