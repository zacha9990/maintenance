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
                        <h4 class="card-title">Data BSPS</h4>
                        <p class="card-title-desc">Data Bantuan Stimulan Perumahan Swadaya (BSPS) Perkim yang ada di
                            Kabupaten Mukomuko</p>
                        <div class="alert alert-warning" role="alert">
                            Fitur sedang dalam pengembangan.
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pemohon</th>
                                        <th>Alamat</th>
                                        <th>No Hp / (WhtsApp)</th>
                                        <th>Status Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Josua</td>
                                        <td>Yogyakarta, Indonesia</td>
                                        <td>0823-0876-2836</td>
                                        <td>
                                            <span class="badge rounded-pill bg-secondary">Di Proses</span>
                                            <span class="badge rounded-pill bg-success">Di Terima</span>
                                        </td>
                                        <td class="d-flex gap-2">
                                            View | Edit | Ubah Status
                                        </td>
                                    </tr>
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
        $("#sa-basic1").on("click", function() {
            Swal.fire({
                title: "Sedang Dalam Pengembangan",
                confirmButtonColor: "#0f9cf3"
            })
        })
    </script>
    <script>
        $("#sa-basic2").on("click", function() {
            Swal.fire({
                title: "Sedang Dalam Pengembangan",
                confirmButtonColor: "#0f9cf3"
            })
        })
    </script>
@endsection
