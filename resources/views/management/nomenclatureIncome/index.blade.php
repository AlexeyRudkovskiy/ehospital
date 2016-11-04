@extends('layouts.app', [
    'classes' => ['nomenclatureIncome-page']
])

@section('content')

    {!! Form::model($model, ['class' => 'form form-compact', 'route' => ['nomenclatureIncome.nomenclatures'], 'id' => 'nomenclature_income_form']) !!}

        <div class="step">
            {!! Form::ehSelect('source_of_financing_id', \App\SourceOfFinancing::pluck('name', 'id')) !!}

            {!! Form::ehSelect('contractor_id', \App\Contractor::whereGroup('provider')->pluck('name', 'id'), null, null, ['id' => 'contractor_select']) !!}

            <div class="form-group hidden" id="agreement_group">
                <div class="col-label">
                    <label for="agreement" class="label">Agreement</label>
                </div>
                <div class="col-input">
                    <select name="agreement_id" id="agreement_select" class="input"></select>
                </div>
            </div>

            {!! Form::ehSelect('storage_id', \App\Storage::pluck('name', 'id')) !!}
        </div>

        <div class="step hidden">
            <income-nomenclatures></income-nomenclatures>
        </div>

        <div class="form-footer row offset-top">
            <div class="pull-right">
                {{--<input type="submit" value="Next step" class="btn" />--}}
                <a href="javascript:" class="btn" id="nextStep">next step</a>
            </div>
        </div>

    {!! Form::close() !!}

@endsection