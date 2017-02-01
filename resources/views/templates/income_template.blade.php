<div>
    @php($nomenclatures = \App\Nomenclature::pluck('name', 'id'))
    <select
            class="input"
            id=""
            data-title="Номенклатура"
            data-subtitle="Выберите номенклатуру"
            data-search="{{ route('search.nomenclatures') }}"
            data-search-placeholder="Введите фразу для поиска номенклатуры"
            name="nomenclature[{i}][id]"
    ></select>

    <table class="table">
        <thead>
        <tr>
            <th>Amount</th>
            <th width="100">Batch date</th>
            <th width="100">Batch number</th>
            <th width="100">Price</th>
            <th width="50">Nds</th>
            <th width="100">Sum</th>
            <th width="80"></th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tr>
            <td colspan="7" class="pull-right no-right-padding">
                <a href="javascript:" class="btn btn-small add-batch">add batch</a>
                <a href="javascript:" class="btn btn-small btn-danger" data-delete-nomenclature>delete</a>
            </td>
        </tr>
    </table>
</div>

<template id="batch_row">
    <tr>
        <td class="has-input"><input type="text" class="input" name="nomenclature[{i}][batches][{row}][amount]" data-amount /></td>
        <td class="has-input"><input type="date" class="input" name="nomenclature[{i}][batches][{row}][batch_date]" data-date /></td>
        <td class="has-input"><input type="number" class="input" name="nomenclature[{i}][batches][{row}][batch_number]" data-number /></td>
        <td class="has-input"><input type="number" step="0.01" class="input" name="nomenclature[{i}][batches][{row}][price]" data-price /></td>
        <td class="has-input"><input type="number" step="0.1" class="input" name="nomenclature[{i}][batches][{row}][nds]" data-nds /></td>
        <td>
            <span data-total class="total">sum</span>
            <input type="hidden" data-total-input name="nomenclature[{i}][batches][{row}][total]">
        </td>
        <td class="pull-right">
            <a href="javascript:" data-delete-row>delete row</a>
        </td>
    </tr>
</template>
{{----}}
{{--<template id="item">--}}
{{--<tr>--}}
{{--<td class="has-input">--}}
{{--<input type="text" data-batch name="nomenclature[{i}][batch]" placeholder="Enter batch..." />--}}
{{--</td>--}}
{{--<td class="has-input">--}}
{{--<input type="text" data-price name="nomenclature[{i}][price]" placeholder="Enter price...">--}}
{{--</td>--}}
{{--<td class="has-input">--}}
{{--<input type="text" data-amount name="nomenclature[{i}][amount]" placeholder="Enter amount...">--}}
{{--</td>--}}
{{--<td class="has-input">--}}
{{--<input type="text" data-nds name="nomenclature[{i}][nds]" placeholder="Enter nds(%)...">--}}
{{--</td>--}}
{{--<td><span data-total class="total">sum</span>--}}
{{--<input type="hidden" data-total-input name="nomenclature[{i}][total]">--}}
{{--</td>--}}
{{--</tr>--}}
{{--</template>--}}