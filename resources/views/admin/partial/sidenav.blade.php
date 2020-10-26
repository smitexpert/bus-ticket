<!-- Page Sidebar -->
<div class="page-sidebar">
    <a class="logo-box" href="{{ route('admin.dashboard') }}">
        <span>Jatra</span>
        <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
        <i class="icon-close" id="sidebar-toggle-button-close"></i>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="@if(Request::route()->getName() == 'admin.dashboard') active-page @endif">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'admin.ticket.index') active-page @endif">
                    <a href="{{ route('admin.ticket.index') }}">
                        <i class="menu-icon fa fa-wpforms"></i><span>Purchase History</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'admin.location') active-page @endif">
                    <a href="{{ route('admin.location') }}">
                        <i class="menu-icon fa fa-map-marker"></i><span>Districts</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-bus"></i><span>Bus Organization</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="sub-menu">
                        <li><a class="@if(Request::route()->getName() == 'admin.bus.organization') active @endif" href="{{ route('admin.bus.organization') }}">Organizations</a></li>
                        <li><a class="@if(Request::route()->getName() == 'admin.bus.agent') active @endif" href="{{ route('admin.bus.agent') }}">Agents</a></li>
                        <li><a class="@if(Request::route()->getName() == 'admin.bus.counter') active @endif" href="{{ route('admin.bus.counter') }}">Counter</a></li>
                        <li><a class="@if(Request::route()->getName() == 'admin.bus.seatplan') active @endif" href="{{ route('admin.bus.seatplan') }}">Seat Plan</a></li>
                        <li><a class="@if(Request::route()->getName() == 'admin.bus.buses') active @endif" href="{{ route('admin.bus.buses') }}">Buses</a></li>
                        <li><a class="@if(Request::route()->getName() == 'admin.bus.routes') active @endif" href="{{ route('admin.bus.routes') }}">Routes</a></li>
                        <li><a class="@if(Request::route()->getName() == 'admin.bus.schedules') active @endif" href="{{ route('admin.bus.schedules') }}">Schedule</a></li>
                    </ul>
                </li>
                <li class="@if(Request::route()->getName() == 'admin.bus.report.index') active-page @endif">
                    <a href="{{ route('admin.bus.report.index') }}">
                        <i class="menu-icon fa fa-list-alt"></i><span>Reports</span>
                    </a>
                </li>
                {{-- <li class="menu-divider"></li>
                <li>
                    <a href="index.html">
                        <i class="menu-icon icon-help_outline"></i><span>Documentation</span>
                    </a>
                </li>
                <li>
                    <a href="index.html">
                        <i class="menu-icon icon-public"></i><span>Changelog</span><span class="label label-danger">1.0</span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</div><!-- /Page Sidebar -->