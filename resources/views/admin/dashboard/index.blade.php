@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Total Peralatan</p>
                                <h4 class="mb-2">{{ $toolsCount }}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="fas fa-tools font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Total Sparepart</p>
                                <h4 class="mb-2">{{ $sparePartsCount }}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="fas fa-cogs font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Laporan Kerusakan Bulan Ini</p>
                                <h4 class="mb-2">{{ $repairRequests }}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-danger rounded-3">
                                    <i class="fas fa-exclamation-triangle font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Harus segera dilakukan maintenance</p>
                                <h4 class="mb-2">{{ $countScheduledDate }}</h4>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-warning rounded-3">
                                    <i class="fas fa-wrench font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-4">Sebaran peralatan tiap Pabrik</h4>
                    </div>
                    <div class="card-body pb-0">
                    </div>
                    <div class="card-body py-0 px-2">
                        <canvas id="chart-tools-distribution"></canvas>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-4">Tipe Pemeliharaan</h4>
                    </div>
                    <div class="card-body pb-0">
                    </div>
                    <div class="card-body py-0 px-2">
                        <canvas id="maintenance-status-over-the-years"></canvas>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-4">Laporan Kerusakan 12 Bulan Terakhir </h4>
                    </div>
                    <div class="card-body">
                        <canvas id="repair-requests-chart"></canvas>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-4">Sebaran Kategori Peralatan</h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-4">
                            <canvas id="tools-chart-by-category" class="apex-charts"></canvas>
                        </div>
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('dashboard.chart-data-factory-tools') }}',
                type: 'GET',
                success: function(data) {
                    var labels = data.map(function(item) {
                        return item.label;
                    });
                    var values = data.map(function(item) {
                        return item.value;
                    });

                    var ctx = document.getElementById('chart-tools-distribution').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: values,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.6)',
                                    'rgba(54, 162, 235, 0.6)',
                                    'rgba(255, 206, 86, 0.6)',
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(153, 102, 255, 0.6)',
                                    'rgba(255, 159, 64, 0.6)'
                                    // Add more colors as needed
                                ]
                            }]
                        }
                    });
                }
            });

            $.ajax({
                url: "{{ route('dashboard.chart_data_maintenance_status_over_the_years') }}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var ctx = document.getElementById('maintenance-status-over-the-years').getContext(
                        '2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.labels.map(function(label) {
                                var dateParts = label.split('-');
                                var year = dateParts[1];
                                return dateParts[0] + '-' + year;
                            }),
                            datasets: response.datasets,
                        },
                        options: {
                            responsive: true,
                            scales: {
                                x: {
                                    stacked: true,
                                },
                                y: {
                                    stacked: true,
                                }
                            },
                        },
                    });
                }
            });

            $.ajax({
                url: '{{ route('dashboard.repair-requests-chart') }}',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var ctx = document.getElementById('repair-requests-chart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: data,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    precision: 0
                                }
                            }
                        }
                    });
                }
            });

            $.ajax({
                url: '{{ route('dashboard.tools-chart-by-category') }}',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var ctx = document.getElementById('tools-chart-by-category').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: data,
                        options: {
                            responsive: true
                        }
                    });
                }
            });
        });
    </script>
@endsection
