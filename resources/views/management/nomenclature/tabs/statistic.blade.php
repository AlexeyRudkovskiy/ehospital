<div class="cards">
    @foreach($nomenclature->historyWithoutArmored as $item)
        <div class="card">
            <div class="card-header" data-icon="@if($item->status == 'outgoing') file_upload @elseif($item->status == 'income') file_download @endif">
                <p class="title">
                    @if($item->status == 'outgoing')
                        Расход
                    @elseif($item->status == 'income')
                        Поступление
                    @endif
                </p>
                <p class="subtitle">
                    @if($item->status == 'outgoing')
                        <a href="{{ route('nomenclatureRequest.show', $item->nomenclature_request_id) }}" target="_blank">Подробнее</a>
                    @elseif($item->status == 'income')
                        <a href="{{ route('nomenclatureIncome.show', $item->nomenclature_income_id) }}" target="_blank">Поступление</a>
                    @endif
                </p>
            </div>
            <div class="card-content">
                <p class="bold">Выполнил:</p>
                <p><a href="{{ route('user.show', $item->user->id) }}" target="_blank">{{ $item->user->fullName() }}</a></p>
                <p class="bold">Количество:</p>
                @if($item->status == 'outgoing')
                    <p>{{ $item->amount }} ({{ $item->nomenclature->basicUnit->text }})</p>
                @elseif($item->status == 'income')
                    <p>{{ $item->amount * $item->nomenclature->amount_in_a_package }} ({{ $item->nomenclature->basicUnit->text }})</p>
                @endif
            </div>
        </div>
    @endforeach
</div>