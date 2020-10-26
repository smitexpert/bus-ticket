<!-- Page Sidebar -->
<div class="page-sidebar">
    <a class="logo-box" href="{{ route('agent.dashboard') }}">
        <span>Jatra</span>
        <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
        <i class="icon-close" id="sidebar-toggle-button-close"></i>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="@if(Request::route()->getName() == 'agent.dashboard') active-page @endif">
                    <a href="{{ route('agent.dashboard') }}">
                        <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'counter.sell.ticket') active-page @endif">
                    <a href="{{ route('counter.sell.ticket') }}" target="_blank">
                        <i class="menu-icon fa fa-shopping-cart"></i><span>Sell Ticket</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'agent.manifest.index') active-page @endif">
                    <a href="{{ route('agent.manifest.index') }}">
                        <i class="menu-icon fa fa-print"></i><span>Print Manifast</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'agent.ticket.search') active-page @endif">
                    <a href="{{ route('agent.ticket.search') }}">
                        <i class="menu-icon fa fa-ticket"></i><span>Search Ticket</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'agent.ticket.index') active-page @endif">
                    <a href="{{ route('agent.ticket.index') }}">
                        <i class="menu-icon fa fa-wpforms"></i><span>Purchase History</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'agent.manage') active-page @endif">
                    <a href="{{ route('agent.manage') }}">
                        <i class="menu-icon fa fa-users"></i><span>Manage Agents</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'agent.counter.get') active-page @endif">
                    <a href="{{ route('agent.counter.get') }}">
                        <i class="menu-icon fa fa-window-restore"></i><span>Manage Counter</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'agent.buses.get') active-page @endif">
                    <a href="{{ route('agent.buses.get') }}">
                        <i class="menu-icon fa fa-bus"></i><span>Manage Buses</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'agent.routes.get') active-page @endif">
                    <a href="{{ route('agent.routes.get') }}">
                        <i class="menu-icon fa fa-map"></i><span>Manage Routes</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'agent.schedules.get') active-page @endif">
                    <a href="{{ route('agent.schedules.get') }}">
                        <i class="menu-icon fa fa-server"></i><span>Manage Schedules</span>
                    </a>
                </li>
                <li class="@if(Request::route()->getName() == 'agent.reports.index') active-page @endif">
                    <a href="{{ route('agent.reports.index') }}">
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