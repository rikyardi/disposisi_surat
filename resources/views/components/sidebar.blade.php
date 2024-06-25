@auth
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        <a href=""><img src="{{ asset('img/logo.png') }}" alt="logo" class="img-fluid" ></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
        <a href=""><img src="{{ asset('img/logo.png') }}" alt="logo" class="img-fluid" ></a>
        </div>
        <ul class="sidebar-menu mt-5 pt-5">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('surat') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('surat') }}"><i class="fas fa-envelope"></i><span>Surat Masuk</span></a>
            </li>
            <li class="{{ Request::is('suratKeluar') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('suratKeluar') }}"><i class="fas fa-paper-plane"></i><span>Surat Keluar</span></a>
            </li>
            <li class="{{ Request::is('disposisi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('disposisi') }}"><i class="fas fa-mail-bulk"></i><span>Disposisi</span></a>
            </li>
            @if(Auth::user() && Auth::user()->role == 'atasan')
            <li class="{{ Request::is('user') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('user') }}"><i class="fas fa-user"></i><span>Manajemen User</span></a>
            </li>
            @endif

            
            <!-- profile ganti password -->
            <li class="menu-header">Profile</li>
            <li class="{{ Request::is('profile/edit') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('profile/edit') }}"><i class="far fa-user"></i> <span>Profile</span></a>
            </li>
            <li class="{{ Request::is('profile/change-password') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('profile/change-password') }}"><i class="fas fa-key"></i> <span>Ganti Password</span></a>
            </li>
            <li class="{{ Request::is('logout') ? 'active' : '' }}">
            <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                   onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>   Logout
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </aside>
</div>
@endauth
