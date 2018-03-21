@extends('layouts.offcialapp')

@section('content')


<h3>Calendar</h3>

<div id='calendar'></div>

@endsection
@push('scripts')

<script>

  $(document).ready(function() {
      $('#calendar').fullCalendar({
          defaultDate: '2014-09-12',
          editable: true,
          eventLimit: true, // allow "more" link when too many events
      });

  });
</script>
@endpush
