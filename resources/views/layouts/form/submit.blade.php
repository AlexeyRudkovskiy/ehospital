@if(!$empty ?? true)
<div class="form-group">
    <div class="label">
        <label class="label">&nbsp;</label>
    </div>
    <div class="input-wrapper">
        {!! Form::submit($title ?? trans('management.label.save'), array_merge(['class' => 'btn btn-success'], $attributes ?? [])) !!}
    </div>
</div>
@else
    {!! Form::submit($title ?? trans('management.label.save'), array_merge(['class' => 'btn btn-success'], $attributes ?? [])) !!}
@endif
