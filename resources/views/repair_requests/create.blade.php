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
    <div class="container">
        <div class="card">
            <div class="card-header">
                Buat permintaan perbaikan
            </div>
            <div class="card-body">
                <form action="{{ route('repair_requests.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="staff_id" class="form-label">Staff</label>
                        <select class="form-control select2" id="staff_id" name="staff_id" required>
                            <option value="">Pilih Staf</option>
                            @if($superAdmin)
                                <option value="{{ $superAdmin }}">{{ "Super Admin" }}</option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->user->name }}</option>
                            @endforeach
                            @else
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tool_id" class="form-label">Tool</label>
                        <select class="form-control select2" id="tool_id" name="tool_id" required>
                            <option value="">Pilih alat</option>
                            @foreach ($tools as $tool)
                                <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('repair_requests.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
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
