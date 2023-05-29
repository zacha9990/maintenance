@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Tool Categories</h1>
                <div class="mb-3">
                    <button class="btn btn-primary" id="btn-create-modal" data-bs-toggle="modal"
                        data-bs-target="#createModal">Add New Tool Category</button>
                </div>
                <table id="toolCategoriesTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add New Tool Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="createName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="createName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Tool Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
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

            // DataTable
            $('#toolCategoriesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('tool_categories.datatables') }}',
                columns: [{
                        data: 'rownum',
                        name: 'rownum',
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                // columnDefs: [{
                //     "defaultContent": "-",
                //     "targets": "_all"
                // }],
            });

            // Create
            $('#createForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('tool_categories.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#createModal').modal('hide');
                        $('#toolCategoriesTable').DataTable().ajax.reload();
                    }
                });
            });

            // Edit
            $('#toolCategoriesTable').on('click', '.edit', function() {
                var id = $(this).data('id');
                var url = '{{ route('tool_categories.update', ':id') }}'.replace(':id', id);

                $.get(url, function(toolCategory) {
                    $('#editModal').modal('show');
                    $('#editName').val(toolCategory.name);
                    $('#editForm').attr('action', url);
                });
            });

            $('#editForm').submit(function(e) {
                e.preventDefault();

                var url = $(this).attr('action');

                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModal').modal('hide');
                        $('#toolCategoriesTable').DataTable().ajax.reload();
                    }
                });
            });

            // Delete
            $('#toolCategoriesTable').on('click', '.delete', function() {
                var id = $(this).data('id');
                var url = '{{ route('tool_categories.destroy', ':id') }}'.replace(':id', id);

                if (confirm('Are you sure you want to delete this tool category?')) {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        success: function(response) {
                            $('#toolCategoriesTable').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection
