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

    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
        <div class="modal-dialog my-modal modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailTitle">Ganti Password User: <span id="span-user-name"></span></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" id="detailBody" style="overflow-y: none;">
                    <form id="changePasswordForm" method="POST">        
                        <input type="hidden" name="userId">               
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Ulangi Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal" data-bs-original-title="" title=""><i class="fa fa-times"></i> &nbsp;Close</button>
                    <button class="btn btn-primary" type="button" id="changePasswordButton"><i class="fa fa-save"></i> &nbsp;Save</button>
                </div>
            </div>
        </div>
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

            $(document).on('click', '.act-change-password', function(event) {
                event.preventDefault();
                let id = $(this).data("id");
                $.ajax({
                    url: "api/users/"+id,
                    beforeSend: function() {
                        $('#loader').show();
                    },
                    // return the result
                    success: function(result) {
                        $('#passwordModal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                        $('#detailBody').show();
                        $('#span-user-name').text(result.user.name)
                        $('#passwordModal').modal("show");
                        $("#changePasswordForm").attr("action", "api/users-change-password/"+result.user.id);
                        $("#changePasswordForm input[name='userId']").val(result.user.id);
                    },
                    complete: function() {
                        $('#loader').hide();
                    },
                    error: function(jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Page " + href + " cannot open. Error:" + error);
                        $('#loader').hide();
                    },
                    timeout: 8000
                })
            });

            $('#changePasswordButton').on('click', function (e) {
                e.preventDefault();
                let newPassword = $('#newPassword').val();
                let confirmPassword = $('#confirmPassword').val();


                if (newPassword != confirmPassword)
                {
                    console.log("password tidak sama")
                    alert("Password tidak sama")
                }else
                {
                    let form = $('#changePasswordForm');

                    $.ajax({
                        url: form.attr("action"),
                        type: form.attr("method"),
                        data: form.serialize(),
                        dataType: "json",
                        beforeSend: function() {
                            $('#loader').show();
                        },
                        success: function (data) {
                            alert('password berhasil diganti')
                        },
                        complete: function() {
                            $('#loader').hide();
                            $('#passwordModal').modal("hide");
                        },
                        error: function(jqXHR, testStatus, error) {
                            console.log(error);
                            alert("Gagal ganti password");
                            $('#loader').hide();
                        },
                    });
                }
            });
        });
    </script>
@endsection
