@extends('layouts.app')

@section('content')
    <div>
        <h2>{{ $medicament->name }}</h2>
    </div>
    <table class="table">
        <tr>
            <td width="200">Name for department</td>
            <td>{{ $medicament->name_for_department }}</td>
        </tr>
        <tr>
            <td>Small name:</td>
            <td>{{ $medicament->small_name }}</td>
        </tr>
        <tr>
            <td>Amount in a package:</td>
            <td>{{ $medicament->amount_in_a_package }}</td>
        </tr>
        <tr>
            <td>NDS:</td>
            <td>{{ $medicament->nds }}</td>
        </tr>
        <tr>
            <td>Barcode:</td>
            <td>{{ $medicament->barcode }}</td>
        </tr>
        <tr>
            <td>Morion code:</td>
            <td>{{ $medicament->morion_code }}</td>
        </tr>
        <tr>
            <td>ATC Classification:</td>
            <td>{{ $medicament->atcClassification->name_ua }}</td>
        </tr>
        <tr>
            <td>Base unit:</td>
            <td>{{ isset($medicament->baseUnit) ? $medicament->baseUnit->text : '' }}</td>
        </tr>
        <tr>
            <td>Basic unit:</td>
            <td>{{ isset($medicament->basicUnit) ? $medicament->basicUnit->text : '' }}</td>
        </tr>
    </table>
    <div>
        <h3>Revisions:</h3>
    </div>
    @foreach($medicament->revisions as $revision)
        <div>
            <div>
                <a href="javascript:" style="font-weight: bold;;">{{ $revision->getDiff()->author->fullName() }}</a>
                <br>
                <span>{{ $revision->getDiff()->date->format('d-m-Y') }}</span>
            </div>
            <table class="table">
            @foreach($revision->getDiff()->diff as $key=>$diff)
                <tr>
                    <td width="200">{{ $key }}</td>
                    <td>
                        <p>From: {{ $diff['from'] }}</p>
                        <p>To: {{ $diff['to'] }}</p>
                    </td>
                </tr>
            @endforeach
            </table>
        </div>
    @endforeach
@stop