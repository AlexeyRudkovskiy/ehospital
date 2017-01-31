@extends('layouts.app')

@section('content')

    {!! Form::open([ 'url' => route('nomenclature.request.create', $request) ]) !!}

    <table class="table">
        <thead>
        <tr>
            <th>Nomenclature</th>
            <th width="150">Amount</th>
            <th width="150" class="pull-right">Requested</th>
            <th width="150" class="pull-right">In stock</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item['nomenclature']->name }}</td>
            <td class="has-input">
                {!! Form::text('nomenclature[' . $item['nomenclature']->id . ']', $item['accepted'] ?? '', array_merge([
                    'class' => 'input',
                    'placeholder' => 'Enter amount there'
                ], $item['accepted'] ?? false ? [ 'disabled' => 'disabled' ] : [])) !!}
            </td>
            <td class="pull-right">{{ number_format($item['amount'], 2) }}</td>
            <td class="pull-right">{{ number_format($item['nomenclature']->balance(), 2) }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pull-right offset-top">
        <input type="submit" class="btn btn-success" value="@lang('management.global.save')" />
    </div>
    <div class="clear"></div>

    {!! Form::close() !!}

@endsection