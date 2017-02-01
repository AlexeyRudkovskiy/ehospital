@extends('layouts.app', [
    'classes' => ['nomenclatureIncome-page']
])

@section('content')

    {!! Form::model($model, ['class' => 'form form-compact steps', 'route' => ['nomenclatureIncome.nomenclatures'], 'id' => 'nomenclature_income_form', 'data-form' => '']) !!}

        <div class="step">

            {!! Form::ehSelect('source_of_financing_id', \App\SourceOfFinancing::pluck('name', 'id')) !!}

            {!! Form::ehSelect('contractor_id', collect([]), null, null, [
                'id' => 'contractor_select',
                'data-title' => 'Контрагент',
                'data-subtitle' => "Выберите контрагента",
                'data-search' => route('search.contractors'),
                'data-search-placeholder' => 'Введите фразу для поиска контрагента'
            ]) !!}

            {!! Form::ehSelect('agreement_id', collect([]), null, null, [
                'id' => 'agreements_select',
                'data-title' => 'Договор',
                'data-subtitle' => "Выберите договор"
            ]) !!}

            {!! Form::ehSelect('storage_id', \App\Storage::pluck('name', 'id')) !!}
        </div>

        <div class="step incomeTable">

            <div class="income-container"></div>

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