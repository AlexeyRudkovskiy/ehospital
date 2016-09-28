@extends('layouts.app')

@section('content')
    <div class="medicament-page">
        <nav class="tabs tabs-vertical-offset" data-default=".tab-content-info">
            <a href="javascript:" data-target=".tab-content-info">@lang('management.label.medicament.info')</a>
            <a href="javascript:" data-target=".tab-content-revisions">@lang('management.label.medicament.revisions')</a>
            <a href="javascript:" data-target=".tab-content-batches">@lang('management.label.medicament.series')</a>
            <a href="javascript:" data-target=".tab-content-statistic">@lang('management.label.medicament.statistic')</a>

            <div class="right">
                <a href="javascript:" id="medicament_income" class="mi-btn">file_download</a><!--
                --><a href="javascript:" id="medicament_outgoing" class="mi-btn">file_upload</a>
            </div>
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

        <div class="tab-content tab-content-batches">
            <table class="table">
            <thead>
                <tr>
                    <th>Expiration date</th>
                    <th width="200">Number</th>
                    <th width="150">Price</th>
                    <th width="200" align="right" style="text-align: right;">
                        {{ link_to(route('medicament.batch.create', $medicament->id), 'создать', ['class' => 'btn btn-default']) }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicament->batches as $batch)
                <tr>
                    <td>{{ $batch->expiration_date }}</td>
                    <td>{{ $batch->batch_number }}</td>
                    <td>{{ $batch->price }}</td>
                    <td align="right" style="text-align: right">
                        <div class="btn-group">
                            <a href="javascript:" class="mi-btn mi-btn-small">edit</a><!--
                            --><a href="javascript:" class="mi-btn mi-btn-small mi-btn-danger">delete</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>

        <div class="tab-content tab-content-statistic">
            <balance-component :balance="{{ $medicament->balance() }}"></balance-component>
        </div>

    </div>
@stop

@push('scripts')
<script>
    window.medicament = {
        id: {{ $medicament->id }},
        name: '{{ $medicament->name }}'
    };
</script>
@endpush