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
                        <h4 class="card-title">Data Proposal Pembangunan</h4>
                        <p class="card-title-desc">Data Pengajuan Proposal Pembangunan Perkim yang ada di
                            Kabupaten Mukomuko</p>

                        <div class="d-flex justify-content-between">
                            <a class="btn btn-primary waves-effect waves-light mb-3"
                                href="{{ route('developmentProposal.create') }}">Tambah Data</a>
                            @if (Auth::user()->hasRole(['Admin', 'SuperAdmin']))
                                <a class="btn btn-primary waves-effect waves-light mb-3" href="">Cetak Data</a>
                            @endif
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="proposal-pembangunan">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemohon</th>
                                        <th>Alamat</th>
                                        <th>No Hp / (WhtsApp)</th>
                                        <th>Tahun</th>
                                        <th>Jenis Usulan</th>
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
            $('#proposal-pembangunan').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('developmentProposal.list') !!}',
                columns: [{
                        data: 'rownum',
                        name: 'rownum'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'data_year',
                        name: 'data_year'
                    },
                    {
                        data: 'proposal_type',
                        name: 'proposal_type'
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
