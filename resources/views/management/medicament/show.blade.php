@extends('layouts.app')

@section('content')
    <div class="medicament-page">
        <nav class="tabs tabs-vertical-offset" data-default=".tab-content-info">
            <a href="javascript:" data-target=".tab-content-info">@lang('management.label.medicament.info')</a>
            <a href="javascript:" data-target=".tab-content-revisions">@lang('management.label.medicament.revisions')</a>
            <a href="javascript:" data-target=".tab-content-series">@lang('management.label.medicament.series')</a>
            <a href="javascript:" data-target=".tab-content-statistic">@lang('management.label.medicament.statistic')</a>
        </nav>

        <!-- Информация об медикаменте -->
        <div class="tab-content tab-content-info">
            <div class="medicament-info-compact">
                <div class="header underline">
                    <h3>{{ $medicament->name }}</h3>
                    <nav class="links">
                        <a href="javascript:">edit</a><!--
                        --><a href="javascript:" class="danger">delete</a>
                    </nav>
                </div>
                <table class="table table-striped-on-hover">
                    <tr>
                        <td width="200">Название для отделения</td>
                        <td>{{ $medicament->name_for_department }}</td>
                    </tr>
                    <tr>
                        <td>Короткое название</td>
                        <td>{{ $medicament->small_name }}</td>
                    </tr>
                    <tr>
                        <td>Количество в упаковке</td>
                        <td>{{ $medicament->amount_in_a_package }}</td>
                    </tr>
                    <tr>
                        <td>НДС</td>
                        <td>{{ $medicament->nds }}</td>
                    </tr>
                    <tr>
                        <td>Штрихкод</td>
                        <td>{{ $medicament->barcode }}</td>
                    </tr>
                    <tr>
                        <td>МНН</td>
                        <td>{{ strlen($medicament->inn_name) > 1 ? $medicament->inn_name : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Код морион</td>
                        <td>{{ $medicament->morion_code }}</td>
                    </tr>
                    <tr>
                        <td>АТС классификация</td>
                        <td>{{ $medicament->atcClassification->name_ua }}</td>
                    </tr>
                    <tr>
                        <td>Основная единица измерения</td>
                        <td>{{ isset($medicament->baseUnit) ? $medicament->baseUnit->text : '' }}</td>
                    </tr>
                    <tr>
                        <td>Базовая единица измерения</td>
                        <td>{{ isset($medicament->basicUnit) ? $medicament->basicUnit->text : '' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Изменения медикамета -->
        <div class="tab-content tab-content-revisions">
            @foreach($medicament->revisions as $revision)
                <div class="revision-card">
                    <div class="revision-header">
                        <div>
                            <a href="javascript:" class="bold">{{ $revision->getDiff()->author->fullName() }}</a>
                        </div>
                        <div>
                            <span>{{ $revision->getDiff()->date }}</span>
                        </div>
                    </div>
                    <div class="revision-content">
                        @foreach($revision->getDiff()->diff as $key => $diff)
                        <div class="revision-item">
                            <div class="revision-item-name">
                                <span>{{ $key }}</span>
                            </div>
                            <div class="revision-item-from">
                                <span>{{ $diff['from'] }}</span>
                            </div>
                            <div class="revision-item-to">
                                <span>{{ $diff['to'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop