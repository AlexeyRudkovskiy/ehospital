{!! Form::open(['route' => ['cure.review.post', $cure->id], 'method' => 'post', 'class' => 'form form-compact']) !!}
    <attach-nomenclatures review="true"></attach-nomenclatures>

    {!! Form::ehSave() !!}
{!! Form::close() !!}

<script>
    window.review = JSON.parse('{!! json_encode($cure->review) !!}');
</script>