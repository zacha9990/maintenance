@extends('layouts.admin')

@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="card-header mb-2">
                <h1>Daftar Alat - {{ $category->name }}</h1>
            </div>
            <div class="mb-3">
                <a href="{{ route('tool_categories.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
            <div class="mb-3">
                <table class="table table-bordered" id="toolsTable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nomor Seri</th>
                            <th>Fungsi</th>
                            <th>Merek</th>
                            <th>Tipe Seri</th>
                            <th>Tanggal Pembelian</th>
                            <th>Spesifikasi Teknis</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#toolsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('tool_categories.tools.index', $category) }}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'serial_number', name: 'serial_number' },
                    { data: 'function', name: 'function' },
                    { data: 'brand', name: 'brand' },
                    { data: 'serial_type', name: 'serial_type' },
                    { data: 'purchase_date', name: 'purchase_date' },
                    { data: 'technical_specification', name: 'technical_specification' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endsection
