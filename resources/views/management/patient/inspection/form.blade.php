@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{!! Form::ehSelect('blood_group', array_combine(range(1, 4), range(1, 4)), trans('management.label.patient.inspection.bloodGroup')) !!}

{!! Form::ehRadioGroup(trans('management.label.patient.inspection.rhFactor'), [
    [ 'rh_factor', '1', trans('management.label.patient.inspection.rhFactorPositive') ],
    [ 'rh_factor', '0', trans('management.label.patient.inspection.rhFactorNegative') ]
]) !!}

{!! Form::ehTextarea('diabetes', null, $patient->inspection != null ? $patient->inspection->diabetes : null, ['class' => 'input input-textarea-small']) !!}

{!! Form::ehTextarea('allergic_history', null, null, ['class' => 'input input-textarea-small']) !!}

<div class="form-group">
    <div class="col-label">
        <label class="label">
            @lang('management.label.patient.inspection.bloodTransfusions')
        </label>
    </div>
    <div class="col-input inspection-input-list">
        <input-list
            name="blood_transfusions"
            @if(isset($isEdit) && $isEdit == true)
            editable="patient.inspection.blood_transfusions"
            editable-key="data"
            @endif
        ></input-list>
    </div>
</div>

{!! Form::ehSave() !!}