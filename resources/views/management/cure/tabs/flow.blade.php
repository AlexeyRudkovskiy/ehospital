<div class="flow row">
    <table class="table table-striped" style="width: auto;">
        <thead>
        <tr>
            <th width="150">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="height: 43px;">Медикаменты</td>
        </tr>
        <tr>
            <td>Процедуры</td>
        </tr>
        </tbody>
    </table>

    <div style="width: 100%; max-width: 500px; overflow-x: scroll;">
        <table class="table table-striped" style="width: auto;">
            <thead>
            <tr>
                @foreach($cure->days as $day)
                    <th style="width: 600px;" align="center">
                        {{ $day->day->format('d.m.Y') }}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach($cure->days as $day)
                    <td>
                        <ul class="list">
                            @foreach($day->nomenclatures as $nomenclature)
                                <li>{{ $nomenclature->name_for_department }}({{ $nomenclature->pivot->amount }})</li>
                            @endforeach
                        </ul>
                    </td>
                @endforeach
            </tr>
            <tr>
                @foreach($cure->days as $day)
                    <td style="min-height: 14px;"></td>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>

</div>
