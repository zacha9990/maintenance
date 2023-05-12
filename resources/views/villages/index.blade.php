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
                        <h4 class="card-title">Data Desa</h4>
                        <p class="card-title-desc">Data desa yang ada di Kabupaten Mukomuko</p>

                        <a href="#" class="btn btn-primary waves-effect waves-light mb-3" data-bs-toggle="modal"
                            data-bs-target="#add-des">Tambah Data</a>


                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 table-hover" id="vill-table">
                                <thead>
                                    <tr>
                                        <th width="30">No</th>
                                        <th>Kode Deskel</th>
                                        <th>Desa</th>
                                        <th>Kecamatan</th>
                                        <th width="100">Aksi</th>
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
    <div class="modal fade bs-example-modal-center" id="add-des" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Desa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="village-add-form">
                        @csrf
                        <div class="mb-3">
                            <label for="kode-deskel" class="form-label">Kode Deskel</label>
                            <input type="text" maxlength="10" class="form-control" name="code_deksel" id="kode-deskel"
                                value="">
                        </div>
                        <div class="mb-3">
                            <label for="desa" class="form-label">Nama Desa</label>
                            <input type="text" name="village_name" class="form-control" id="desa" value="">
                        </div>
                        <div class="mb-3">
                            <label for="kabupaten" class="form-label">Nama Kecamatan</label>
                            <select class="form-select" name="district_id" aria-label="Default select example">
                                @foreach ($district as $dist)
                                    <option selected value="{{ $dist->id }}">{{ $dist->district_name }}</option>
                                @endforeach
                            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        var villageStore = "{{ route('villages.store') }}";
        var villageIndex = "{{ route('villages.index') }}";
    </script>

    <script>
        $(function() {
            $('#vill-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('villages.list') !!}',
                columns: [{
                        data: 'rownum',
                        name: 'rownum'
                    },
                    {
                        data: 'code_deksel',
                        name: 'code_deksel'
                    },
                    {
                        data: 'village_name',
                        name: 'village_name'
                    },
                    {
                        data: 'district_id',
                        name: 'district_id'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });


        });
    </script>
    <script src="{{ asset('assets/js/pages/village/script.js') }}"></script>
@endsection
