<div class="cards">
    @foreach($income->nomenclatures as $nomenclature)
        <div class="card">
            <div class="card-header">
                <p class="title"><a href="{{ route('nomenclature.show', $nomenclature->id) }}">{{ $nomenclature->name }}</a></p>
            </div>
            <div class="card-content">
                <p>Кол-во: {{ $nomenclature->amount }}</p>
                <p>Цена: {{ number_format($nomenclature->price, 2) }}</p>
            </div>
        </div>
    @endforeach
</div>