@extends('layouts.app', [
    'classes' => ['nomenclatureIncome-page']
])

@section('content')

    {!! Form::model($model, ['class' => 'form form-compact steps', 'route' => ['nomenclatureIncome.nomenclatures'], 'id' => 'nomenclature_income_form', 'data-form' => '']) !!}

        <div class="step">
            {!! Form::ehSelect('source_of_financing_id', \App\SourceOfFinancing::pluck('name', 'id')) !!}

            {!! Form::ehSelect('contractor_id', \App\Contractor::whereGroup('provider')->pluck('name', 'id'), null, null, ['id' => 'contractor_select']) !!}

            <div class="form-group hidden" id="agreement_group">
                <div class="label">
                    <label for="agreement">Agreement</label>
                </div>
                <div class="input-wrapper">
                    <select name="agreement_id" id="agreement_select" class="input"></select>
                </div>
            </div>

            {!! Form::ehSelect('storage_id', \App\Storage::pluck('name', 'id')) !!}
        </div>

        <div class="step incomeTable">
            <table class="table table-small">
                <thead>
                <tr>
                    <th>Nomenclature</th>
                    <th>Batch</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Nds</th>
                    <th>Sum</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div>
                <a style="float:right;" href="javascript:" class="btn" id="addRow">add item</a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="form-footer row offset-top">
            <div class="pull-right">
                {{--<input type="submit" value="Next step" class="btn" />--}}
                <a href="javascript:" class="btn next-step">next step</a>
            </div>
        </div>

    {!! Form::close() !!}

@endsection