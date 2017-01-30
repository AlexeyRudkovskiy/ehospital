<table class="table">
    <thead>
    <tr>
        <th>Name</th>
        <th class="pull-right" width="150">Items inside</th>
        <th class="pull-right no-vertical-paddings small-right-padding" width="75"><a href="{{ route('department.nomenclature_set.create') }}" class="mi-icon use-shadow">create</a></th>
    </tr>
    </thead>
    <tbody>
        @foreach($department->nomenclatureSets as $set)
            <tr>
                <td><a href="{{ route('department.nomenclature_set.show', $set->id) }}">{{ $set->name }}</a></td>
                <td class="pull-right">{{ $set->items()->count() }}</td>
                <td class="pull-right no-vertical-paddings small-right-padding vertical-aligned">
                    <div class="inline-list pull-right">
                        <a href="{{ route('department.nomenclature_set.edit', $set->id) }}" class="mi-icon use-shadow">edit</a>
                        <a href="{{ route('department.nomenclature_set.delete', $set->id) }}" class="mi-icon use-shadow">delete</a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
