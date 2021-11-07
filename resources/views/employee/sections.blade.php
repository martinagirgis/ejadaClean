<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">لوحة التحكم</li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon1.png")}}" style="width: 25px; height: 25px;">
                <span>   الشكاوي  </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("complaints.index")}}">عرض الكل</a></li>
                <li><a href="{{route("complaints.create")}}">اضافة شكوى جديد</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon3.png")}}" style="width: 25px; height: 25px;">
                <span> المهام الفورية </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("taskNow")}}">المهام الحالية</a></li>
                <li><a href="{{route("taskWaiting")}}">المهام قيد الانتظار</a></li>
                <li><a href="{{route("tasksDone")}}">المهام المنتهية</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon2.png")}}" style="width: 25px; height: 25px;">
                <span> المهام الدورية </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("periodicTask.Now")}}">المهام الحالية</a></li>
                <li><a href="{{route("periodicTask.Waiting")}}">المهام قيد الانتظار</a></li>
                <li><a href="{{route("periodicTask.Done")}}">المهام المنتهية</a></li>
            </ul>
        </li>

    </ul>
</div>
<!-- Sidebar -->
