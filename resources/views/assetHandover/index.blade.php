@extends('layouts.admin')

@section('css-before-bootstrap')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Aset PSU</h4>
                        <p class="card-title-desc">Data Aset PSU Perkim yang ada di Kabupaten Mukomuko</p>

                        <div class="d-flex justify-content-between">
                            <a class="btn btn-primary waves-effect waves-light mb-3"
                                href="{{ route('assetHandover.create') }}">Tambah Data</a>
                            @if (Auth::user()->hasRole(['Admin', 'SuperAdmin']))
                                <a class="btn btn-primary waves-effect waves-light mb-3" href="">Cetak Data</a>
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="ah-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Nama Direktur Perusahaan</th>
                                        <th>Nama Perumahan</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th width="120">Aksi</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(function() {
            $('#ah-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('assetHandover.list', $status) !!}',
                columns: [{
                        data: 'rownum',
                        name: 'rownum'
                    },
                    {
                        data: 'developer_id',
                        name: 'developer_id'
                    },
                    {
                        data: 'owner',
                        name: 'owner'
                    },
                    {
                        data: 'housing',
                        name: 'housing'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
