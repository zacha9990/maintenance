<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('assets/images/logo-perkim.png') }}" alt="" class="avatar-md">
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
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->hasRole(['Admin', 'SuperAdmin']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-database-2-line"></i>
                            <span>Master Data</span>
                        </a>

                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('developer.index') }}">Pengembang</a></li>

                            <li><a href="javascript: void(0);" class="has-arrow">Data Rumah</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('housings.index', ['jenis' => 2]) }}">Rumah Penginapan</a>
                                    </li>
                                    <li><a href="{{ route('housings.index', ['jenis' => 0]) }}">Rumah Sewa</a></li>
                                    <li><a href="{{ route('housings.index', ['jenis' => 1]) }}">Rumah Susun</a></li>
                                    <li><a href="{{ route('housings.index', ['jenis' => 3]) }}">Rumah Khusus</a></li>
                                </ul>
                            </li>


                            <li><a href="{{ route('settlementAsset.index') }}">Aset Perkim</a></li>
                            <li><a href="{{ route('developerInfrastructure.index') }}">Aset PSU Pengembang</a></li>
                            <li><a href="{{ route('villages.index') }}">Desa</a></li>
                            <li><a href="{{ route('district.index') }}">Kecamatan</a></li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->hasRole(['Developer', 'Admin', 'SuperAdmin']))
                    <li>
                        <a href="{{ route('assetHandover.index') }}" class="waves-effect">
                            <i class="fas fa-handshake"></i>
                            <span>Serah Terima Aset PSU</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('developerApproval.index') }}" class="waves-effect">
                            <i class="ri-mail-send-line"></i>
                            <span>Pengajuan Izin Pengembang</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasRole(['Admin', 'Kecamatan', 'SuperAdmin']))
                    <li>
                        <a href="{{ route('rlth.index') }}" class="waves-effect">
                            <i class="ri-mail-send-line"></i>
                            <span>Pengajuan RTLH</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasRole(['Kecamatan', 'Admin', 'SuperAdmin']))
                    <li>
                        <a href="{{ route('developmentProposal.index') }}" class="waves-effect">
                            <i class="ri-mail-send-line"></i>
                            <span>Pengajuan Proposal Pembangunan</span>
                        </a>
                    </li>
                @endif


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-share-line"></i>
                        <span>Administrator</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('changePassword.edit', Auth::user()->id) }}">Ganti Password</a></li>
                        @if (Auth::user()->hasRole('SuperAdmin'))
                            <li><a href="{{ route('users.index') }}">User (Pengguna)</a></li>
                            <li><a href="{{ route('roles.index') }}">Role (Peran)</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
