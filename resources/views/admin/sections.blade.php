<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">لوحة التحكم</li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-school"></i>
                <span> الشركات </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route("companies.index")}}">عرض الكل</a></li>
                <li><a href="{{route("companies.create")}}">اضافة شركة جديد</a></li>
            </ul>
        </li>

    </ul>
</div>
<!-- Sidebar -->
