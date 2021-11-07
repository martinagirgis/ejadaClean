@extends("layouts.employee")
@section("pageTitle", "Koala Web Libraries")
@section('styleChart')
<link href="{{asset("assets/admin/libs/fullcalendar/fullcalendar.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
@endsection
@section("content")
<!-- Required js and css with url -->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id='calendar'></div>

                    <div style='clear:both'></div>
                </div>
                 <td class="m-2"><i class="mdi mdi-checkbox-blank-circle m-3" style="color:#67a8e4"> مهمات فورية </i> </td>
                 <td class="m-2"><i class="mdi mdi-checkbox-blank-circle m-3" style="color:red"> مهمات دورية</i>
                 </td>
            </div>
        </div>
    </div>

</div>
@endsection

@section("script")
<script src="{{asset("assets/admin/libs/moment/min/moment.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/jquery-ui/jquery-ui.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/fullcalendar/fullcalendar.min.js")}}"></script>
{{-- <script src="{{asset("assets/admin/js/pages/calendar.init.js")}}"></script> --}}
<script>
 !function(i){
    "use strict";
    function e(){

    }
    e.prototype.init=function(){
        if(i.isFunction(i.fn.fullCalendar)){
            i("#external-events .fc-event").each(
                function(){
                    var e={
                        title:i.trim(i(this).text())};
                        i(this).data("eventObject",e),
                        i(this).draggable({zIndex:999,revert:!0,revertDuration:0})});
                        var e=new Date,t=e.getDate(),a=e.getMonth(),n=e.getFullYear();
                        i("#calendar").fullCalendar({
                            header:{
                                left:"prev,next today",
                                center:"title",
                                right:"month,basicWeek,basicDay"
                            },
                            editable:!0,
                            eventLimit:!0,
                            droppable:!0,
                            drop:function(e,t){
                                var a=i(this).data("eventObject"),
                                n=i.extend({},a);
                                n.start=e,
                                n.allDay=t,
                                i("#calendar").fullCalendar("renderEvent",n,!0),
                                i("#drop-remove").is(":checked")&&i(this).remove()
                            },
                            events:[
                            @foreach($tasks as $task)    
                            {
                                title:"{{$task->title}}",
                                start:new Date("{{$task->date}},{{$task->time}}"),
                                url:"/taskShow/{{$task->id}}"
                            },
                            @endforeach

                            @foreach($periodicTasks as $periodicTask)    
                            {
                                title:"{{$periodicTask->title}}",
                                start:new Date("{{$periodicTask->date}},{{$periodicTask->time}}"),
                                url:"/periodicTaskShow/{{$periodicTask->id}}",
                                color: "red",
                            },
                            @endforeach
                            
                            // {
                            //     title:"Lunch",
                            //     start:new Date(n,a,t,12,0),
                            //     end:new Date(n,a,t,14,0),
                            //     allDay:!1
                            // },
                            
                            ]}),
                            i("#add_event_form").on("submit",
                            function(e){
                                e.preventDefault();
                                var t=i(this).find(".new-event-form"),
                                a=t.val();
                                if(3<=a.length){
                                    var n="new"+Math.random().toString(36).substring(7);
                                    i("#external-events").append('<div id="'+n+'" class="fc-event">'+a+"</div>");
                                    var r={title:i.trim(i("#"+n).text())};
                                    i("#"+n).data("eventObject",r),i("#"+n).draggable({revert:!0,revertDuration:0,zIndex:999}),
                                    t.val("").focus()
                                }else t.focus()
                            })}
                            else alert("Calendar plugin is not installed")
    },
    i.CalendarPage=new e,i.CalendarPage.Constructor=e}(window.jQuery),
    function(){"use strict";window.jQuery.CalendarPage.init()
}();
</script>

@endsection
