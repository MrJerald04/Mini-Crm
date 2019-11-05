<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light navbar-default">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>    
    </ul>
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <i class="fas fa-user-circle"></i>&nbsp; Welcome, {{ Auth::guard('user')->user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fas fa-chevron-circle-left"></i>&nbsp; Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
        </ul>
        </ul>
    </div>
    </nav>
    <!-- /.navbar -->