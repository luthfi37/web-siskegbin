<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>Menu Utama</h3>
      <ul class="nav side-menu">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard <span class=""></span></a>
        </li>
        <li><a href="{{ route('roles.index') }}"><i class="fa fa-desktop"></i> Manajemen Role <span class=""></span></a>
        </li>
        <li><a href="{{ route('admins.index') }}"><i class="fa fa-address-book"></i> Data Pengguna <span class=""></span></a>
        </li>
        <li><a href="{{ route('anggotas.index') }}"><i class="fa fa-user"></i> Data Anggota <span class=""></span></a>
        </li>
        <li><a href="{{ route('places.index') }}"><i class="fa fa-edit"></i> Pengajuan Kegiatan <span class=""></span></a>
        </li>
        <li><a href="{{ url('/printkeg') }}"><i class="fa fa-address-book"></i> Laporan <span class=""></span></a>
        </li>
        <li class="{{ Request::is('logout*') ? 'active' : '' }}">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i>
					<span class="link-collapse">Keluar</span>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
						</form></a>
			</a>
        </li>
        </li>
        {{-- <li class="{{ Request::is('logout*') ? 'active' : '' }}">
            {{-- <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> <span>Sign out</span>
            </a> --}}
            {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form> --}}
        </li>
      </ul>
    </div>

  </div>
  <!-- /sidebar menu -->
