{!! Form::open(['route' => ['cure.review.post', $cure], 'method' => 'post']) !!}
@include('layouts.widgets.calendar', [ 'defaultData' => $defaultData, 'viewUnderCalendar' => 'management.cure.tabs.partials.chiefViewUnderCalendar' ])
{!! Form::close() !!}

<script>
    window.review = JSON.parse('{!! json_encode($cure->review) !!}');
    window.calendar = {
        justView: true
    };
</script>