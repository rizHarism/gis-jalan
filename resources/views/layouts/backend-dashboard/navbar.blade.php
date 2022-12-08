<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Peta &nbsp<i class="fa fa-globe-asia"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        {{-- navbar admin --}}
        <li class="nav-item dropdown user-menu">

            {{-- User menu toggler --}}
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                @php $avatar = Auth::user()->avatar @endphp
                <img src="{{ asset("assets/image/avatar/$avatar") }}"
                    class="user-image img-circle img-thumbnail elevation-2" alt="ADMIN">
                <span class="d-none d-md-inline">
                    {{ Auth::user()->name }}
                </span>
            </a>

            {{-- User menu dropdown --}}
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                {{-- User menu header --}}

                <li class="user-header h-auto">
                    <img src="{{ asset("assets/image/avatar/$avatar") }}" class="img-circle img-thumbnail elevation-2"
                        alt="ADMIN">

                    <p class=" mt-0"> {{ Auth::user()->username }} <small>{{ Auth::user()->name }}</small>
                    </p>
                </li>


                {{-- User menu body --}}
                {{-- @hasSection('usermenu_body') --}}
                {{-- <li class="user-body">
                    SASA
                </li> --}}
                {{-- @endif --}}

                {{-- User menu footer --}}
                <li class="user-footer">
                    <a href="#" class="btn btn-default btn-flat float-right btn-block">
                        <i class="fa fa-fw fa-user text-lightblue"></i>
                        Profile
                    </a>
                    <a class="btn btn-default btn-flat float-right btn-block" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-power-off text-red"></i>
                        Keluar
                    </a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        {{-- @if (config('adminlte.logout_method'))
                            {{ method_field(config('adminlte.logout_method')) }}
                        @endif --}}
                        {{ csrf_field() }}
                    </form>
                </li>

            </ul>

        </li>
    </ul>
</nav>
<!-- /.navbar -->
