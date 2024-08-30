<div class="logo bg-dark p-0">
    <a href="http://www.creative-tim.com" class="text-primary">
        <img width="150" height="100" src="../assets/img/logo.png" alt="">
    </a>
</div>
<div class="sidebar-wrapper bg-dark">
    <ul class="nav">
        <!-- Dashboard -->
        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ URL('dashboard') }}">
                <i class="now-ui-icons design_app"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <!-- Request Leave -->
        <li class="{{ request()->is('request-leave') ? 'active' : '' }}">
            <a href="{{ URL('request-leave') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p>Request Leave</p>
            </a>
        </li>

        <!-- View Leave Balance -->
        <li class="{{ request()->is('leave-balance') ? 'active' : '' }}">
            <a href="{{ URL('leave-balance') }}">
                <i class="now-ui-icons business_money-coins"></i>
                <p>Leave Balance</p>
            </a>
        </li>

        <!-- Track Leave Requests -->
        <li class="{{ request()->is('track-leave') ? 'active' : '' }}">
            <a href="{{ URL('track-leave') }}">
                <i class="now-ui-icons ui-1_bell-53"></i>
                <p>Track Leave Requests</p>
            </a>
        </li>

        <!-- Team Leave Calendar (Manager Menu) -->
        <li class="{{ request()->is('team-leave-calendar') ? 'active' : '' }}">
            <a href="{{ URL('team-leave-calendar') }}">
                <i class="now-ui-icons location_map-big"></i>
                <p>Team Leave Calendar</p>
            </a>
        </li>

        <!-- Reports -->
        <li class="{{ request()->is('reports') ? 'active' : '' }}">
            <a href="{{ URL('reports') }}">
                <i class="now-ui-icons business_chart-bar-32"></i>
                <p>Reports</p>
            </a>
        </li>

        <!-- Manage Employees (Admin Menu) -->
        <li class="{{ request()->is('manage-employees') ? 'active' : '' }}">
            <a href="{{ URL('manage-employees') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p>Manage Employees</p>
            </a>
        </li>

        <!-- Roles (Admin Menu) -->
        <li class="{{ request()->is('roles') ? 'active' : '' }}">
            <a href="{{ URL('roles') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p>Roles</p>
            </a>
        </li>

        <!-- Permissions (Admin Menu) -->
        <li class="{{ request()->is('permissions') ? 'active' : '' }}">
            <a href="{{ URL('permissions') }}">
                <i class="now-ui-icons ui-1_settings-gear-63"></i>
                <p>Permissions</p>
            </a>
        </li>

        <!-- Settings -->
        <li class="{{ request()->is('settings') ? 'active' : '' }}">
            <a href="{{ URL('settings') }}">
                <i class="now-ui-icons ui-1_settings-gear-63"></i>
                <p>Users</p>
            </a>
        </li>
        
    </ul>
</div>

<style>
/* Sidebar Menu Font Styling */
.sidebar-wrapper {
    font-family: 'Roboto', sans-serif;
    font-size: 20px;
}

.sidebar-wrapper .nav p {
    font-family: 'Roboto', sans-serif;
}

/* Optional: Style for links and icons */
.sidebar-wrapper .nav a {
    font-family: 'Roboto', sans-serif;
    color: #fff;
    /* Ensure text is visible on dark background */
}

/* Style for active menu item */
.sidebar-wrapper .nav li.active a {
    background-color: white; /* Example background color for active item */
}
</style>


<style>
/* Sidebar Menu Font Styling */
.sidebar-wrapper {
    font-family: 'Roboto', sans-serif;
    font-size: 20px;
}

.sidebar-wrapper .nav p {
    font-family: 'Roboto', sans-serif;
}

/* Optional: Style for links and icons */
.sidebar-wrapper .nav a {
    font-family: 'Roboto', sans-serif;
    color: #fff;
    /* Ensure text is visible on dark background */
}
</style>