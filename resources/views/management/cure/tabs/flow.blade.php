<div class="flow">
    <table class="table table-striped" style="width: auto;">
        <thead>
        <tr>
            <th width="150">&nbsp;</th>
            @foreach($cure->days as $day)
                <th width="150" align="center">
                    {{ $day->day->format('d.m.Y') }}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Медикаменты</td>
            @foreach($cure->days as $day)
                <td>
                    <ul class="list">
                        @foreach($day->nomenclatures as $nomenclature)
                        {{ $nomenclature->name_for_department }}({{ $nomenclature->pivot->amount }})
                        @endforeach
                    </ul>
                </td>
            @endforeach
        </tr>
        <tr>
            <td>Процедуры</td>
            @foreach($cure->days as $day)
                <td></td>
            @endforeach
        </tr>
        </tbody>
    </table>
</div>
