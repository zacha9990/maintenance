@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="card text-center">
                    <div class="card-header mb-5">
                        Hi {{ Auth::user()->name }}
                    </div>
                    <h3>SELAMAT DATANG</h3>
                    <h4>APLIKASI PERUMAHAN E-PERSIK DINAS PERKIM</h4>
                    <h4>KABUPATEN MUKOMUKO</h4>

                    <div class="text-center mt-4 mb-4">
                        <div class="mb-3">
                            <a href="javascript:void()" class="auth-logo">
                                <img src="{{ asset('assets/images/logo-perkim.png') }}" height="200"
                                    class="logo-dark mx-auto" alt="">
                                <img src="{{ asset('assets/images/logo-perkim.png') }}" height="250"
                                    class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->hasRole(['Admin', 'SuperAdmin']))
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Pengajuan RTLH</p>
                            </div>
                            <div><canvas id="acquisitions"></canvas></div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Pengajuan Proposal Pengembangan</p>
                            </div>
                            <div><canvas id="devprops"></canvas></div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Pengembang</p>
                                    <h4 class="mb-2">{{ $developerCount }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="fas fa-user-friends font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Izin Pengembang</p>
                                    <h4 class="mb-2">{{ $developerApprovalCount }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="ri-mail-send-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Asset PSU</p>
                                    <h4 class="mb-2">{{ $assetPsuCount }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="fas fa-home font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Asset Perkim</p>
                                    <h4 class="mb-2">{{ $assetPerkimCount }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="fas fa-home font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Rumah Sewa</p>
                                    <h4 class="mb-2">{{ $rentalHouseCount }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-secondary rounded-3">
                                        <i class="mdi mdi-home-city-outline font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Rumah Susun</p>
                                    <h4 class="mb-2">{{ $susunHouseCount }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-secondary rounded-3">
                                        <i class="mdi mdi-home-city-outline font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Rumah Khusus</p>
                                    <h4 class="mb-2"> {{ $specialHouseCount }} </h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-secondary rounded-3">
                                        <i class="mdi mdi-home-city-outline font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Rumah Penginapan</p>
                                    <h4 class="mb-2"> {{ $penginapanHouseCount }} </h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-secondary rounded-3">
                                        <i class="mdi mdi-home-city-outline font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            @endif
        </div><!-- end row -->
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.js"
        integrity="sha512-gQhCDsnnnUfaRzD8k1L5llCCV6O9HN09zClIzzeJ8OJ9MpGmIlCxm+pdCkqTwqJ4JcjbojFr79rl2F1mzcoLMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="module">

        (async function() {

        const data = [
            @foreach($rtlhs as $r)
            {
                timemark: "{{ $r['month_year'] }}",
                count: {{ $r['count'] }}
            },
            @endforeach
        ];

        const dataDp = [
            @foreach($devProps as $r)
            {
                timemark: "{{ $r['month_year'] }}",
                count: {{ $r['count'] }}
            },
            @endforeach
        ];

        new Chart(
            document.getElementById('acquisitions'),
            {
                type: 'bar',
                data: {
                    labels: data.map(row => row.timemark),
                    datasets: [
                    {
                        label: 'Pengajuan RTLH',
                        data: data.map(row => row.count)
                    }
                    ]
                }
            }
        );

        new Chart(
            document.getElementById('devprops'),
            {
            type: 'bar',
            data: {
                labels: dataDp.map(row => row.timemark),
                datasets: [
                {
                    label: 'Pengajuan Proposal Pembangunan',
                    data: dataDp.map(row => row.count)
                }
                ]
            }
            }
        );

        })();


</script>
@endsection
