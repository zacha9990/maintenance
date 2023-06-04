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

        <h1>Edit Maintenance</h1>

        <form id="maintenanceForm" action="{{ route('maintenances.update', $maintenance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="type" class="col-sm-2 col-form-label">Jenis</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="type" name="type" value="{{ $maintenance->type }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="responsible_technician" class="col-sm-2 col-form-label">Teknisi yang ditugaskan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="responsible_technician" name="responsible_technician" required>
                        <option value="">Pilih Teknisi</option>
                        @foreach ($technicians as $technician)
                            <option value="{{ $technician->id }}" {{ $maintenance->responsible_technician == $technician->id ? 'selected' : '' }}>
                                {{ $technician->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Add other input fields for editing the maintenance data -->

            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('maintenances.show', $maintenance->tool->id) }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#maintenanceForm').submit(function(event) {
            event.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function(response) {
                    window.location.href = "{{ route('maintenances.show', $maintenance->tool->id) }}";
                },
                error: function(xhr) {
                    // Handle error response
                }
            });
        });
    });
</script>
@endsection
