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

                        <h4 class="card-title">Data Aset Perkim</h4>
                        <p class="card-title-desc">Data Aset Perkim yang ada di Kabupaten Mukomuko</p>

                        <div class="d-flex justify-content-between">
                            <a class="btn btn-primary waves-effect waves-light mb-3"
                                href="{{ route('settlementAsset.create') }}">Tambah Data</a>
                            <a class="btn btn-primary waves-effect waves-light mb-3" href="">Cetak Data</a>
                        </div>



                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="sa-table">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Asset</th>
                                        <th>Nama Barang</th>
                                        <th>Tahun</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
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
            $('#sa-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('settlementAsset.list') !!}',
                columns: [{
                        data: 'rownum',
                        name: 'rownum'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'item_name',
                        name: 'item_name'
                    },
                    {
                        data: 'data_year',
                        name: 'data_year'
                    },
                    {
                        data: 'person_responsible',
                        name: 'person_responsible'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#sa-table').on('click', '.btn-delete[data-remote]', function(e) {
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
                    $('#sa-table').DataTable().draw(false);
                });
            })
        });
    </script>
@endsection
