<nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler" href="#">
        <span class="navbar-toggler-icon"></span>
    </a>
    <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle nav-link-lg nav-link-user" id="navbarDarkDropdownMenuLink"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar mr-1">
                        <img src={{ image_format(Auth::user()->profile_pic ?? '') }} class="img-fluid shadow">
                    </div>
                    <div class="d-none d-md-block d-lg-inline-block">
                        Hi, {{ Auth::user()->first_name }}
                    </div>
                </a>
                <div class="dropdown-menu pr-5" aria-labelledby="navbarDarkDropdownMenuLink">
                    <a class="dropdown-item" href={{ route('logout') }}>
                        <i data-feather="log-out"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
