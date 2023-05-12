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
                        <h4 class="card-title">Data Pengembang (Developer)</h4>
                        <p class="card-title-desc">Daftar nama pengembang yang ada si Kabupaten Mukomuko.</p>

                        <div class="d-flex justify-content-between">
                            <a class="btn btn-primary waves-effect waves-light mb-3"
                                href="{{ route('developer.create') }}">Tambah Data</a>
                            <a class="btn btn-primary waves-effect waves-light mb-3" href="">Cetak Data</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="dev-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengembang</th>
                                        <th>No Surat Izin</th>
                                        <th>Alamat</th>
                                        <th>Penanggung Jawab</th>
                                        <th width="200">Action</th>
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
            $('#dev-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('developer.list') !!}',
                columns: [{
                        data: 'rownum',
                        name: 'rownum'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'surat_izin',
                        name: 'surat_izin'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'penanggung_jawab',
                        name: 'penanggung_jawab'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#dev-table').on('click', '.btn-delete[data-remote]', function(e) {
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
                    $('#dev-table').DataTable().draw(false);
                });
            })
        });
    </script>
@endsection
