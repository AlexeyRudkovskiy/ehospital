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
                <select name="nomenclature_id" id="nomenclature_id" class="input">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
        </div>

        <div class="form-group row row-fixed">
            <div class="col-4 col-label">
                <label for="day">Day</label>
            </div>
            <div class="col-8 col-input">
                <input type="date" class="input" name="day" id="day" />
            </div>
        </div>

        <div class="form-group row row-fixed">
            <div class="col-4 col-label">
                <label for="day">Amount</label>
            </div>
            <div class="col-8 col-input">
                <input type="number" step="0.1" class="input" name="amount" id="amount" />
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