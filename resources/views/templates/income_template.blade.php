<tr>
    <td class="has-input">
        @php($nomenclatures = \App\Nomenclature::pluck('name', 'id'))
        <select name="nomenclature[{i}][id]" class="input">
        @foreach($nomenclatures as $id=>$name)
            <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
        </select>
{{--        {!! Form::select('nomenclature', \App\Nomenclature::pluck('name', 'id'), null, ['class' => 'input']) !!}--}}
    </td>
    <td class="has-input">
        <input type="text" data-batch name="nomenclature[{i}][batch]" placeholder="Enter batch..." />
    </td>
    <td class="has-input">
        <input type="text" data-price name="nomenclature[{i}][price]" placeholder="Enter price...">
    </td>
    <td class="has-input">
        <input type="text" data-amount name="nomenclature[{i}][amount]" placeholder="Enter amount...">
    </td>
    <td class="has-input">
        <input type="text" data-nds name="nomenclature[{i}][nds]" placeholder="Enter nds(%)...">
    </td>
    <td><span data-total class="total">sum</span>
        <input type="hidden" data-total-input name="nomenclature[{i}][total]"></td>
</tr>