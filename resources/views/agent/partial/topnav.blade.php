<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <div class="logo-sm">
                <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
                <a class="logo-box" href="{{ route('agent.dashboard') }}"><span>Jatra</span></a>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <i class="fa fa-angle-down"></i>
            </button>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
    
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="javascript:void(0)" id="collapsed-sidebar-toggle-button"><i class="fa fa-bars"></i></a></li>
                <li><a href="javascript:void(0)" id="toggle-fullscreen"><i class="fa fa-expand"></i></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                {{-- <li><a href="javascript:void(0)" class="right-sidebar-toggle" data-sidebar-id="main-right-sidebar"><i class="fa fa-envelope"></i></a></li> --}}
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i></a>
                    <ul class="dropdown-menu dropdown-lg dropdown-content">
                        <li class="drop-title">Notifications<a href="#" class="drop-title-link"><i class="fa fa-angle-right"></i></a></li>
                        <li class="slimscroll dropdown-notifications">
                            <ul class="list-unstyled dropdown-oc">
                                <li>
                                    <a href="#"><span class="notification-badge bg-primary"><i class="fa fa-photo"></i></span>
                                        <span class="notification-info">Finished uploading photos to gallery <b>"South Africa"</b>.
                                            <small class="notification-date">20:00</small>
                                        </span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="http://via.placeholder.com/36x36" alt="" class="img-circle"></a>
                    <ul class="dropdown-menu">
                        <li><h4 style="margin: 0 10px; font-weight: 18px; color: #666;">{{ auth('agent')->user()->name }}</h4></li>
                        <li role="separator" class="divider"></li>
                        {{-- <li><a href="{{ route('agent.profile') }}">Account Settings</a></li> --}}
                        <li><a href="{{ route('agent.logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Log Out</a>
                        </li>
                        <form id="logout-form" action="{{ route('agent.logout') }}" method="POST" style="display: none;">@csrf</form>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>