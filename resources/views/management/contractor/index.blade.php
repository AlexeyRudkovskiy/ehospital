@extends('layouts.app')

@section('content')
    <nav class="tabs" data-default=".tab-content-list">
        <a href="{{ route('contractor.index') }}?type=provider" @if($type == 'provider') class="active" @endif>Поставщики</a>
        <a href="{{ route('contractor.index') }}?type=recipient" @if($type == 'recipient') class="active" @endif>Получатели</a>
    </nav>
    <div class="tabs-contents">
        <div class="tab-content tab-content-list">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <th width="200">Полное название</th>
                    <th width="200">Тип</th>
                    <th width="150">ЄДРПОУ</th>
                    <th width="150" align="right" style="text-align: right;">
                        {{ link_to(route('contractor.create'), 'создать', ['class' => 'btn btn-default']) }}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($contractors as $contractor)
                    <tr>
                        <td><a href="{{ route('contractor.show', $contractor->id) }}">{{ $contractor->name }}</a></td>
                        <td>
                            {{ $contractor->fullName }}
                        </td>
                        <td>{{ $contractor->type }}</td>
                        <td>{{ $contractor->edrpou }}</td>
                        <td align="right">
                            <a href="{{ route('contractor.edit', $contractor->id) }}">редактировать</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {!! $contractors->links('layouts.pagination') !!}
    </div>
@stop