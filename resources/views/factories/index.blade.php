@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h2>Pabrik</h2>
                    <div class="mb-3">
                        <button type="button" id="btn-create-modal" class="btn btn-success btn-sm">
                            Buat pabrik
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="factoriesTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <!-- Create Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Buat pabrik</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="createForm">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Lokasi</label>
                                <input type="text" class="form-control" id="location" name="location">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Membuat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true" data-backdrop="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit pabrik</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editForm">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="editName">Nama</label>
                                <input type="text" class="form-control" id="editName" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="editLocation">Lokasi</label>
                                <input type="text" class="form-control" id="editLocation" name="location">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="edit-modal-cancel">Menutup</button>
                            <button type="submit" class="btn btn-primary">Memperbarui</button>
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

            $('#edit-modal-cancel').click(function() {
                $('#editModal').modal('hide');
            })

            $('#create-modal-cancel').click(function() {
                $('#createModal').modal('hide');
            })

            $('#btn-create-modal').click(function() {
                $('#createModal').modal('show');
            })

            // DataTable
            $('#factoriesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('factories.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });

            // Create
            $('#createForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('factories.store') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#createModal').modal('hide');
                        $('#createForm')[0].reset();
                        $('#factoriesTable').DataTable().ajax.reload();
                    }
                });
            });

            // Edit
            $('#factoriesTable').on('click', '.btn-edit', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: "{{ url('factories') }}/" + id,
                    method: 'GET',
                    success: function(response) {
                        $('#editModal').modal('show');
                        $('#editName').val(response.factory.name);
                        $('#editLocation').val(response.factory.location);
                        $('#editForm').attr('action', "{{ url('factories') }}/" + id);
                    }
                });
            });

            $('#editForm').submit(function(e) {
                e.preventDefault();

                var id = $(this).attr('action').split('/').pop();

                $.ajax({
                    url: "{{ url('factories') }}/" + id,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        setTimeout(function() {
                            $('#editModal').modal('hide');
                        }, 500); // Adjust the delay as needed
                        $('#factoriesTable').DataTable().ajax.reload();
                    }
                });
            });

            // Delete
            $('#factoriesTable').on('click', '.btn-delete', function() {
                if (confirm('Are you sure you want to delete this factory?')) {
                    var url = $(this).data('url');

                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        success: function(response) {
                            $('#factoriesTable').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection
