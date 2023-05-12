@extends('layouts.admin')

@section('css-before-bootstrap')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/settlement_asset/create.css') }}" rel="stylesheet" type="text/css" />
    <style>

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Edit Data Asset
                    </div>
                    <div class="card-body">
                        <form action="{{ route('settlementAsset.update', $sa->id) }}" method="post" id="sa_form">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Kode Asset</label>
                                        <input type="text" class="form-control" id="code" name="code"
                                            value="{{ $sa->code }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="item_name" class="form-label">Nama Barang</label>
                                        <input type="text" class="form-control" id="item_name" name="item_name"
                                            value="{{ $sa->item_name }}">
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
                                            id="longitude" value="{{ $sa->longitude }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="latitude" class="form-label">Kordinat Latitude</label>
                                        <input type="number" step="any" name="latitude" class="form-control"
                                            id="latitude" value="{{ $sa->latitude }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="data_year" class="form-label">Tahun</label>
                                    <input type="number" name="data_year" class="form-control" id="data_year"
                                        value="{{ $sa->data_year }}">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="person_responsible" class="form-label">Penanggung Jawab</label>
                                    <input type="text" name="person_responsible" class="form-control"
                                        id="person_responsible" value="{{ $sa->person_responsible }}">
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
                                                <div id="asset_gallery" class="col-md-10 mt-4">
                                                    @foreach ($sa->settlementAssetImages as $img)
                                                        <div class="borderwrap" data-href="{{ $img->path }}">
                                                            <div class="filenameupload"><img
                                                                    src="{{ Storage::url($img->path) }}" width="130"
                                                                    height="130">
                                                                <div class="middle"><i
                                                                        class="mdi mdi-trash-can-outline remove_img old-image"
                                                                        data-img-id="{{ $img->id }}"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
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
                                                <div id="berita_acara_gallery" class="col-md-10 mt-4">
                                                    @foreach ($sa->officialReports as $file)
                                                        <div class="borderwrap" data-href="'+event.target.result+'">
                                                            <div class="filenameupload">
                                                                <a href="{{ Storage::url($file->path) }}" target="_blank"
                                                                    rel="noopener noreferrer">File
                                                                    {{ $loop->iteration }}</a>
                                                                <i class="mdi mdi-trash-can-outline remove_file old-file"
                                                                    data-file-id="{{ $file->id }}"></i>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
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
        var saStore = "{{ route('settlementAsset.update', $sa->id) }}";
        var saIndex = "{{ route('settlementAsset.index') }}";
        var longitude = {{ $sa->longitude }};
        var latitude = {{ $sa->latitude }};
        var deletedImg = [];
        var deletedFile = [];
    </script>
    <script src="{{ asset('assets/js/pages/settlement_asset/create.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
