{!! Form::open(['route' => ['cure.review.post', $cure->id], 'method' => 'post', 'class' => 'form form-compact', 'id' => 'review-form'] ) !!}
    <attach-nomenclatures review="true"></attach-nomenclatures>

    <div class="form-group form-group-static row row-static">
        <div class="col-3 col-label">
            <label class="label">&nbsp;</label>
        </div>
        <div class="col-9 col-input">
            <input type="submit" class="btn btn-success btn-fill" value="save" />
            <label for="accepted">
                <input type="checkbox" id="accepted" name="accepted" value="1" />
                <input type="button" class="btn btn-success btn-fill" onclick="document.getElementById('accepted').checked = true; document.getElementById('review-form').submit()" value="approve" />
            </label>
        </div>
    </div>
{!! Form::close() !!}

<script>
    window.review = JSON.parse('{!! json_encode($cure->review) !!}');
</script>