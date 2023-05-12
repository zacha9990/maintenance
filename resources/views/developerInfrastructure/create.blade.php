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
                        <div class="alert alert-warning" role="alert">
                            Fitur sedang dalam pengembangan.
                        </div>
                        <div class="card">
                            <div class="card-header">
                                Input Asset PSU
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="perusahaan" class="form-label">Nama Perusahaan Pemohon</label>
                                                <input type="text" class="form-control" id="perusahaan"
                                                    value="{{ old('perusahaan') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="perumahan" class="form-label">Nama Perumahan</label>
                                                <input type="text" class="form-control" id="perumahan"
                                                    value="{{ old('perumahan') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="pemilik" class="form-label">Nama Pemilik</label>
                                                <input type="text" class="form-control" id="pemilik"
                                                    value="{{ old('pemilik') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="kapasitas_perumahan" class="form-label">Kapasitas Perumahan
                                                    (unit)</label>
                                                <input type="number" class="form-control" id="kapasitas_perumahan"
                                                    value="{{ old('kapasitas_perumahan') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="kontak" class="form-label">Kontak (WA/SMS)</label>
                                                <input type="text" class="form-control" id="kontak"
                                                    value="{{ old('kontak') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="tahun" class="form-label">Tahun Pembangunan</label>
                                                <input type="number" class="form-control" id="tahun"
                                                    value="{{ old('tahun') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Alamat</label>
                                                <textarea name="address" class="form-control" id="address" cols="10" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="panjang_lebar_jalan" class="form-label">Panjang, Lebar
                                                    Jalan</label>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected value="">Pilih Tipe</option>
                                                    <option value="">Tipe 1 (Keterangan)</option>
                                                    <option value="">Tipe 2 (Keterangan)</option>
                                                    <option value="">Tipe 3 (Keterangan)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="panjang_lebar_jalan" class="form-label">Panjang Saluran
                                                    Air</label>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected value="">Pilih Tipe</option>
                                                    <option value="">Tipe 1 (Keterangan)</option>
                                                    <option value="">Tipe 2 (Keterangan)</option>
                                                    <option value="">Tipe 3 (Keterangan)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="panjang_lebar_jalan" class="form-label">Panjang, Lebar Tinggi
                                                    Saluran </label>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected value="">Pilih Tipe</option>
                                                    <option value="">Tipe 1 (Keterangan)</option>
                                                    <option value="">Tipe 2 (Keterangan)</option>
                                                    <option value="">Tipe 3 (Keterangan)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected value="">Pilih Status</option>
                                                    <option value="">Di Proses</option>
                                                    <option value="">Di Terima</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="longitude" class="form-label">Kordinat Longitude</label>
                                                <input type="text" step="any" name="longitude"
                                                    class="form-control" id="longitude" value="{{ old('longitude') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="latitude" class="form-label">Kordinat Latitude</label>
                                                <input type="text" step="any" name="latitude"
                                                    class="form-control" id="latitude" value="{{ old('latitude') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-title mt-4">
                                        Upload Document
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Site Plan</h5>
                                                    <p class="card-text">Lengkapi Site Plan untuk melakukan pengarsipan.
                                                        jika
                                                        sudah
                                                        pernah mengunggah Site Plan, anda dapat mengunduhnya kembali.
                                                        Apabila
                                                        ada
                                                        kesalahan, silahkan mengunggah file yang benar.</p>
                                                    <div class="text-center">
                                                        <input type="file" name="berita_acara[]" id="berita_acara"
                                                            class="form-control berita_acara"
                                                            accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf"
                                                            multiple />
                                                        <div id="berita_acara_gallery" class="col-md-10 mt-4"></div>
                                                        <input type="hidden" name="hidden_berita_acara"
                                                            id="hidden_berita_acara"
                                                            value="@if (@$data) {{ @$data['berita_acara'] }} @endif">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">Document</h5>
                                                    <p class="card-text">Lengkapi Document untuk melakukan pengarsipan.
                                                        jika
                                                        sudah
                                                        pernah mengunggah Document, anda dapat mengunduhnya kembali.
                                                        Apabila
                                                        ada
                                                        kesalahan, silahkan mengunggah file yang benar.</p>
                                                    <div class="text-center">
                                                        <input type="file" name="berita_acara[]" id="berita_acara"
                                                            class="form-control berita_acara"
                                                            accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf"
                                                            multiple />
                                                        <div id="berita_acara_gallery" class="col-md-10 mt-4"></div>
                                                        <input type="hidden" name="hidden_berita_acara"
                                                            id="hidden_berita_acara"
                                                            value="@if (@$data) {{ @$data['berita_acara'] }} @endif">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-primary" id="sa-basic">Simpan</a>
                                        <a href="{{ route('developerInfrastructure.index') }}"
                                            class="btn btn-light">Batal</a>
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
