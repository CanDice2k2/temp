<a href="#dataSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
    <i class="fas fa-database mr-2"></i>
    Dữ liệu
</a>
<ul class="collapse list-unstyled" id="dataSubmenu">
    <li class="nav-item">
        <a href="{{ route('employees-data') }}" class="nav-link">Nhân sự</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('departments-data') }}" class="nav-link">Phòng ban</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('positions-data') }}" class="nav-link">Chức vụ</a>
    </li>
</ul>
