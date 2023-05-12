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
                        <h4 class="card-title">Data Izin Pengembang</h4>
                        <p class="card-title-desc">Data Izin Pengembang Perkim yang ada di Kabupaten Mukomuko</p>


                        <div class="d-flex justify-content-between">
                            <a class="btn btn-primary waves-effect waves-light mb-3"
                                href="{{ route('developerApproval.create') }}">Tambah Data</a>

                            @if (Auth::user()->hasRole(['Admin', 'SuperAdmin']))
                                <a class="btn btn-primary waves-effect waves-light mb-3" href="">Cetak Data</a>
                            @endif
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="da-table">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengembang</th>
                                        <th>IMB</th>
                                        <th>No Hp</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
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

    <!-- Modal -->
    <div class="modal fade bs-example-modal-center" id="add-kec" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="dist_form">
                        @csrf
                        {{ method_field('POST') }}
                        <div class="mb-3">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>Diproses</option>
                                        <option>Diterima</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="sa_save">Simpan</button>
                    <a href="{{ route('developerApproval.index') }}" class="btn btn-secondary">Keluar</a>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var routeList = "{{ route('developerApproval.list') }}";
    </script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/developer_approvals/script.js') }}"></script>
@endsection
