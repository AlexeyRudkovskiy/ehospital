<div class="info-compact">
    <div class="header underline">
        <h3>{{ $nomenclature->name }}</h3>
        <nav class="links">
            <a href="{{ route('nomenclature.edit', $nomenclature->id) }}">@lang('management.global.edit')</a><!--
                --><a href="javascript:" class="danger">@lang('management.global.delete')</a>
        </nav>
    </div>

    <table class="table table-striped-on-hover">
        <tr>
            <td width="250">Название для отделения</td>
            <td>{{ $nomenclature->name_for_department }}</td>
        </tr>
        <tr>
            <td>Короткое название</td>
            <td>{{ $nomenclature->small_name }}</td>
        </tr>
        <tr>
            <td>Количество в упаковке</td>
            <td>{{ $nomenclature->amount_in_a_package }}</td>
        </tr>
        @if($nomenclature->manufacturer != null)
            <tr>
                <td>Производитель</td>
                <td><a href="{{ route('manufacturer.show', $nomenclature->manufacturer->id) }}">{{ $nomenclature->manufacturer->name }}</a></td>
            </tr>
        @endif
        <tr>
            <td>НДС</td>
            <td>{{ $nomenclature->nds }}</td>
        </tr>
        <tr>
            <td>Штрихкод</td>
            <td>{{ $nomenclature->barcode }}</td>
        </tr>
        <tr>
            <td>МНН</td>
            <td>{{ strlen($nomenclature->inn_name) > 1 ? $nomenclature->inn_name : '-' }}</td>
        </tr>
        <tr>
            <td>Код морион</td>
            <td>{{ $nomenclature->morion_code }}</td>
        </tr>
        <tr>
            <td>АТС классификация</td>
            <td>{{ $nomenclature->atcClassification->name_ua }}</td>
        </tr>
        <tr>
            <td>Основная единица измерения</td>
            <td>{{ isset($nomenclature->baseUnit) ? $nomenclature->baseUnit->text : '' }}</td>
        </tr>
        <tr>
            <td>Базовая единица измерения</td>
            <td>{{ isset($nomenclature->basicUnit) ? $nomenclature->basicUnit->text : '' }}</td>
        </tr>
        <tr>
            <td>Источник финансирования</td>
            <td>{{ $nomenclature->sourceOfFinancing->name }}</td>
        </tr>
    </table>
</div>