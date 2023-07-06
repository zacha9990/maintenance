@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
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
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Buat Baru</a>
                    </div>
                </div>

                <h1>Pengguna</h1>

                <div class="row mb-3">
                    <label for="position-filter" class="col-sm-2 col-form-label">Filter by Position</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="position-filter">
                            <option value="">Semua</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->name }}">{{ $position->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <table class="table" id="users-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kontak</th>
                            <th>Posisi</th>
                            <th>Pabrik</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> <!-- end card body-->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('users.getUsers') }}',
                    data: function(d) {
                        d.position = $('#position-filter').val();
                    }
                },
                columns: [{
                        data: 'name',
                        name: 'users.name'
                    },
                    {
                        data: 'email',
                        name: 'users.email'
                    },
                    {
                        data: 'contact',
                        name: 'users.contact'
                    },
                    {
                        data: 'position_name',
                        name: 'positions.name'
                    },
                    {
                        data: 'fact_name',
                        name: 'factories.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#position-filter').on('change', function() {
                table.draw();
            });
        });
    </script>
@endsection
