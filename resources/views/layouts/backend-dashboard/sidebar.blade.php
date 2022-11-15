<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/admin-page/admin-lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Page</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin-page/admin-lte/dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Samsudin</a>
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
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">Data Tables</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Master
                            <i class="fas fa-angle-left right"></i>
                            {{-- <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>
                    <ul class="nav nav-treeview ms-5">
                        <li class="nav-item ">
                            <a href="/data/kecamatan" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Kecamatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data/kelurahan" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Kelurahan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Jalan
                            <i class="fas fa-angle-left right"></i>
                            {{-- <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>
                    <ul class="nav nav-treeview ms-5">
                        <li class="nav-item ">
                            <a href="/ruas/kelurahan" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Kelurahan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/ruas/desa" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Desa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Pemeliharaan
                            <i class="fas fa-angle-left right"></i>
                            {{-- <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>
                    <ul class="nav nav-treeview ms-5">
                        <li class="nav-item ">
                            <a href="/data/pemeliharaan" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Pemeliharaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data/penyediajasa" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Penyedia Jasa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Administrator</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users-cog nav-icon "></i>
                        <p>
                            Administrator
                            <i class="fas fa-angle-left right"></i>
                            {{-- <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>
                    <ul class="nav nav-treeview ms-5">
                        <li class="nav-item ">
                            <a href="/data/user" class="nav-link">
                                <i class="far fa-user nav-icon ml-3"></i>
                                <p>User List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-cog nav-icon ml-3"></i>
                                <p>Setting</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">KDR With Love</li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
