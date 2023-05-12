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
                    <div class="card-header">
                        Input Data Asset
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="sa_form">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Kode Asset</label>
                                        <input type="text" class="form-control" id="code" name="code"
                                            value="{{ old('code') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="item_name" class="form-label">Nama Barang</label>
                                        <input type="text" class="form-control" id="item_name" name="item_name"
                                            value="{{ old('item_name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <input id="pac-input" class="controls form-control" type="text"
                                        placeholder="Cari tempat...">
                                    <div id="map"></div>
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
                                    <label for="person_responsible" class="form-label">Penanggung Jawab</label>
                                    <input type="text" name="person_responsible" class="form-control"
                                        id="person_responsible" value="{{ old('person_responsible') }}">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="data_year" class="form-label">Tahun</label>
                                    <input type="number" name="data_year" class="form-control" id="data_year"
                                        value="{{ old('data_year') }}">
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
                                                <input type="hidden" name="hidden_asset_image" id="hidden_asset_image"
                                                    value="@if (@$data) {{ @$data['asset_image'] }} @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Berita Acara</h5>
                                            <p class="card-text">Lengkapi berita acara untuk melakukan pengarsipan.
                                                jika
                                                sudah
                                                pernah mengunggah berita acara, anda dapat mengunduhnya kembali.
                                                Apabila
                                                ada
                                                kesalahan, silahkan mengunggah file yang benar.</p>
                                            <div class="text-center">
                                                <input type="file" name="berita_acara[]" id="berita_acara"
                                                    class="form-control berita_acara"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf"
                                                    multiple />
                                                <div id="berita_acara_gallery" class="col-md-10 mt-4"></div>
                                                <input type="hidden" name="hidden_berita_acara" id="hidden_berita_acara"
                                                    value="@if (@$data) {{ @$data['berita_acara'] }} @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="sa_save">Simpan</button>
                                <a href="{{ route('settlementAsset.index') }}" class="btn btn-light">Batal</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        var saStore = "{{ route('settlementAsset.store') }}";
        var saIndex = "{{ route('settlementAsset.index') }}";
        var longitude = 101.119;
        var latitude = -2.580;
        var deletedImg = [];
        var deletedFile = [];
    </script>
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
    <script src="{{ asset('assets/js/pages/settlement_asset/create.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
