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
                <table id="spareparts-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Availability</th>
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

            $('#spareparts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('spareparts.list') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'sparepart_name',
                        name: 'sparepart_name'
                    },
                    {
                        data: 'sparepart_quantity',
                        name: 'sparepart_quantity'
                    },
                    {
                        data: 'sparepart_availability',
                        name: 'sparepart_availability'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
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
