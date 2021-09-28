<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">لوحة التحكم</li>


        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span>المرافق </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("facilities.index")}}">عرض الكل</a></li>
                <li><a href="{{route("facilities.create")}}">اضافة مرفق جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span>الشركات الراعية </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("sponsoringCompanies.index")}}">عرض الكل</a></li>
                <li><a href="{{route("sponsoringCompanies.create")}}">اضافة شركة راعية جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span> الفريق الخاص  </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("teams.index")}}">عرض الكل</a></li>
                <li><a href="{{route("teams.create")}}">اضافة فريق جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span> المشرفين </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("supervisors.index")}}">عرض الكل</a></li>
                <li><a href="{{route("supervisors.create")}}">اضافة مشرف جديد</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-exclamation-triangle"></i>
                <span> العمال </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("employees.index")}}">عرض الكل</a></li>
                <li><a href="{{route("employees.create")}}">اضافة عامل جديد</a></li>
            </ul>
        </li>


    </ul>
</div>
<!-- Sidebar -->
