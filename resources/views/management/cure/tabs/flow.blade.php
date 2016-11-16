<div class="flow">

    <table class="table table-striped">
        <thead>
        <tr>
            <th width="110">Дата</th>
            <th>Номенклатуры</th>
            <th>Процедуры</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cure->days as $day)
        <tr>
            <td>{{ $day->day->format('d.m.Y') }}</td>
            <td>foo</td>
            <td>bar</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{--<div class="row like-header">--}}
        {{--<div class="col">&nbsp;</div>--}}
        {{--@foreach($cure->days as $day)--}}
            {{--<div class="col centered">--}}
                {{--{{ $day->day->format('d.m.Y') }}--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--</div>--}}

    {{--<div class="row">--}}
        {{--<div class="col">Медикаменты</div>--}}
        {{--@foreach($cure->days as $day)--}}
            {{--<div class="col">--}}
                {{--<ul class="list">--}}
                    {{--@foreach($day->nomenclatures as $nomenclature)--}}
                        {{--<li>{{ $nomenclature->name_for_department }}({{ $nomenclature->pivot->amount }})</li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--</div>--}}

    {{--<div class="row striped">--}}
        {{--<div class="col">Процедуры</div>--}}
        {{--@foreach($cure->days as $day)--}}
            {{--<div class="col">--}}
                {{--<!-- empty -->--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--</div>--}}


    {{--<div style="width: 100%; max-width: 500px; overflow-x: scroll;">--}}
        {{--<table class="table table-striped" style="width: auto;">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th style="width: 300px">&nbsp;</th>--}}
                {{--@foreach($cure->days as $day)--}}
                    {{--<th style="width: 600px;" align="center">--}}
                        {{--{{ $day->day->format('d.m.Y') }}--}}
                    {{--</th>--}}
                {{--@endforeach--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--<tr>--}}
                {{--<td>Медикаменты</td>--}}
                {{--@foreach($cure->days as $day)--}}
                    {{--<td>--}}
                        {{--<ul class="list">--}}
                            {{--@foreach($day->nomenclatures as $nomenclature)--}}
                                {{--<li>{{ $nomenclature->name_for_department }}({{ $nomenclature->pivot->amount }})</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</td>--}}
                {{--@endforeach--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td>Процедуры</td>--}}
                {{--@foreach($cure->days as $day)--}}
                    {{--<td style="min-height: 14px;"></td>--}}
                {{--@endforeach--}}
            {{--</tr>--}}
            {{--</tbody>--}}
        {{--</table>--}}
    {{--</div>--}}

</div>
