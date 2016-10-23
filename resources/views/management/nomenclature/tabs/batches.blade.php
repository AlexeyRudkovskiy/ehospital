<table class="table">
    <thead>
    <tr>
        <th>Expiration date</th>
        <th width="150">Number</th>
        <th width="150">Balance</th>
        <th width="150">Price</th>
        <th width="100" align="right" style="text-align: right;">
            {{ link_to(route('nomenclature.batch.create', $nomenclature->id), 'создать', ['class' => 'btn btn-default']) }}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomenclature->batches as $batch)
        <tr>
            <td>{{ $batch->expiration_date }}</td>
            <td>{{ $batch->batch_number }}</td>
            <td>{{ $batch->getBalance() }}</td>
            <td>{{ $batch->price }}</td>
            <td align="right" style="text-align: right">
                <div class="btn-group">
                    <a href="{{ route('nomenclature.batch.edit', [$nomenclature->id, $batch->id]) }}" class="mi-btn mi-btn-small mi-round mi-background">edit</a><!--
                    -->{!! Form::open(['route' => ['nomenclature.batch.destroy', $nomenclature->id, $batch->id], 'method' => 'delete']) !!}<!--
                    --><a href="javascript:" onclick="this.parentElement.submit()" class="mi-btn mi-btn-small mi-btn-danger mi-round mi-background">delete</a><!--
                    -->{!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>