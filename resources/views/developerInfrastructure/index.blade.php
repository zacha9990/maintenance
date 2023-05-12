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
                        <h4 class="card-title">Data Asset PSU</h4>
                        <p class="card-title-desc">Data Serah PSU Perkim yang ada di Kabupaten Mukomuko</p>
                        <div class="alert alert-warning" role="alert">
                            Fitur sedang dalam pengembangan.
                        </div>

                        <div class="d-flex justify-content-between">
                            <a class="btn btn-primary waves-effect waves-light mb-3"
                                href="{{ route('developerInfrastructure.create') }}">Tambah Data</a>

                            <a class="btn btn-primary waves-effect waves-light mb-3" href="">Cetak Data</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Nama Pemilik</th>
                                        <th>Nama Perumahan</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>PT Sejahtera</td>
                                        <td>Josua</td>
                                        <td>Griya Pratama</td>
                                        <td>Alamat</td>
                                        <td>
                                            <span class="badge rounded-pill bg-success">Di Terima</span>
                                        </td>
                                        <td class="d-flex gap-2">
                                            <a href="#">
                                                <button class="btn btn-info btn-sm" id="sa-basic1"><i
                                                        class="fas fa-search"></i>View</button></a>
                                            <button class="btn btn-success btn-sm" id="sa-basic1"><i
                                                    class="fas fa-edit"></i>Edit</button></a>
                                            <a href="#" class="btn btn-danger btn-sm" id="sa-basic2"><i
                                                    class="fas fa-trash"></i> Delete</a>
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
