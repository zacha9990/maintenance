@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Laporan untuk: {{ $repairRequest->tool->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Teknisi</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $repairRequest->staff->user->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Keterangan</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $repairRequest->description }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Status</strong>
                        </div>
                        <div class="col-md-8">
                            <span class="badge {{ $repairRequest->status['badgeClass'] }}">{{ $repairRequest->status['label'] }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Disetujui?</strong>
                        </div>
                        <div class="col-md-8">
                            <span class="badge {{ $repairRequest->approved['badgeClass'] }}">{{ $repairRequest->approved['status'] }}</span>
                        </div>
                    </div>
                    @if($repairRequest->approved_at)
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Waktu disetujui</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $repairRequest->approved_at }}
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('repair_requests.index') }}" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Halaman Laporan Kerusakan</a>
                    <a href="{{ route('maintenances.show', $repairRequest->tool->id) }}" class="btn btn-primary">Halaman Maintenance <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
