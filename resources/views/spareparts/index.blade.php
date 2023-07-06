<!-- Include Bootstrap CSS -->
@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="mt-4">Daftar Sparepart</h1>
                <div class="mb-3">
                    <a class="btn btn-success" href="{{ route('spareparts.create') }}"><i class="fas fa-plus"></i> Tambah
                        Sparepart</a>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="factory-filter">Filter by Factory:</label>
                        <select class="form-control" id="factory-filter">
                            @foreach ($factories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <table id="spareparts-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Sparepart</th>
                            <th>Pabrik</th>
                            <th>Jumlah</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Initialize DataTables and fetch the spareparts data -->
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            var table = $('#spareparts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('spareparts.list') }}",
                    data: function(d) {
                        d.factory_id = $('#factory-filter').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'sparepart_name',
                        name: 'sparepart_name'
                    },
                    {
                        data: 'factory_name',
                        name: 'factory'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#factory-filter').on('change', function() {
                table.draw();
            });


            $(document).on('click', '.delete-sparepart', function() {
                var url = $(this).data('url');

                if (confirm('Anda yakin ingin menghapus sparepart ini?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function(response) {
                            if (response.success) {
                                $('#spareparts-table').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
