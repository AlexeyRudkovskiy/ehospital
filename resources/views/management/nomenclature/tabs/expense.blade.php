<table class="table">
    <thead>
    <tr>
        <th>Дата</th>
        <th>Выполнил</th>
        <th>Количество</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomenclature->expenseHistory() as $item)
        <tr>
            <td>{{ $item->created_at }}</td>
            <td><a href="{{ route('user.show', $item->user->id) }}" target="_blank">{{ $item->user->fullName() }}</a></td>
            <td>{{ $item->amount }} ({{ $item->nomenclature->basicUnit->text }})</td>
        </tr>
    @endforeach
    </tbody>
</table>