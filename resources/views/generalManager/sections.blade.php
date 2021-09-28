<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">لوحة التحكم</li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span> مدراء الجودة </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("qualityManagers.index")}}">عرض الكل</a></li>
                <li><a href="{{route("qualityManagers.create")}}">اضافة مدير جودة جديد</a></li>
            </ul>
        </li>

       


        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span> مدير النظافة و الصيانة </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("cleanMaintananceManagers.index")}}">عرض الكل</a></li>
                <li><a href="{{route("cleanMaintananceManagers.create")}}">اضافة مدير نظافة و صيانة جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span>فرع جديد</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("branches.index")}}">عرض الكل</a></li>
                <li><a href="{{route("branches.create")}}">اضافة فرع جديد</a></li>
            </ul>
        </li>
        
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span> المشرفين </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("generalManagerSupervisors.index")}}">عرض الكل</a></li>
                <li><a href="{{route("generalManagerSupervisors.create")}}">اضافة مشرف جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span> العمال </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("generalManagerEmployees.index")}}">عرض الكل</a></li>
                <li><a href="{{route("generalManagerEmployees.create")}}">اضافة عامل جديد</a></li>
            </ul>
        </li>

    </ul>
</div>
<!-- Sidebar -->
