<div class="sidebar">
                <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="/profile" class="d-block">{{ auth()->user()->name }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="/" class="nav-link">
                    <i class="nav-icon fa-solid fa-gauge-high"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/product" class="nav-link">
                    <i class="nav-icon fa-solid fa-box"></i>
                    <p>
                        Product
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a class="log-out ml-3" href="#" class="nav-link">
                    <i class="nav-icon fa-solid fa-power-off" style="color: red;"></i>
                    Logout
                    <form action="/logout" method="POST" id="logging-out">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>