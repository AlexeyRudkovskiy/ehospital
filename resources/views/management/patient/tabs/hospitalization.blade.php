{!! Form::model(new stdClass(), ['route' => ['patient.hospitalization.post'], 'method' => 'post', 'class' => "form form-compact"]) !!}

    {!! Form::hidden('patient_id', $patient->id) !!}

    {!! Form::ehSelect('department_id', \App\Department::pluck('name', 'id'), null, null, [
        'id' => 'hospitalization_department'
    ]) !!}

    <div style="display: none;" id="doctors_list">

        <div class="form-group">
            <div class="col-label">
                <label for="department_id" class="label">User</label>
            </div>
            <div class="col-input">
                <select class="input" id="doctor_select" name="doctor_select"></select>
            </div>
        </div>

    </div>

    {!! Form::ehDate('hospitalization_date') !!}

    {!! Form::ehText('diagnosis') !!}

    {!! Form::ehTextarea('comment') !!}

    {!! Form::ehSave() !!}

{!! Form::close() !!}