<div class="popup-header">
    <div class="row row-fixed">
        <div class="col-10 title">Header</div>
        <div class="col-2 pull-right"><i class="close">close</i></div>
    </div>
</div>
<div class="popup-content">
    <div class="fake-form">
        <div class="form-group row row-fixed">
            <div class="col-4 col-label">
                <label for="nomenclature_id">Nomenclature</label>
            </div>
            <div class="col-8 col-input">
                <select name="nomenclature_id" id="nomenclature_id" class="input"></select>
            </div>
        </div>

        <div class="form-group row row-fixed">
            <div class="col-4 col-label">
                <label for="nomenclature_id">Unit</label>
            </div>
            <div class="col-8 col-input">
                <select name="unit_id" id="unit_id" class="input"></select>
            </div>
        </div>

        <div class="form-group row row-fixed">
            <div class="col-4 col-label">
                <label for="from_day">From</label>
            </div>
            <div class="col-8 col-input">
                <input type="date" class="input" name="from_day" id="from_day" />
            </div>
        </div>

        <div class="form-group row row-fixed">
            <div class="col-4 col-label">
                <label for="until_day">Until</label>
            </div>
            <div class="col-8 col-input">
                <input type="date" class="input" name="until_day" id="until_day" />
            </div>
        </div>

        <div class="form-group row row-fixed">
            <div class="col-4 col-label">
                <label for="amount">Amount</label>
            </div>
            <div class="col-8 col-input">
                <input type="number" step="0.1" class="input" name="amount" id="amount" />
            </div>
        </div>

        <div class="form-group row row-fixed">
            <div class="col-4 col-label">
                <label for="comment">Comment</label>
            </div>
            <div class="col-8 col-input">
                <textarea name="comment" id="comment" class="input input-textarea-small"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="popup-footer">
    <div class="row row-fixed">
        <div class="col-3 pull-right">
            {!! Form::button('add day', ['class' => 'btn btn-success', 'id' => "add_day"]) !!}
        </div>
    </div>
</div>