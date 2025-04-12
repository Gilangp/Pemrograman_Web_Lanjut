<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Level Login -->
        <li class="nav-item">
            <a class="nav-link text-bold" href="#">
                Login sebagai: {{ Auth::user()->level->level_nama }}
            </a>
        </li>

        <!-- Profile Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('icon_profile.png') }}" class="img-circle elevation-2" alt="Photo User" width="30" height="30">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                {{-- tampil profil --}}
                <button onclick="modalAction('{{ url('profile') }}')" class="dropdown-item">
                    <i class="fas fa-user-cog mr-2"></i> Lihat Profil
                </button>

                {{-- logout --}}
                <a href="{{ url('logout') }}" class="dropdown-item text-danger">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
