{!! Form::model(new stdClass(), ['route' => ['patient.hospitalization.post'], 'method' => 'post', 'class' => "form form-compact steps"]) !!}

    {!! Form::hidden('patient_id', $patient->id) !!}

    <div class="step">
        {!! Form::ehSelect('department_id', \App\Department::pluck('name', 'id'), null, null, [
            'id' => 'hospitalization_department',
            'data-title' => 'Отделение',
            'data-subtitle' => "Выберите отделение",
            'data-search' => route('search.department'),
            'data-search-placeholder' => 'Введите фразу для поиска отделения'
        ]) !!}

        {!! Form::ehSelect('user_id', \App\User::pluck('firstName', 'id'), null, null, [
            'id' => 'user_id',
            'data-title' => 'Пользователь',
            'data-subtitle' => "Выберите пользователя",
            'data-search' => route('search.users'),
            'data-search-placeholder' => 'Введите фразу для поиска пользователя'
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
    </div>

    <div class="step">
        @include('management.patient.tabs.hospitalization_nomenclatures')
    </div>

    <div class="form-footer row offset-top">
        <div class="pull-right">
            {{--<input type="submit" value="Next step" class="btn" />--}}
            <a href="javascript:" class="btn next-step">next step</a>
        </div>
    </div>

    {!! Form::ehSave() !!}

{!! Form::close() !!}