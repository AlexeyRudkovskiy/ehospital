<div class="header">
    <span class="title">Income</span>
</div>
<div class="popup-content">
    {!! Form::open(['route' => ['api.medicament.income.post', $medicament->id], 'method' => 'post', 'class' => "form form-compact"]) !!}
    {!! Form::ehText('income') !!}
    {!! Form::ehSave() !!}
    {!! Form::hidden('user_id', auth()->id()) !!}
    {!! Form::close() !!}
</div>