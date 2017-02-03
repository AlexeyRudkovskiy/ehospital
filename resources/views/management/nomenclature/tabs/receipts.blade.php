<table class="table">
<thead>
<tr>
    <th>Дата</th>
    <th width="350">Выполнил</th>
    <th width="180" class="pull-right">Количество</th>
</tr>
</thead>
<tbody>
@foreach($nomenclature->incomeHistory() as $item)
<tr>
    <td><a href="{{ route('nomenclature.income.show', $item->nomenclatureIncome->id) }}">{{ $item->created_at }}</a></td>
    <td><a href="{{ route('user.show', $item->user->id) }}" target="_blank">{{ $item->user->fullName() }}</a></td>
    <td class="pull-right">{{ $item->amount }} ({{ $item->nomenclature->basicUnit->text }})</td>
</tr>
@endforeach
</tbody>
</table>