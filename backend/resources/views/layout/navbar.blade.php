<nav class="navbar navbar-expand-sm bg-primary">
    <div class=" navbar-collapse justify-content-end p-2">
        <form>
            <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <span class="input-group-addon">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                </span>
            </div>
        </form>
        <ul class="navbar-nav">
            <!-- Notification Icon with Badge -->
            <li class="nav-item">
                <a class="nav-link" href="{{ URL('notifications') }}">
                    <div class="notification-icon-container">
                        <i class="now-ui-icons ui-1_bell-53 notification-icon"></i>
                        <span class="badge badge-danger">1</span>
                    </div>
                    <p>
                        <span class="d-lg-none d-md-block">Notification</span>
                    </p>
                </a>
            </li>

            <!-- Account Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="now-ui-icons users_single-02 account-icon"></i>
                    <p>
                        <span class="d-lg-none d-md-block">Some Actions</span>
                    </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Account</a>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<style>
/* Notification Icon Container */
.notification-icon-container {
    position: relative;
    display: inline-block;
}

/* Larger Notification Icon */
.notification-icon {
    font-size: 24px; /* Adjust size as needed */
    color: #fff; /* Ensure icon color is visible */
}

/* Badge Styling */
.badge {
    position: absolute;
    top: -5px; /* Adjust as needed */
    right: -15px; /* Adjust as needed */
    padding: 4px 7px;
    border-radius: 50%;
    font-size: 10px; /* Adjust font size of the badge */
}

.badge-danger {
    background-color: #dc3545;
    color: white;
}

/* Larger Account Icon */
.account-icon {
    font-size: 24px; /* Adjust size as needed */
    color: #fff; /* Ensure icon color is visible */
}

/* Optional: Adjustments to ensure the badge looks good on various screen sizes */
@media (max-width: 768px) {
    .notification-icon,
    .account-icon {
        font-size: 20px; /* Smaller icon for mobile view */
    }
    .badge {
        font-size: 10px; /* Smaller badge for mobile view */
        padding: 3px 6px;
    }
}
</style>
