@extends("layouts.employee")
@section("pageTitle", "Koala Web Libraries")
@section('styleChart')
<style>
    html, body {
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}

#calendar {
  max-width: 900px;
  margin: 40px auto;
}
.tooltipevent{
    width:200px;/*
    height:100px;*/
    background:#ccc;
    position:absolute;
    z-index:10001;
    transform:translate3d(-50%,-100%,0);
    font-size: 0.8rem;
    box-shadow: 1px 1px 3px 0px #888888;
    line-height: 1rem;
}
.tooltipevent div{
    padding:10px;
}
.tooltipevent div:first-child{
    font-weight:bold;
    color:White;
    background-color:#888888;
    border:solid 1px black;
}
.tooltipevent div:last-child{
    background-color:whitesmoke;
    position:relative;
}
.tooltipevent div:last-child::after, .tooltipevent div:last-child::before{
    width:0;
    height:0;
    border:solid 5px transparent;/*
    box-shadow: 1px 1px 2px 0px #888888;*/
    border-bottom:0;
    border-top-color:whitesmoke;
    position: absolute;
    display: block;
    content: "";
    bottom:-4px;
    left:50%;
    transform:translateX(-50%);
}
.tooltipevent div:last-child::before{
    border-top-color:#888888;
    bottom:-5px;
}
</style>
{{-- <link href="{{asset("assets/admin/libs/fullcalendar/fullcalendar.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css"/> --}}
@endsection
@section("content")
<!-- Required js and css with url -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/rrule@2.6.3/dist/es5/rrule.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/@fullcalendar/rrule@4.3.0/main.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="https://unpkg.com/@fullcalendar/core@4.3.1/main.min.css">
<link rel="stylesheet" type="text/css" href="https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.css">
<link rel="stylesheet" type="text/css" href="https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.css">
<div id='calendar'></div>

@endsection

@section("script")
{{-- <script src="{{asset("assets/admin/libs/moment/min/moment.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/jquery-ui/jquery-ui.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/fullcalendar/fullcalendar.min.js")}}"></script> --}}
{{-- <script src="{{asset("assets/admin/js/pages/calendar.init.js")}}"></script> --}}
<script>
    // const t = new Date().getDate() + (6 - new Date().getDay() - 1) - 7 ;
    // const lastFriday = new Date();
    // lastFriday.setDate(t);
    // console.log(lastFriday);

    <?php 
    $z = date("Y-m-d", strtotime("last Saturday"));
    $z = (date('W', strtotime($z)) == date('W')) ? (strtotime($z)-7*86400+7200) : strtotime($z);
     date("Y-m-d", $z);
    ?>

    document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    
    //NOTE MUST HAVE REFERENCE rrule javascript and plugin 'rrule', not rrPlugin like docs
    //if using scripts, not import/build method
    defaultDate: new Date(),
    plugins: ['interaction', 'dayGrid', 'timeGrid', 'rrule'],
   timeZone: 'UTC',
   defaultView: 'dayGridMonth',
   header: {
     left: 'prev,next today',
     center: 'title',
     right: 'dayGridMonth,timeGridWeek,timeGridDay'
   },
   editable: false,
    // eventClick: function(arg) {
    //     console.log(arg);
    // //   location.href = "/task/"
    // },
    eventMouseEnter: function(info) {
            var tis=info.el;
            var popup=info.event.extendedProps.popup;
            var tooltip = '<div class="tooltipevent" style="top:'+($(tis).offset().top-5)+'px;left:'+($(tis).offset().left+($(tis).width())/2)+'px"><div>' + popup.title + '</div><div>' + popup.description + '</div></div>';
            var $tooltip = $(tooltip).appendTo('body');
        },
        eventMouseLeave: function(info) {           
            $(info.el).css('z-index', 8);
            $('.tooltipevent').remove();
        },
    events: [    
        @foreach($tasks as $task)
        { 
            id:"{{$task->id}}",
            title: '{{$task->title}}',
            url: '/task/{{$task->id}}',
            popup: {
                title: '{{$task->state}}',
                description: '{{$task->description}}',
            }, 
            backgroundColor: '#c1391c',
            rrule: {        
                dtstart: '{{date("Y-m-d H:i:s", strtotime("$task->date $task->time"))}}',
                until: '2053-08-01T19:30:00',  
            },          
        },  
        @endforeach  
        @foreach($times as $timee)
        {     
        title: '{{$timee->facility->name}}',
        // popup: {
        //     title: '{{$timee->facility->name}}',
        //     description: 'This is Daily the description',
        // },         
        backgroundColor: '#1cc1ab',
        rrule: {        
            freq: 'weekly',
            byweekday: [ 'mo'],
            // dtstart: `{{date('Y-m-d H:i:s', strtotime("date('Y-m-d', $z) $timee->time"))}}`,
            // until: `{{date('Y-m-d H:i:s', strtotime("date('Y-m-d', strtotime('next friday')) $timee->time"))}}`,
            },          
        },   
        @endforeach   
          
    ]
   
  });
  
  
  calendar.render();
});
</script>

@endsection
