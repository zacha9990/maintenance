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
                        <h4 class="card-title">Data Rumah Sewa</h4>
                        <p class="card-title-desc">Data Rumah Sewa Perkim yang ada di Kabupaten Mukomuko</p>
                        <div class="alert alert-warning" role="alert">
                            Fitur sedang dalam pengembangan.
                        </div>
                        <a href="{{ route('rentalHouse.create') }}" class="btn btn-primary btn-sm delete my-3">Tambah</a>


                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Alamat</th>
                                        <th>Kordinat Latitude</th>
                                        <th>Kordinat Latitude</th>
                                        <th>Foto Kondisi</th>
                                        <th>Tahun Pendataan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Yogyakarta, Indonesia</td>
                                        <td>2323423</td>
                                        <td> -23123213</td>
                                        <td>image</td>
                                        <td>2022</td>
                                        <td>
                                            <span class="badge rounded-pill bg-secondary">Tersedia</span>
                                            <span class="badge rounded-pill bg-success">Tidak Tersedia</span>
                                        </td>
                                        <td class="d-flex gap-2">
                                            <a href="#">
                                                <button class="btn btn-success btn-sm" id="sa-basic1"><i
                                                        class="fas fa-edit"></i>
                                                    Edit</button></a>
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
