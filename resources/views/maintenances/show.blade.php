@extends('layouts.admin')

@section('css-after-bootstrap')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .nowrap-zone {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <a href="{{ route('maintenances.create', $tool->id) }}" class="btn btn-primary mb-3">Tambah Jadwal Pemeliharaan</a>
                </div>
            </div>

            <h1>Jadwal pemeliharaan untuk {{ $tool->name }}</h1>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Jadwal dibuat</th>
                        <th>Teknisi yang ditugaskan</th>
                        <th>Jadwal ditugaskan</th>
                        <th>Mulai Maintenance</th>
                        <th>Tanggal selesai</th>
                        <th>Waktu</th>
                        <th>Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maintenances as $maintenance)
                        <tr>
                            <td class="clickable" style="cursor:pointer" data-maintenance-id="{{ $maintenance->id }}">
                                <button class="btn btn-light">
                                    {{ $maintenance->scheduled_date }}
                                </button>
                            </td>
                            <td>{{ $maintenance->type }}</td>
                            <td>{{ $maintenance->status }}</td>
                            <td>{{ $maintenance->scheduled_date }}</td>
                            <td>{{ $maintenance->technician->user->name ?? '' }}</td>
                            <td>{{ $maintenance->assign_date }}</td>
                            <td>{{ $maintenance->start_date }}</td>
                            <td>{{ $maintenance->completed_date }}</td>
                            <td>{{ $maintenance->time }}</td>
                            <td>{{ $maintenance->result }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.clickable').click(function() {
                var maintenanceId = $(this).data('maintenance-id');
                window.location.href = '/maintenances/' + maintenanceId + '/edit';
            });
        });
    </script>
@endsection
