@extends('layouts.admin')

@section('css-after-bootstrap')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('tools.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="serial_number" class="form-label">Nomor Seri</label>
                <input type="text" class="form-control" id="serial_number" name="serial_number" required>
            </div>

            <div class="mb-3">
                <label for="function" class="form-label">Fungsi</label>
                <textarea class="form-control" id="function" name="function" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="brand" class="form-label">Merek</label>
                <input type="text" class="form-control" id="brand" name="brand" required>
            </div>

            <div class="mb-3">
                <label for="serial_type" class="form-label">Tipe Seri</label>
                <input type="text" class="form-control" id="serial_type" name="serial_type" required>
            </div>

            <div class="mb-3">
                <label for="purchase_date" class="form-label">Tanggal Pembelian</label>
                <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
            </div>

            <div class="mb-3">
                <label for="technical_specification" class="form-label">Spesifikasi Teknis</label>
                <textarea class="form-control" id="technical_specification" name="technical_specification" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="tool_type_id" class="form-label">Kategori Peralatan</label>
                <select class="form-control select2" id="tool_type_id" name="tool_type_id" required>
                    <option value="">Pilih Kategori Peralatan</option>
                    @foreach ($toolTypes as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="factory_id" class="form-label">Pabrik</label>
                <select class="form-control select2" id="factory_id" name="factory_id" required>
                    <option value="">Pilih Pabrik</option>
                    @foreach ($factories as $factory)
                        <option value="{{ $factory->id }}">{{ $factory->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="spareparts" class="form-label">Sparepart</label>
                <select class="form-control select2" id="spareparts" name="spareparts[]" multiple>
                    @foreach ($spareparts as $sparepart)
                        <option value="{{ $sparepart->id }}">{{ $sparepart->sparepart_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tool_quantity" class="form-label">Jumlah Peralatan</label>
                <input type="number" class="form-control" id="tool_quantity" name="tool_quantity" required>
            </div>

            <div class="mb-3">
                <label for="tool_location" class="form-label">Lokasi Peralatan</label>
                <input type="text" class="form-control" id="tool_location" name="tool_location" required>
            </div>

            <div class="mb-3">
                <label for="tool_status" class="form-label">Status Peralatan</label>
                <input type="text" class="form-control" id="tool_status" name="tool_status" required>
            </div>

            <div class="mb-3">
                <label for="maintenance_period" class="form-label">Periode Perawatan</label>
                <input type="number" class="form-control" id="maintenance_period" name="maintenance_period" required>
            </div>

            <div class="mb-3">
                <label for="maintenance_type" class="form-label">Tipe Perawatan</label>
                <select class="form-control" id="maintenance_type" name="maintenance_type" required>
                    <option value="">Pilih Tipe Perawatan</option>
                    <option value="weekly">Mingguan</option>
                    <option value="monthly">Bulanan</option>
                    <option value="yearly">Tahunan</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
