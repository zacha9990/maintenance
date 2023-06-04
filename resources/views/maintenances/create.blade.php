@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Buat Data Maintenance untuk Alat {{ $tool->name }}</h1>

            <form action="{{ route('maintenances.store', $tool->id) }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label for="scheduled_date" class="col-sm-2 col-form-label">Tanggal Jadwal</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" id="scheduled_date" name="scheduled_date">
                        @error('scheduled_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="type" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="type" name="type">
                                <option value="Internal">Internal</option>
                                <option value="Internal">External</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="responsible_technician" class="col-sm-2 col-form-label">Teknisi yang Ditugaskan</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="responsible_technician" name="responsible_technician">
                            <option value="">Pilih Teknisi</option>
                            @foreach ($technicians as $technician)
                                <option value="{{ $technician->id }}">{{ $technician->user->name }}</option>
                            @endforeach
                        </select>
                        @error('responsible_technician')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('maintenances.show', $tool->id) }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
