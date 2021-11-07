<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">لوحة التحكم</li>


        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon9.png")}}" style="width: 25px; height: 25px;">
                <span>المرافق </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("facilities.index")}}">عرض الكل</a></li>
                <li><a href="{{route("facilities.create")}}">اضافة مرفق جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                 <img src="{{asset("assets/admin/images/emp/icon6.png")}}" style="width: 25px; height: 25px;">
                <span>الشركات الراعية </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("sponsoringCompanies.index")}}">عرض الكل</a></li>
                <li><a href="{{route("sponsoringCompanies.create")}}">اضافة شركة راعية جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                 <img src="{{asset("assets/admin/images/emp/icon5.png")}}" style="width: 25px; height: 25px;">
                <span> الفريق الخاص  </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("teams.index")}}">عرض الكل</a></li>
                <li><a href="{{route("teams.create")}}">اضافة فريق جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon11.png")}}" style="width: 25px; height: 25px;">
                <span> المشرفين </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("supervisors.index")}}">عرض الكل</a></li>
                <li><a href="{{route("supervisors.create")}}">اضافة مشرف جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <img src="{{asset("assets/admin/images/emp/icon4.png")}}" style="width: 25px; height: 25px;">
                <span> العمال </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("employees.index")}}">عرض الكل</a></li>
                <li><a href="{{route("employees.create")}}">اضافة عامل جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                 <img src="{{asset("assets/admin/images/emp/icon1.png")}}" style="width: 25px; height: 25px;">
                <span> الشكاوي </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("managerClean.ComplaintNow")}}">الشكاوي الجديدة</a></li>
                <li><a href="{{route("managerClean.ComplaintAll")}}">كل الشكاوي</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                 <img src="{{asset("assets/admin/images/emp/icon3.png")}}" style="width: 25px; height: 25px;">
                <span> المهات الفورية </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("managerClean.createTask")}}">اضافة مهمة جديدة</a></li>
                <li><a href="{{route("managerClean.taskNow")}}">المهمات الجديدة</a></li>
                <li><a href="{{route("managerClean.tasksAll")}}">كل المهمات</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                 <img src="{{asset("assets/admin/images/emp/icon2.png")}}" style="width: 25px; height: 25px;">
                <span> المهات الدورية </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("confirm.periodic.task", ['id' => date('Y-m-d', strtotime('+1 day', strtotime(now())))])}}">اضافة المهمات الجديدة</a></li>
                <li><a href="{{route("managerClean.PeriodicTasks.Now")}}">المهمات الجديدة</a></li>
                <li><a href="{{route("managerClean.PeriodicTasks.All")}}">كل المهمات</a></li>
            </ul>
        </li>


    </ul>
</div>
<!-- Sidebar -->
