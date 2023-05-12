@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 my-2">
                        <div class="float-start">
                            <h2>Users Management</h2>
                        </div>
                        <div class="float-end">
                            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                        </div>
                    </div>
                </div>


                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User Management</h4>
                <p class="card-title-desc">Data User Pengguna Aplikasi, User Admin, User Admin Kecamatan.
                </p>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="users-table" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline"
                            role="grid" aria-describedby="selection-datatable_info" style="width: 938px;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="selection-datatable"
                                        rowspan="1" colspan="1" style="width: 142px;" aria-sort="ascending"
                                        aria-label="No: activate to sort column descending">No</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="selection-datatable"
                                        rowspan="1" colspan="1" style="width: 142px;" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="selection-datatable" rowspan="1"
                                        colspan="1" style="width: 219px;"
                                        aria-label="Email: activate to sort column ascending">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="selection-datatable" rowspan="1"
                                        colspan="1" style="width: 101px;"
                                        aria-label="Role: activate to sort column ascending">Role</th>
                                    <th class="sorting" tabindex="0" aria-controls="selection-datatable" rowspan="1"
                                        colspan="1" style="width: 45px;"
                                        aria-label="Age: activate to sort column ascending">Action</th>
                                </tr>
                            </thead>


                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end card body-->
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('user.list') }}',
                columns: [{
                        data: 'rownum',
                        name: 'rownum'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#users-table').on('click', '.btn-delete[data-remote]', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var url = $(this).data('remote');
                console.log(url);
                // confirm then
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        method: '_DELETE',
                        submit: true
                    }
                }).always(function(data) {
                    $('#housing-table').DataTable().draw(false);
                });
            })
        });
    </script>
@endsection
