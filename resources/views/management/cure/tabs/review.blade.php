@include('layouts.widgets.calendar', [ 'defaultData' => $defaultData ])

<script>
    window.review = JSON.parse('{!! json_encode($cure->review) !!}');
</script>