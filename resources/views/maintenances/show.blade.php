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
                        <th>Penjadwalan</th>
                        <th>Status</th>
                        <th>Jadwal dibuat</th>
                        <th>Teknisi yang ditugaskan</th>
                        <th>Jadwal ditugaskan</th>
                        <th>Mulai Maintenance</th>
                        <th>Tanggal selesai</th>
                        <th>Waktu</th>
                        <th>Hasil</th>
                        <th style="white-space: nowrap;">Aksi</th>
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
                            <td>
                                @php
                                    switch ($maintenance->automated_status) {
                                        case 'automated':
                                            $status = 'Dijadwalkan Otomatis';
                                            $badgeClass = 'bg-secondary';
                                            $scheduled_type = '<span class="badge '.  $badgeClass . ' ">'. $status .' </span>';
                                            break;
                                        case 'damage_report':
                                            $status = 'Laporan Kerusakan';
                                            $badgeClass = 'bg-danger';
                                            $scheduled_type = '<a class="btn btn-outline-danger btn-sm" href="'. route("repair_requests.show", $maintenance->repair_id). '">'. $status .' </a>';
                                            break;
                                        case 'scheduled':
                                            $status = 'Dijadwalkan Manual';
                                            $badgeClass = 'bg-primary';
                                            $scheduled_type = '<span class="badge '.  $badgeClass . ' ">'. $status .' </span>';
                                            break;
                                    }

                                @endphp
                               {!!  $scheduled_type !!}
                            </td>
                            <td class="maintenance-status">
                                @php
                                    $status = '';
                                    $badgeClass = '';

                                    switch ($maintenance->status) {
                                        case 'not_assigned':
                                            $status = 'Belum Ditugaskan';
                                            $badgeClass = 'bg-secondary';
                                            break;
                                        case 'assigned':
                                            $status = 'Ditugaskan';
                                            $badgeClass = 'bg-info';
                                            break;
                                        case 'on_progress':
                                            $status = 'Dikerjakan';
                                            $badgeClass = 'bg-primary';
                                            break;
                                        case 'completed':
                                            $status = 'Selesai';
                                            $badgeClass = 'bg-success';
                                            break;
                                        case 'cancelled':
                                            $status = 'Dibatalkan';
                                            $badgeClass = 'bg-danger';
                                            break;
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                            </td>
                            <td>{{ $maintenance->scheduled_date }}</td>
                            <td>{{ $maintenance->technician->user->name ?? '' }}</td>
                            <td>{{ $maintenance->assign_date }}</td>
                            <td>{{ $maintenance->start_date }}</td>
                            <td>{{ $maintenance->completed_date }}</td>
                            <td>{{ $maintenance->time }}</td>
                            <td>{{ $maintenance->result }}</td>
                            <td style="white-space: nowrap;">
                                <!-- Tombol Cancel -->
                                @if ($maintenance->status != 'cancelled' && $maintenance->status != "completed")
                                    <button class="btn btn-danger btn-cancel"  data-toggle="tooltip" title="Batalkan Maintenance" data-maintenance-id="{{ $maintenance->id }}"><i class="fas fa-times-circle"></i></button>
                                @endif
                                <a href="{{ route('maintenances.show-details', $maintenance->id) }}" data-toggle="tooltip" title="Informasi Maintenance" class="btn btn-primary"><i class="fas fa-info-circle"></i></a>
                            </td>
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

            $('.btn-cancel').click(function() {
            var maintenanceId = $(this).data('maintenance-id');
            if (confirm('Anda yakin ingin membatalkan maintenance ini?')) {
                // Kirim permintaan AJAX untuk memperbarui status maintenance menjadi "cancelled"
                $.ajax({
                    url: '/maintenance/' + maintenanceId + '/cancel',
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Perbarui status pada tampilan setelah berhasil membatalkan
                        var statusCell = $('.btn-cancel[data-maintenance-id="' + maintenanceId + '"]').closest('tr').find('.maintenance-status');
                        statusCell.html('<span class="badge bg-danger">Dibatalkan</span>');
                        $('.btn-cancel[data-maintenance-id="' + maintenanceId + '"]').remove();

                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Terjadi kesalahan saat membatalkan maintenance.');
                    }
                });
            }
        });
        });
    </script>
@endsection
