<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i></a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('dashboard*') ? 'active treeview' : '' }}">
                <a href="/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('manajemen-role*') ? 'active' : '' }}">
                <a href="/manajemen-role">
                    <i class="fa fa-edit"></i> <span>Manajemen Role</span>
                </a>
            </li>
            <li class="{{ Request::is('anggotas*') ? 'active' : '' }}">
                <a href="/anggotas">
                    <i class="fa fa-laptop"></i> <span>Data Anggota</span>
                </a>
            </li>
            <li class="{{ Request::is('pengajuan-kegiatans*') ? 'active' : '' }}">
                <a href="/pengajuan-kegiatans">
                    <i class="fa fa-laptop"></i> <span>Pengajuan Kegiatan</span>
                </a>
            </li>
            <li class="{{ Request::is('jadwal-kegiatan*') ? 'active' : '' }}">
                <a href="/jadwal-kegiatan">
                    <i class="fa fa-edit"></i> <span>Jadwal Kegiatan</span>
                </a>
            </li>
            <li class="{{ Request::is('aktivasi-kegiatan*') ? 'active' : '' }}">
                <a href="/aktivasi-kegiatan">
                    <i class="fa fa-edit"></i> <span>Aktivasi Kegiatan</span>
                </a>
            </li>
            <li class="{{ Request::is('data-kegiatan*') ? 'active' : '' }}">
                <a href="/data-kegiatan">
                    <i class="fa fa-book"></i> <span>Data Kegiatan</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
