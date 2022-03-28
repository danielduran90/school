<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
    @can('view-user')
        <a class="nav-link" href="/user">
            <i class=" fas fa-users"></i><span>Usuarios</span>
        </a>
    @endcan
    @can('view-rol')
        <a class="nav-link" href="/roles">
            <i class=" fas fa-user-lock"></i><span>Roles</span>
        </a>
    @endcan
    @can('view-subject')
        <a class="nav-link" href="/subject">
            <i class=" fas fa-book"></i><span>Asignaturas</span>
        </a>
    @endcan
    @can('view-scores')
        <a class="nav-link" href="/scores">
            <i class=" fas fa-balance-scale"></i><span>Calificaciones</span>
        </a>
    @endcan
    
</li>
