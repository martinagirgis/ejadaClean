<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">لوحة التحكم</li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span>   الشكاوي  </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("complaints.index")}}">عرض الكل</a></li>
                <li><a href="{{route("complaints.create")}}">اضافة شكوى جديد</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span>   المهام  </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("taskNow",['id'=>1])}}">المهام الحالية</a></li>
                <li><a href="{{route("taskWaiting",['id'=>1])}}">المهام قيد الانتظار</a></li>
                <li><a href="{{route("tasDone",['id'=>1])}}">المهام المنتهية</a></li>
            </ul>
        </li>

    </ul>
</div>
<!-- Sidebar -->
