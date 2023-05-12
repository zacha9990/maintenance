@extends('layouts.admin')

@section('css-before-bootstrap')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/settlement_asset/create.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning" role="alert">
                            Fitur sedang dalam pengembangan.
                        </div>
                        <div class="card">
                            <div class="card-header">
                                Input Data Rumah Sewa
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 mb-3">
                                            <label for="address" class="form-label">Alamat</label>
                                            <textarea name="address" class="form-control" id="address" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="longitude" class="form-label">Kordinat Longitude</label>
                                                <input type="number" step="any" name="longitude" class="form-control"
                                                    id="longitude" value="{{ old('longitude') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="latitude" class="form-label">Kordinat Latitude</label>
                                                <input type="number" step="any" name="latitude" class="form-control"
                                                    id="latitude" value="{{ old('latitude') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="data_year" class="form-label">Tahun Pendaftaran</label>
                                            <input type="number" name="data_year" class="form-control" id="data_year"
                                                value="{{ old('data_year') }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="mb-3">
                                                <label for="Status" class="form-label">Status</label>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected value="">Pilih Status</option>
                                                    <option value="">Tersedia</option>
                                                    <option value="">Tidak Tersedia</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-title mt-4">
                                        Upload Document
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Foto Fisik</h5>
                                                    <p class="card-text">Lengkapi foto fisik untuk melakukan pengarsipan.
                                                        jika
                                                        sudah
                                                        pernah mengunggah foto fisik, anda dapat mengunduhnya kembali.
                                                        Apabila
                                                        ada
                                                        kesalahan, silahkan mengunggah file yang benar.</p>
                                                    <div class="text-center">
                                                        <input type="file" name="asset_image[]" id="asset_image"
                                                            class="form-control asset_image"
                                                            accept="image/png,image/jpg,image/jpeg,image/webp" multiple />
                                                        <div id="asset_gallery" class="col-md-10 mt-4"></div>
                                                        <input type="hidden" name="hidden_asset_image"
                                                            id="hidden_asset_image"
                                                            value="@if (@$data) {{ @$data['asset_image'] }} @endif">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-primary" id="sa-basic">Simpan</a>
                                        <a href="{{ route('rentalHouse.index') }}" class="btn btn-light">Batal</a>
                                    </div>
                                </form>
                            </div>

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
        $("#sa-basic").on("click", function() {
            Swal.fire({
                title: "Sedang Dalam Pengembangan",
                confirmButtonColor: "#0f9cf3"
            })
        })
    </script>
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
