@extends("layouts.admin")
@section("pageTitle", "Koala Web Libraries")
@section('styleChart')
<link href="{{asset("assets/admin/libs/c3/c3.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
@endsection
@section("content")
<div class="row ">
    <div class="col-md-6 col-xl-3">
       <div class="card">
           <div class="card-body">
            <div class="mini-stat">
                <span class="mini-stat-icon bg-primary float-left"><i class="fas fa-user-graduate"></i></span>
                <div class="mini-stat-info text-right">
                    <span class="counter text-primary">100</span>
                    Total Students
                </div>
            </div>
           </div>
       </div>
    </div>
    <div class="col-md-6 col-xl-3">
       <div class="card">
           <div class="card-body">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon bg-success float-left"><i class="fas fa-user-edit"></i></span>
                <div class="mini-stat-info text-right">
                    <span class="counter text-success">200</span>
                    Total Instructors
                </div>
                <div class="clearfix"></div>
            </div>
           </div>
       </div>
    </div>
    <div class="col-md-6 col-xl-3">
       <div class="card">
           <div class="card-body">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon bg-warning float-left"><i class="fas fa-lightbulb"></i></span>
                <div class="mini-stat-info text-right">
                    <span class="counter text-warning">30</span>
                    Total Courses
                </div>
                <div class="clearfix"></div>
            </div>
           </div>
       </div>
    </div>
    <div class="col-md-6 col-xl-3">
       <div class="card">
           <div class="card-body">
            <div class="mini-stat clearfix">
                <span class="mini-stat-icon bg-pink float-left"><i class="mdi mdi-currency-usd"></i></span>
                <div class="mini-stat-info text-right">
                    <span class="counter text-pink">20000</span>
                    Total Paymentt
                </div>
                <div class="clearfix"></div>
            </div>
           </div>
       </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">Bayment Meathod for eavry Course</h4>

                <div id="chart" dir="ltr"></div>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">Attendance for eavry Course</h4>

                <div id="chart1" dir="ltr"></div>
            </div>
        </div>
    </div> <!-- end col -->
    
</div> <!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">Payment Meathods</h4>

                <div id="donut-chart" dir="ltr"></div>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">Attendance</h4>

                <div id="pie-chart" dir="ltr"></div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection

@section("script")
<script src="{{asset("assets/admin/libs/d3/d3.min.js")}}"></script>
<script src="{{asset("assets/admin/libs/c3/c3.min.js")}}"></script>
{{-- <script src="{{asset("assets/admin/js/pages/c3-chart.init.js")}}"></script> --}}
{{-- <script>
    var yarab = [];
    var ii = 0;
    @foreach( $courses as $course)
     yarab[ii] = "{{$course['name']}}" ;
     ii++;
    @endforeach
    console.log(yarab);
    !function(e){"use strict";
function a(){}

a.prototype.init=function()
{
    c3.generate({bindto:"#chart",
    data:{
        columns:[["Online Payment"{{$xx}}],["Trasfear Bank"{{$yy}}],["By Hand"{{$zz}}]],
        type:"bar",
        colors:{Desktop:"#5468da",Mobile:"#fb8c00",Tablet:"#3bc3e9"}},
    
    tooltip: {
      contents: function (d, defaultTitleFormat, defaultValueFormat, color) {
          var $$ = this, config = $$.config,
              titleFormat = config.tooltip_format_title || defaultTitleFormat,
              nameFormat = config.tooltip_format_name || function (name) { return name; },
              valueFormat = config.tooltip_format_value || defaultValueFormat,
              text, i, title, value, name, bgcolor;
          for (i = 0; i < d.length; i++) {
              var y =0;
              if (! (d[i] && (d[i].value || d[i].value === 0))) { continue; }

              if (! text) {
                  title = titleFormat ? titleFormat(d[i].x) : d[i].x;
                  var list = document.getElementsByClassName("c3-axis")[0];
                        list.getElementsByTagName("tspan")[title].innerHTML = yarab[title];   
                  text = "<table class='" + $$.CLASS.tooltip + "'>" + (title || title === 0 ? "<tr><th colspan='2'>"  + yarab[title] + "</th></tr>" : "");
              }

              name = nameFormat(d[i].name);
              value = valueFormat(d[i].value, d[i].ratio, d[i].id, d[i].index);
              bgcolor = $$.levelColor ? $$.levelColor(d[i].value) : color(d[i].id);

              text += "<tr class='" + $$.CLASS.tooltipName + "-" + d[i].id + "'>";
              text += "<td class='name'><span style='background-color:" + bgcolor + "'></span>" + name + "</td>";
              text += "<td class='value'>" + value + "</td>";
              text += "</tr>";
              y++;
          }
          return text + "</table>";
    }}}),
    c3.generate({bindto:"#chart1",
    data:{
        columns:[["Attend"{{$aa}}],["Asbect"{{$bb}}]],
        type:"bar",
        colors:{Desktop:"#5468da",Mobile:"#fb8c00"}},
    
    tooltip: {
      contents: function (d, defaultTitleFormat, defaultValueFormat, color) {
          var $$ = this, config = $$.config,
              titleFormat = config.tooltip_format_title || defaultTitleFormat,
              nameFormat = config.tooltip_format_name || function (name) { return name; },
              valueFormat = config.tooltip_format_value || defaultValueFormat,
              text, i, title, value, name, bgcolor;
          for (i = 0; i < d.length; i++) {
              var y =0;
              if (! (d[i] && (d[i].value || d[i].value === 0))) { continue; }

              if (! text) {
                  title = titleFormat ? titleFormat(d[i].x) : d[i].x;
                  var list = document.getElementsByClassName("c3-axis")[0];
                        list.getElementsByTagName("tspan")[title].innerHTML = yarab[title];   
                  text = "<table class='" + $$.CLASS.tooltip + "'>" + (title || title === 0 ? "<tr><th colspan='2'>"  + yarab[title] + "</th></tr>" : "");
              }

              name = nameFormat(d[i].name);
              value = valueFormat(d[i].value, d[i].ratio, d[i].id, d[i].index);
              bgcolor = $$.levelColor ? $$.levelColor(d[i].value) : color(d[i].id);

              text += "<tr class='" + $$.CLASS.tooltipName + "-" + d[i].id + "'>";
              text += "<td class='name'><span style='background-color:" + bgcolor + "'></span>" + name + "</td>";
              text += "<td class='value'>" + value + "</td>";
              text += "</tr>";
              y++;
          }
          return text + "</table>";
    }}}),
    c3.generate({bindto:"#donut-chart",data:{columns:[["Online Payment",{{$sumOnline}}],["Trasfear Bank",{{$sumBank}}],["By Hand",{{$sumHand}}]],type:"donut"},donut:{title:"Candidates",width:30,label:{show:!1}},color:{pattern:["#f06292","#6d60b0","#5468da","#009688"]}}),
    c3.generate({bindto:"#pie-chart",data:{columns:[["Attend",{{$sumAttend}}],["Absent",{{$sumAbsent}}]],type:"pie"},color:{pattern:["#afb42b","#fb8c00","#8d6e63","#90a4ae"]},pie:{label:{show:!1}}})},
    e.ChartC3=new a,e.ChartC3.Constructor=a
}
(window.jQuery),
    function(){"use strict";window.jQuery.ChartC3.init()}();





    
//     var list = document.getElementsByClassName("c3-axis")[0];
// list.getElementsByTagName("tspan")[0].innerHTML = "Milk";
</script> --}}
@endsection