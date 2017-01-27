<table class="table">
    <thead>
    <tr>
        <th>Name</th>
        <th class="pull-right" width="150">Items inside</th>
    </tr>
    </thead>
    <tbody>
        @foreach($department->nomenclatureSets as $set)
            <tr>
                <td><a href="{{ route('department.nomenclature_set.show', $set->id) }}">{{ $set->name }}</a></td>
                <td class="pull-right">{{ $set->items()->count() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>