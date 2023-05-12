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
                        Input Serah Terima Asset PSU
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="ah-form-create">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="developer_id" class="form-label">Nama Perusahaan Pemohon</label>
                                        <select name="developer_id" id="developer_id" class="form-control">
                                            @foreach ($developers as $developer)
                                                <option value="{{ $developer->id }}">{{ $developer->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="housing" class="form-label">Nama Perumahan</label>
                                        <input type="text" class="form-control" id="housing" name="housing"
                                            value="{{ old('housing') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="owner" class="form-label">Nama Direktur Perusahaan</label>
                                        <input type="text" class="form-control" id="owner" name="owner"
                                            value="{{ old('owner') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="housing_capacity" class="form-label">Kapasitas Perumahan
                                            (unit)</label>
                                        <input type="number" class="form-control" id="housing_capacity"
                                            name="housing_capacity" value="{{ old('housing_capacity') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Kontak (WA/SMS)</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="year_build" class="form-label">Tahun Pembangunan</label>
                                        <input type="number" class="form-control" id="year_build" name="year_build"
                                            value="{{ old('year_build') }}">
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
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="psu" class="form-label">PSU</label>
                                        <select name="psu" id="psu" class="form-select"
                                            aria-label="Default select example">
                                            <option selected value="">Pilih Tipe</option>
                                            <option value="Sarana">Sarana</option>
                                            <option value="Prasarana">Prasarana</option>
                                            <option value="Utilitas">Utilitas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="psu_details" class="form-label">Detail PSU</label>
                                        <input type="text" class="form-control" id="psu_details" name="psu_details"
                                            value="{{ old('psu_details') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="psu_size" class="form-label">PSU Luas/Unit</label>
                                        <input type="number" class="form-control" id="psu_size" name="psu_size"
                                            value="{{ old('psu_size') }}">
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
                                                <input type="file" name="site_plan" id="site_plan"
                                                    class="form-control site_plan"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf" />
                                                <div id="site_plan_gallery" class="col-md-10 mt-4"></div>
                                                <input type="hidden" name="hidden_site_plan" id="hidden_site_plan"
                                                    value="@if (@$data) {{ @$data['site_plan'] }} @endif">
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
                                                <input type="file" name="documents[]" id="documents"
                                                    class="form-control documents"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf"
                                                    multiple />
                                                <div id="documents_gallery" class="col-md-10 mt-4"></div>
                                                <input type="hidden" name="hidden_documents" id="hidden_documents"
                                                    value="@if (@$data) {{ @$data['documents'] }} @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button type="submit"class="btn btn-primary" id="sa-save">Simpan</button>
                                <a href="{{ route('assetHandover.index') }}" class="btn btn-light">Batal</a>
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
    <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>

    <script>
        var ahStore = "{{ route('assetHandover.store') }}";
        var ahIndex = "{{ route('assetHandover.index') }}";
        var longitude = 101.119;
        var latitude = -2.580;
        var deletedImg = [];
        var deletedFile = [];
    </script>
    <script src="{{ asset('assets/js/pages/settlement_asset/create.js') }}"></script>
    <script src="{{ asset('assets/js/pages/asset_handover/script.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
