@extends('layouts.admin')

@section('css-after-bootstrap')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h1>Edit Tool</h1>

        <form action="{{ route('tools.update', $tool->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="name" name="name" value="{{ $tool->name }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="serial_number" class="col-sm-2 col-form-label">Nomor seri</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="serial_number" name="serial_number" value="{{ $tool->serial_number }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="function" class="col-sm-2 col-form-label">Fungsi</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="function" name="function" value="{{ $tool->function }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="brand" class="col-sm-2 col-form-label">Merek</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="brand" name="brand" value="{{ $tool->brand }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="serial_type" class="col-sm-2 col-form-label">Serial Type</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="serial_type" name="serial_type" value="{{ $tool->serial_type }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="purchase_date" class="col-sm-2 col-form-label">Beli date</label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" id="purchase_date" name="purchase_date" value="{{ $tool->purchase_date }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="technical_specification" class="col-sm-2 col-form-label">Spesifikasi teknis</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="technical_specification" name="technical_specification" required>{{ $tool->technical_specification }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tool_type_id" class="col-sm-2 col-form-label">Jenis Alat</label>
                <div class="col-sm-10">
                    <select class="form-control" id="tool_type_id" name="tool_type_id" required>
                        @foreach($toolTypes as $toolType)
                            <option value="{{ $toolType->id }}" {{ $toolType->id == $tool->tool_type_id ? 'selected' : '' }}>{{ $toolType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="factory_id" class="col-sm-2 col-form-label">Pabrik</label>
                <div class="col-sm-10">
                    <select class="form-control" id="factory_id" name="factory_id" required>
                        @foreach($factories as $factory)
                            <option value="{{ $factory->id }}" {{ $factory->id == $tool->factory_id ? 'selected' : '' }}>{{ $factory->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="spareparts" class="col-sm-2 col-form-label">Spare Parts</label>
                <div class="col-sm-10">
                    <select class="form-control select2" id="spareparts" name="spareparts[]" multiple>
                        @foreach($spareparts as $sparepart)
                            <option value="{{ $sparepart->id }}" {{ in_array($sparepart->id, $tool->spareparts->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $sparepart->sparepart_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tool_quantity" class="col-sm-2 col-form-label">Kuantitas alat</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" id="tool_quantity" name="tool_quantity" value="{{ @$tool->inventory->tool_quantity }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tool_location" class="col-sm-2 col-form-label">Lokasi Alat</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="tool_location" name="tool_location" value="{{ @$tool->inventory->tool_location }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tool_status" class="col-sm-2 col-form-label">Status alat</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="tool_status" name="tool_status" value="{{ @$tool->inventory->tool_status }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="maintenance_period" class="col-sm-2 col-form-label">Periode pemeliharaan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" id="maintenance_period" name="maintenance_period" value="{{ isset($tool->maintenancePeriod) ? $tool->maintenancePeriod->maintenance_period : '' }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="maintenance_type" class="col-sm-2 col-form-label">Jenis pemeliharaan</label>
                <div class="col-sm-10">
                    <select class="form-control select2" id="maintenance_type" name="maintenance_type" required>
                        @if(isset($tool->maintenancePeriod))
                            <option value="daily" {{ $tool->maintenancePeriod->maintenance_type == 'daily' ? 'selected' : '' }}>Harian</option>
                            <option value="weekly" {{ $tool->maintenancePeriod->maintenance_type == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                            <option value="monthly" {{ $tool->maintenancePeriod->maintenance_type == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                            <option value="yearly" {{ $tool->maintenancePeriod->maintenance_type == 'yearly' ? 'selected' : '' }}>Tahunan</option>
                        @else
                            <option value="daily">Harian</option>
                            <option value="weekly">Mingguan</option>
                            <option value="monthly">Bulanan</option>
                            <option value="yearly">Tahunan</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Menyimpan</button>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('#factory_id').on('change', function() {
                var factoryId = $(this).val();

                if (factoryId) {
                    $.ajax({
                        url: "{{ route('factories.getSpareparts') }}",
                        type: "GET",
                        data: {
                            factory_id: factoryId
                        },
                        success: function(data) {
                            $('#spareparts').html(data);
                        }
                    });
                } else {
                    $('#spareparts').html(
                    '<option value="" disabled>Pilih Pabrik terlebih dahulu</option>');
                }
            });
    });
</script>
@endsection


