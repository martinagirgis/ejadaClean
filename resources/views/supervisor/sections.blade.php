<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">لوحة التحكم</li>
       
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span> العمال </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("supervisorEmployees.index")}}">عرض الكل</a></li>
                <li><a href="{{route("supervisorEmployees.create")}}">اضافة عامل جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span> الشكاوي </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("supervisor.taskNow",['id'=>1])}}">الشكاوي الجديدة</a></li>
                <li><a href="{{route("supervisor.taskAll",['id'=>1])}}">كل الشكاوي</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span> المهام </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("supervisor.taskNow",['id'=>1])}}">المهام الجديدة</a></li>
                <li><a href="{{route("supervisor.taskAll",['id'=>1])}}">كل المهام</a></li>
            </ul>
        </li>

    </ul>
</div>
<!-- Sidebar -->
