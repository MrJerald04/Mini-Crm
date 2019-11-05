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
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    @if ($countOfNotif != 0)
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-danger navbar-badge">{{$countOfNotif}}</span>
                        </a>
                    @endif

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @foreach ($notif as $ntf)
                            <a href="{!! route('employee_notif.data',['id' => $ntf->new_employee_id, 'ntfID' => $ntf->id]) !!}" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            @foreach ($new_employee_list as $nel)
                                                @if ($nel->id == $ntf->new_employee_id)
                                                    {{$nel->first_name}} {{$nel->last_name}}
                                                @endif
                                                
                                            @endforeach
                                            
                                        <span class="float-right text-sm text-danger"><i class="fas fa-circle"></i></span>
                                        </h3>
                                        <p class="text-sm">New Employee</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                    </div>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <i class="fas fa-user-circle"></i>&nbsp; Welcome, {{ Auth::guard('employee')->user()->first_name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/employee/profile"><i class="fas fa-user"></i>&nbsp; Profile</a>
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
    <!-- /.content -->
