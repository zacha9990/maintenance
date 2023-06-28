@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>Kategori alat</h1>
                <div class="mb-3">
                    <button class="btn btn-primary" id="btn-create-modal" data-bs-toggle="modal"
                        data-bs-target="#createModal">Tambahkan Kategori Alat Baru</button>
                </div>
                <table id="toolCategoriesTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori Induk</th>
                            <th>Tindakan</th>
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
                    <h5 class="modal-title" id="createModalLabel">Tambahkan Kategori Alat Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="createName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="createName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Kategori Induk</label>
                            <select type="text" class="form-control" id="parent_id" name="parent_id">
                                @foreach ($allCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Membatalkan</button>
                        <button type="submit" class="btn btn-primary">Membuat</button>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Kategori Alat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_parent_id" class="form-label">Kategori Induk</label>
                            <select type="text" class="form-control" id="edit_parent_id" name="parent_id">
                                @foreach ($allCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Membatalkan</button>
                        <button type="submit" class="btn btn-primary">Memperbarui</button>
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
                        data: 'parent_category',
                        name: 'parent_category'
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
                var url = '{{ route('tool_categories.getCategory', ':id') }}'.replace(':id', id);

                $.get(url, function(toolCategory) {
                    $('#editModal').modal('show');
                    $('#editName').val(toolCategory.data.name);
                    // $('#edit_parent_id').val(toolCategory.data.parent_id).change();
                    $('#edit_parent_id').val(toolCategory.data.parent_id).attr("selected", "selected").change();
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

                if (confirm('Anda yakin ingin menghapus kategori alat ini?')) {
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
