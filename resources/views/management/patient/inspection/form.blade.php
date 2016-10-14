{!! Form::ehNumber('blood_group') !!}

{!! Form::ehRadioGroup(trans('management.label.patient.inspection.rhFactor'), [
    [ 'rh_factor', '1', 'Положительный' ],
    [ 'rh_factor', '0', 'Отрицательный' ]
]) !!}

<div class="form-group">
    <div class="col-label">
        <label class="label">
            @lang('management.label.patient.inspection.bloodTransfusions')
        </label>
    </div>
    <div class="col-input inspection-input-list">
        <input-list name="blood_transfusions"></input-list>
    </div>
</div>