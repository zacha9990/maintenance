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
                        <h4 class="card-title">Data Kecamatan</h4>
                        <p class="card-title-desc">Data Kecamatan yang ada di Kabupaten Mukomuko</p>
                        <a href="#" class="btn btn-primary waves-effect waves-light mb-3" data-bs-toggle="modal"
                            data-bs-target="#add-kec">Tambah Data</a>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 table-hover" id="dist-table">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50px">No</th>
                                        <th>Kecamatan</th>
                                        <th width="150px">Action</th>
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
    <!-- Modal -->
    <div class="modal fade bs-example-modal-center" id="add-kec" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kecamatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="dist_form">
                        @csrf
                        {{ method_field('POST') }}
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Nama Kecamatan</label>
                            <input type="text" class="form-control" name="district_name" id="district_name"
                                value="">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="sa_save">Simpan</button>
                    <a href="{{ route('district.index') }}" class="btn btn-secondary">Keluar</a>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        var distStore = "{{ route('district.store') }}";
        var distIndex = "{{ route('district.index') }}";
    </script>
    <script src="{{ asset('assets/js/pages/district/create.js') }}"></script>

    <script>
        $(function() {
            $('#dist-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('district.list') !!}',
                columns: [{
                        data: 'rownum',
                        name: 'rownum'
                    },
                    {
                        data: 'district_name',
                        name: 'district_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });
        });
    </script>
@endsection
