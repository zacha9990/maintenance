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
                <h1>Laporan Kerusakan</h1>
                <a href="{{ route('repair_requests.create') }}" class="btn btn-primary mb-3">Create Repair Request</a>

                <div class="mb-3 d-flex justify-content-center align-items-center">
                    <label for="approved-status-filter" class="mb-0">Status:</label>
                    <select class="form-control w-auto mx-2" id="approved-status-filter">
                        <option value="">Semua</option>
                        <option value="0">Belum disetujui</option>
                        <option value="1">Disetujui</option>
                        <option value="99">Ditolak</option>
                    </select>
                </div>

                <table class="table" id="repair-requests-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pelapor</th>
                            <th>Alat</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            var repairRequestsTable = $('#repair-requests-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('repair_requests.data') }}",
                    data: function (d) {
                            d.approved_status =  $('#approved-status-filter').val();
                        }
                    },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'staff_name',
                        name: 'staff_name'
                    },
                    {
                        data: 'tool_name',
                        name: 'tool_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'approved_status',
                        name: 'approved_status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#approved-status-filter').on('change', function() {
                repairRequestsTable.draw();
            });


            $('body').on('click', '.approve-btn', function() {
                var repairRequestId = $(this).data('id');

                if (confirm('Apakah Anda yakin ingin menyetujui permintaan ini?')) {
                    $.ajax({
                        url: '{{ route('repair_requests.approve') }}',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": repairRequestId
                        },
                        success: function(response) {
                            $('#repair-requests-table').DataTable().ajax.reload();
                        }
                    });
                }
            });

            $('body').on('click', '.reject-btn', function() {
                var repairRequestId = $(this).data('id');

                if (confirm('Apakah Anda yakin ingin menolak permintaan ini?')) {
                    $.ajax({
                        url: '{{ route('repair_requests.reject') }}',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": repairRequestId
                        },
                        success: function(response) {
                            $('#repair-requests-table').DataTable().ajax.reload();
                        }
                    });
                }
            });


            // $('body').on('click', '.delete-btn', function() {
            //     var repairRequestId = $(this).data('id');

            //     if (confirm('Are you sure you want to delete this repair request?')) {
            //         $.ajax({
            //             url: '{{ route('repair_requests.destroy', ':id') }}'.replace(':id',
            //                 repairRequestId),
            //             type: 'DELETE',
            //             data: {
            //                 "_token": "{{ csrf_token() }}",
            //             },
            //             success: function(response) {
            //                 $('#repair-requests-table').DataTable().ajax.reload();
            //             }
            //         });
            //     }
            // });
        });
    </script>
@endsection
