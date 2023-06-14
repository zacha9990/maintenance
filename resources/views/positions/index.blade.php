@extends('layouts.admin')

@section('content')
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
            <h1 class="mt-4">Daftar Posisi</h1>
            <div class="mb-3">
                <a class="btn btn-success" href="{{ route('positions.create') }}">Tambah Posisi</a>
            </div>
            <div class="table-responsive">
                <table id="positions-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#positions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('positions.getData') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'role_name',
                        name: 'role.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
