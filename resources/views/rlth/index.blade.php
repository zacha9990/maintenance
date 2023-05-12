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
                        <h4 class="card-title">Data RTLH</h4>
                        <p class="card-title-desc">Data RTLH yang ada di Kabupaten Mukomuko</p>

                        <div class="d-flex justify-content-between">
                            <a class="btn btn-primary waves-effect waves-light mb-3"
                                href="{{ route('rlth.create') }}">Tambah Data</a>
                            @if (Auth::user()->hasRole(['Admin', 'SuperAdmin']))
                                <a class="btn btn-primary waves-effect waves-light mb-3"
                                    href="{{ route('rlth.export') }}">Cetak Data</a>
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 table-hover" id="dist-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Desa / Kelurahan</th>
                                        <th>Nama Pendata</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
    <script>
        var routeList = "{{ route('rlth.list') }}";
    </script>
    <script>
        $(function() {
            $('#dist-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('rlth.list') !!}',
                columns: [{
                        data: 'rownum',
                        name: 'rownum'
                    },
                    {
                        data: 'district_id',
                        name: 'district_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
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
        })
    </script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/rlth/script.js') }}"></script>
@endsection
