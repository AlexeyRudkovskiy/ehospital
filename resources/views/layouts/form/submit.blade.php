@if(!$empty ?? true)
<div class="form-group">
    <div class="col-label">
        <label class="label">&nbsp;</label>
    </div>
    <div class="col-input">
        {!! Form::submit($title ?? trans('management.label.save'), array_merge(['class' => 'btn btn-success'], $attributes ?? [])) !!}
    </div>
</div>
@else
    {!! Form::submit($title ?? trans('management.label.save'), array_merge(['class' => 'btn btn-success'], $attributes ?? [])) !!}
@endif