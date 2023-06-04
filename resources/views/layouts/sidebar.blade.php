<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('assets/images/logo-perhutani.png') }}" alt="" class="avatar-md">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user()->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard.index') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="calendar.html" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Jadwal Perawatan</span>
                    </a>
                </li> --}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-database-2-fill"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('factories.index') }}">Pabrik</a></li>
                        <li><a href="{{ route('tool_categories.index') }}">Kategori Peralatan</a></li>
                        <li><a href="{{ route('tools.index') }}">Peralatan</a></li>
                        <li><a href="{{ route('spareparts.index') }}">Sparepart</a></li>
                        <li><a href="{{ route('users.index') }}">Staff</a></li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fab fa-wpforms"></i>
                        <span>Laporan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox.html">Laporan A</a></li>
                        <li><a href="email-read.html">Laporan B</a></li>
                        <li><a href="email-read.html">Laporan C</a></li>
                    </ul>
                </li> --}}



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
