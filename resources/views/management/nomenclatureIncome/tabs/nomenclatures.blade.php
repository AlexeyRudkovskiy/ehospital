<div class="nomenclatures-list">
    @foreach($income->nomenclatures as $nomenclature)
        <div class="card card-income">
            <p class="nomenclature-name"><a href="{{ route('nomenclature.show', $nomenclature->id) }}">{{ $nomenclature->name }}</a></p>
            <p>Кол-во: {{ $nomenclature->amount }}</p>
            <p>Цена: {{ number_format($nomenclature->price, 2) }}</p>
            <p>Ед. измерения: {{ $nomenclature->unit->text }}</p>
        </div>
    @endforeach
</div>