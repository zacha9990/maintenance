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
                        <i class="fas fa-tachometer-alt"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="calendar.html" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Jadwal Perawatan</span>
                    </a>
                </li> --}}

                @if (Auth::user()->hasRole(['Operator', 'SuperAdmin']))

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-database"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if (Auth::user()->hasRole(['SuperAdmin']))
                            <li><a href="{{ route('factories.index') }}"><i class="fas fa-industry"></i><span>Pabrik</span></a></li>
                        @endif
                        <li><a href="{{ route('tool_categories.index') }}"><i class="fas fa-tools"></i><span>Kategori Peralatan</span></a></li>
                        <li><a href="{{ route('tools.index') }}"><i class="fas fa-tools"></i><span>Peralatan</span></a></li>
                        <li><a href="{{ route('spareparts.index') }}"><i class="fas fa-cogs"></i><span>Sparepart</span></a></li>
                        <li><a href="{{ route('users.index') }}"><i class="fas fa-users"></i><span>Staff</span></a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-edit"></i>
                        <span>Form</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('repair_requests.index') }}"><i class="fas fa-exclamation-triangle"></i></i><span>Laporan Kerusakan</span></a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('maintenances.index') }}" class="waves-effect">
                        <i class="fas fa-list"></i>
                        <span>Maintenance</span>
                    </a>
                </li>

                @endif

                @if (Auth::user()->hasRole(['Teknisi']))
                    <li>
                        <a href="{{ route('maintenances.my') }}" class="waves-effect">
                            <i class="fas fa-calendar"></i>
                            <span>Jadwal Saya</span>
                        </a>
                    </li>
                    <li>

                        <a href="{{ route('repair_requests.create') }}" class="waves-effect">
                            <i class="fas fa-exclamation-triangle"></i></i><span>Laporan Kerusakan</span></a>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasRole(['Operator', 'SuperAdmin']))
                    <li>
                        <a href="{{ route('documents.index') }}" class="waves-effect">
                            <i class="fas fa-file-alt"></i>
                            <span>Upload Laporan</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasRole(['SuperAdmin']))
                <li>
                    <a href="{{ route('reports.index') }}" class="waves-effect">
                        <i class="fas fa-file-alt"></i>
                        <span>Laporan</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-cog"></i>
                        <span>Administrator Area</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('positions.index') }}"><i class="fas fa-user-tag"></i><span>Position</span></a></li>
                    </ul>
                </li>

                @endif
               </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
