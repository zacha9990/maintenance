@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>My Maintenances</h1>
                <div class="mb-3">
                    <label for="statusFilter" class="form-label">Filter Status</label>
                    <select id="statusFilter" class="form-select">
                        <option value="">Semua</option>
                        <option value="not_assigned">Belum Ditugaskan</option>
                        <option value="assigned">Ditugaskan</option>
                        <option value="on_progress">Dikerjakan</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>
                <div class="table-responsive">
                    <table id="my-maintenances-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama alat</th>
                                <th>Tanggal yang dijadwalkan</th>
                                <th>Status</th>
                                <th>Tanggal Ditugaskan</th>
                                <th>Mulai tanggal</th>
                                <th>Tanggal selesai</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="completeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completeModalLabel">Selesaikan Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="completeForm">
                        <input type="hidden" id="maintenanceId" name="maintenanceId">
                        <div class="mb-3">
                            <label for="result" class="form-label">Hasil</label>
                            <input type="text" class="form-control" id="result" required>
                        </div>
                        <div class="mb-3">
                            <label for="details" class="form-label">Detail</label>
                            <textarea class="form-control" id="details" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="actionTaken" class="form-label">Tindakan yang diambil</label>
                            <textarea class="form-control" id="actionTaken" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });


            $('#my-maintenances-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('maintenances.data') }}",
                    data: function(d) {
                        // Menambahkan filter status ke data yang dikirim ke server
                        d.statusFilter = $('#statusFilter').val();
                    }
                },
                columns: [{
                        data: 'tool_name',
                        name: 'tool_name'
                    },
                    {
                        data: 'scheduled_date',
                        name: 'scheduled_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'assign_date',
                        name: 'assign_date'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'completed_date',
                        name: 'completed_date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
            });

            $('#statusFilter').on('change', function() {
                $('#my-maintenances-table').DataTable().ajax.reload();
            });


            $(document).on('click', '.start-button', function() {
                var maintenanceId = $(this).data('id');

                // Tampilkan konfirmasi
                if (confirm('Apakah Anda yakin ingin mulai mengerjakan maintenance ini?')) {
                    // Lakukan permintaan AJAX untuk mengubah status dan tanggal
                    $.ajax({
                        url: '/maintenance/start',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: maintenanceId
                        },
                        success: function(response) {
                            console.log(response);
                            // Refresh tabel setelah berhasil
                            $('#my-maintenances-table').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });

            $(document).on('submit', '#completeForm', function(e) {
                e.preventDefault();

                var maintenanceId = $('#maintenanceId').val();
                var result = $('#result').val();
                var details = $('#details').val();
                var actionTaken = $('#actionTaken').val();

                $.ajax({
                    url: '/maintenances/completeMaintenance/' + maintenanceId,
                    type: 'PUT',
                    dataType: 'json',
                    data: {
                        result: result,
                        details: details,
                        action_taken: actionTaken
                    },
                    success: function(response) {
                        if (response.success) {
                            // Refresh datatable or perform any other necessary actions
                            $('#my-maintenances-table').DataTable().ajax.reload();
                            $('#completeModal').modal('hide');
                        }
                    }
                });
            });

            $('#completeModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal
                var maintenanceId = button.data(
                    'maintenance-id'); // Mengambil nilai maintenanceId dari atribut data-maintenance-id
                $('#maintenanceId').val(
                    maintenanceId); // Mengatur nilai maintenanceId pada input tersembunyi
            });
        });
    </script>
@endsection
