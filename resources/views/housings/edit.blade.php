@extends('layouts.admin')

@section('css-before-bootstrap')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/settlement_asset/create.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('css-after-bootstrap')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/settlement_asset/create.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                Edit Data Rumah
                            </div>
                            <div class="card-body">
                                <form id="housing-form-edit" action="{{ route('housings.update', $housing->id) }}"
                                    method="post">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <div class="row" {{ $housing->type == 1 ? 'style="display: none"' : '' }}>
                                        <div class="col-sm-12 mb-3">
                                            <label for="house_name" class="form-label">Nama Perumahan</label>
                                            <input type="text" name="house_name" class="form-control" id="house_name"
                                                value="{{ $housing->house_name }}" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 mb-3">
                                            <label for="address" class="form-label">Alamat</label>
                                            <textarea name="address" class="form-control" id="address" cols="30" rows="10">{{ $housing->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                                <select class="form-select" id="district_id" name="district_id"
                                                    aria-label="Default select example" required>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="desa" class="form-label">Desa</label>
                                                <select class="form-select" id="village_id" name="village_id"
                                                    aria-label="Default select example" required>
                                                </select>
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
                                                    id="longitude" value="{{ $housing->longitude }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="latitude" class="form-label">Kordinat Latitude</label>
                                                <input type="number" step="any" name="latitude" class="form-control"
                                                    id="latitude" value="{{ $housing->latitude }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="data_year" class="form-label">Tahun Pendaftaran</label>
                                            <input type="number" name="data_year" class="form-control" id="data_year"
                                                value="{{ $housing->data_year }}">
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label for="Status" class="form-label">Status</label>
                                                <select name="status" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="0" {{ $housing->status == 0 ? 'selected' : '' }}>
                                                        Tidak
                                                        Tersedia</option>
                                                    <option value="1" {{ $housing->status == 1 ? 'selected' : '' }}>
                                                        Tersedia</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="mb-3">
                                                <label for="type" class="form-label">Tipe</label>

                                                @if(is_null($jenis))
                                                <select id="type" name="type" class="form-select"
                                                    aria-label="Default select example">
                                                    <option value="0" {{ $housing->type == 0 ? 'selected' : '' }}>
                                                        Rumah
                                                        Sewa</option>
                                                    <option value="1" {{ $housing->type == 1 ? 'selected' : '' }}>
                                                        Rumah Susun</option>
                                                    <option value="2" {{ $housing->type == 2? 'selected' : '' }}>
                                                            Rumah Penginapan</option>
                                                    <option value="3" {{ $housing->type == 3? 'selected' : '' }}>
                                                        Rumah Khusus</option>
                                                </select>
                                                @else
                                                    <input type="hidden" name="type" value="{{ $jenis }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-title mt-4">
                                        Upload Document
                                    </div>
                                    <hr>

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
                                                    @foreach ($housing->images as $img)
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
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary"
                                            id="housing-basic">Simpan</button>
                                        <a href="{{ route('housings.index') }}" class="btn btn-light">Batal</a>
                                    </div>
                                </form>
                            </div>
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
        var longitude = 101.119;
        var latitude = -2.580;
        var housingStore = "{{ route('housings.store') }}";
        var housingUpdate = "{{ route('housings.update', $housing->id) }}";
        var housingIndex = "{{ route('housings.index') }}";
        var selectRoute = '{{ route('district.select') }}';
        var page = 'edit';
        var districtId = {{ $housing->district_id }};
        var villageId = {{ $housing->village_id }};
        var deletedImg = [];
    </script>
    <script src="{{ asset('assets/js/pages/settlement_asset/create.js') }}"></script>

    <script src="{{ asset('assets/js/pages/housings/script.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
