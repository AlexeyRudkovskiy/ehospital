@extends('layouts.app')

@section('content')
    {!! Form::open(['class' => 'form']) !!}

    {!! Form::ehRadioGroup('gender', [
        [ 'gender', 1, 'Мужской'],
        [ 'gender', 0, 'Женский']
    ]) !!}

    {!! Form::ehText('patient_full_name') !!}

    {!! Form::ehDate('birthday') !!}

    {!! Form::ehSelect('identification_document', ['Паспорт']) !!}

    {!! Form::ehText('id_document_number') !!}

    {!! Form::ehText('country_code') !!}

    {!! Form::ehRadioGroup('place_of_residence', [
        [ 'place_of_residence', 1, 'Город' ],
        [ 'place_of_residence', 2, 'Село' ]
    ]) !!}

    {!! Form::ehText('region') !!}

    {!! Form::ehText('street_and_house') !!}

    {!! Form::ehText('work_address') !!}

    <!-- кем направлено -->

    {!! Form::ehRadioGroup('hospitalization_type', [
        [ 'hospitalization_type', 1, 'Ургентна' ],
        [ 'hospitalization_type', 2, 'Планова' ]
    ]) !!}

    {!! Form::ehRadioGroup('По этому же заболеванию в этом году', [
        ['readmission', 1, 'Вперше'],
        ['readmission', 2, 'Повторно']
    ]) !!}

    {!! Form::ehRadioGroup('Повторная госпитализация в течении 30 дней(по этой же болезни)', [
        ['readmission_30_days', 1, 'Да'],
        ['readmission_30_days', 2, 'Нет']
    ]) !!}

    {!! Form::ehRadioGroup('Дополнительные диагнозы', [
        ['complication_of_primary_diagnosis', 1, "Осложнение основного диагноза"],
        ['complication_of_primary_diagnosis', 2, "Сопутствующее"]
    ]) !!}

    {!! Form::ehRadioGroup('Категорія резистентності', [
        [ 'resistance', 1, "Відсутня"],
        [ 'resistance', 2, "Чутливий ТБ"],
        [ 'resistance', 3, "Монорезистентний ТБ"],
        [ 'resistance', 4, "Полірезистентний ТБ"],
        [ 'resistance', 5, "Мудьтирезистентний ТБ"],
        [ 'resistance', 6, "Туберкульоз із розширеною резистентністю"]
    ]) !!}

    {!! Form::ehSave() !!}

    {!! Form::close() !!}
@endsection