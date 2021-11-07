<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">لوحة التحكم</li>
       
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon4.png")}}" style="width: 25px; height: 25px;">
                <span> العمال </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("supervisorEmployees.index")}}">عرض الكل</a></li>
                <li><a href="{{route("supervisorEmployees.create")}}">اضافة عامل جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon1.png")}}" style="width: 25px; height: 25px;">
                <span> الشكاوي </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("supervisor.ComplaintNow")}}">الشكاوي الجديدة</a></li>
                <li><a href="{{route("supervisor.ComplaintAll")}}">كل الشكاوي</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon3.png")}}" style="width: 25px; height: 25px;">
                <span> المهام الفورية للعمال </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("supervisor.task.new")}}">المهام الجديدة</a></li>
                <li><a href="{{route("supervisor.task.denay")}}">المهام طلبات زيادة وقت</a></li>
                <li><a href="{{route("supervisor.task.waiting")}}">المهام قيد الانتظار من المدير</a></li>
                <li><a href="{{route("supervisor.task.waitingEmp")}}">المهام قيد الانتظار من العمال</a></li>
                <li><a href="{{route("supervisor.task.index")}}">كل المهام</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon2.png")}}" style="width: 25px; height: 25px;">
                <span> المهام الدورية للعمال </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("supervisor.PeriodicTasks.new")}}">المهام الجديدة</a></li>
                <li><a href="{{route("supervisor.PeriodicTasks.denay")}}">المهام طلبات زيادة وقت</a></li>
                <li><a href="{{route("supervisor.PeriodicTasks.waiting")}}">المهام قيد الانتظار من المدير</a></li>
                <li><a href="{{route("supervisor.PeriodicTasks.waitingEmp")}}">المهام قيد الانتظار من العمال</a></li>
                <li><a href="{{route("supervisor.PeriodicTasks.index")}}">كل المهام</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon5.png")}}" style="width: 25px; height: 25px;">
                <span> المهام للفرق </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("supervisor.task.NowTeam")}}"> المهمات الحالية</a></li>
                <li><a href="{{route("supervisor.task.WaitingTeam")}}">المهام قيد الانتظار</a></li>
                <li><a href="{{route("supervisor.task.DoneTeam")}}"> المهام المنتهية</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon6.png")}}" style="width: 25px; height: 25px;">
                <span> المهام للشركات الراعية </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("supervisor.task.NowCompany")}}"> المهمات الحالية</a></li>
                <li><a href="{{route("supervisor.task.WaitingCompany")}}">المهام قيد الانتظار</a></li>
                <li><a href="{{route("supervisor.task.DoneCompany")}}"> المهام المنتهية</a></li>
            </ul>
        </li>

    </ul>
</div>
<!-- Sidebar -->
