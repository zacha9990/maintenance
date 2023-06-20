@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3>Detail pemeliharaan untuk: {{ $maintenance->tool->name }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Teknisi</th>
                            <td>{{ $maintenance->responsible_technician ? $maintenance->technician->user->name : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $maintenance->description }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="badge {{ $maintenance->status['badgeClass'] }}">{{ $maintenance->status['label'] }}</span></td>
                        </tr>
                        <tr>
                            <th>Jenis</th>
                            <td>{{ $maintenance->type }}</td>
                        </tr>
                        <tr>
                            <th>Penjadwalan</th>
                            <td><span class="badge {{ $maintenance->automated_status['badgeClass'] }}">{{ $maintenance->automated_status['label'] }}</span></td>
                        </tr>
                        <tr>
                            <th>Jadwal dibuat</th>
                            <td>{{ $maintenance->created_at ? $maintenance->created_at->format('j F Y H:i:s') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jadwal ditugaskan</th>
                            <td>{{ $maintenance->assign_date ? Carbon\Carbon::parse($maintenance->assign_date)->format('j F Y H:i:s') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Mulai Maintenance</th>
                            <td>{{ $maintenance->start_date ? Carbon\Carbon::parse($maintenance->start_date)->format('j F Y H:i:s') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal selesai</th>
                            <td>{{ $maintenance->completed_date ? Carbon\Carbon::parse($maintenance->completed_date)->format('j F Y H:i:s') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Hasil</th>
                            <td>{{ $maintenance->result ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Detail</th>
                            <td>{{ $maintenance->details ? $maintenance->details['details'] : '-' }}</td>
                        </tr>
                        @if ($maintenance->details)
                            <tr>
                                <th>Pengecekan</th>
                                <td>
                                    <ul>
                                    @foreach ($maintenance->details['criterias'] as $criteria)
                                        <li>{{ $criteria['name'] }}: {{ $criteria['result'] == 'good' ? 'Baik' : 'Tidak Baik' }}</li>
                                    @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th>Tindakan yang diambil (Internal)</th>
                            <td>{{ $maintenance->action_taken_internal ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tindakan yang diambil (Eksternal)</th>
                            <td>{{ $maintenance->action_taken_external ?: '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('maintenances.index') }}" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Halaman Maintenance</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
