<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
        <img src="{!! asset('/bower_components/admin-lte/dist/img/AdminLTELogo.png') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Mini-CRM') }}</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
    
        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            
            <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                </p>
            </a>
            </li>
            <li class="nav-item">
            <a href="/admin/companies" class="nav-link  {{ (request()->is('admin/companies')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-city"></i>
                <p>
                Companies
                </p>
            </a>
            </li>
            <li class="nav-item">
                <a href="/admin/employees" class="nav-link  {{ (request()->is('admin/employees')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                    Employees
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/send_mail" class="nav-link  {{ (request()->is('admin/send_mail')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>
                    Send Email
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/map" class="nav-link  {{ (request()->is('admin/map')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-map"></i>
                    <p>
                    Map
                    </p>
                </a>
            </li>
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>