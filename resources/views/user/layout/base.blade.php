<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin :: @yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/fontawesome-all.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="">
    <div id="hamburger" class="navigation-menu">
        <svg width="20px" height="20px" viewBox="0 0 69 51" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill-rule="evenodd">
                <g fill-rule="nonzero" stroke="none">
                    <g>
                        <rect x="0" y="0" width="69" height="6.2072333" rx="3.10361665"></rect> <rect x="0" y="22" width="69" height="6.2072333" rx="3.10361665"></rect> <rect x="0" y="44.7927667" width="69" height="6.2072333" rx="3.10361665"></rect>
                    </g>
                </g>
            </g>
        </svg>
    </div>
    <nav class="nav nav-sidebar">
        <div class="nav_section">
            <div class="nav_section_content company">
                <div class="nav_item prelative">
                    <a href="" class="nav_flex">
                            <span class="company-icon d-flex justify-content-center">
                             <i class="fas fa-fw fa-shield-alt align-self-center"></i>
                            </span>
                        <span class="company_text font-weight-bold">Noble</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="nav_section">
            <div class="nav_section_content">
                <div class="nav_item prelative">
                    <a href="" class="nav_link nav_flex">
                           <span class="nav_link_icon">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                           </span>
                        <span class="nav_link_text">Dashboard</span>
                    </a>
                </div>
                <div class="nav_item prelative">
                    <a href="" class="nav_link nav_flex">
                            <span class="nav_link_icon">
                             <i class="fas fa-fw fa-user"></i>
                            </span>
                        <span class="nav_link_text">Profile</span>
                    </a>
                </div>
                <div class="nav_item prelative">
                    <a href="" class="nav_link nav_flex">
                        <span class="nav_link_icon">
                         <i class="fas fa-fw fa-users"></i>
                        </span>
                        <span class="nav_link_text">Customers</span>
                    </a>
                </div>
                <div class="nav_item prelative">
                    <a href="" class="nav_link nav_flex">
                            <span class="nav_link_icon">
                             <i class="fas fa-fw fa-money-bill-alt"></i>
                            </span>
                        <span class="nav_link_text">Payments</span>
                    </a>
                </div>
                <div class="nav_item prelative">
                    <a href="" class="nav_link nav_flex">
                         <span class="nav_link_icon">
                          <i class="fas fa-fw fa-ticket-alt"></i>
                         </span>
                        <span class="nav_link_text">Tickets</span>
                    </a>

                </div>
                <div class="nav_item prelative">
                    <a href="" class="nav_link nav_flex">
                            <span class="nav_link_icon">
                             <i class="fas fa-fw fa-envelope"></i>
                            </span>
                        <span class="nav_link_text">Messages</span>
                    </a>
                </div>
                <div class="nav_item prelative">
                    <a href="" class="nav_link nav_flex">
                            <span class="nav_link_icon">
                             <i class="fas fa-fw fa-cogs"></i>
                            </span>
                        <span class="nav_link_text">Settings</span>
                    </a>
                </div>
                <div class="nav_item prelative">
                    <a href="" class="nav_link nav_flex">
                         <span class="nav_link_icon">
                          <i class="fas fa-fw fa-sign-out-alt"></i>
                         </span>
                        <span class="nav_link_text">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>
<header class="d-flex">
    <div class="header-page-title mr-auto">
        <div class="icon-block blue-bg">
            <i class="fas fa-fw fa-tachometer-alt"></i>
        </div>
        <span class="header-page-title-text">Dashboard</span>
    </div>

    <div class="header-nav">
            <span class="header-nav-item">
                <img class="avatar rounded-circle img-thumbnail img-fluid" src="img/avatar-1.jpg" alt="profile pics">
            </span>
        <div class="nav-dropdown">
            <div class="nav-dropdown-item">
                <div class="nav-dropdown-item-link">
                    Profile
                </div>
            </div>
            <div class="nav-dropdown-item">
                <div class="nav-dropdown-item-link">
                    Settings
                </div>
            </div>
            <div class="nav-dropdown-item">
                <div class="nav-dropdown-item-link">
                    Logout
                </div>
            </div>
        </div>
    </div>
</header>
<main class="main" id="main">
    <div class="main_container">
    @yield('content')
    </div>
</main>

<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>