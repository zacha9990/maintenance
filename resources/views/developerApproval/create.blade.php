@extends('layouts.admin')

@section('css-before-bootstrap')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
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
                    <div class="card-header">
                        Input Izin Pengembang
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="da-form">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="perusahaan" class="form-label">Nama Perusahaan</label>
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
                                        <label for="imb" class="form-label">No IMB</label>
                                        <input type="text" name="imb" class="form-control" id="imb"
                                            value="{{ old('imb') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="kontak" class="form-label">Kontak (WA/SMS)</label>
                                        <input type="text" name="phone_number" class="form-control" id="kontak"
                                            value="{{ old('phone_number') }}">
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
                                <div class="col-sm-4">
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
                                                <input required type="file" name="site_plan" id="site_plan"
                                                    class="form-control site_plan"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp/, pdf" />
                                                <div id="asset_gallery" class="col-md-10 mt-4"></div>
                                                <input required type="hidden" name="hidden_site_plan" id="hidden_site_plan"
                                                    value="@if (@$data) {{ @$data['site_plan'] }} @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
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
                                                <input required type="file" name="document" id="document"
                                                    class="form-control document"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp" />
                                                <div id="asset_gallery" class="col-md-10 mt-4"></div>
                                                <input required type="hidden" name="hidden_document"
                                                    id="hidden_document"
                                                    value="@if (@$data) {{ @$data['document'] }} @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Document Lainnya</h5>
                                            <p class="card-text">Lengkapi Document Lainnya untuk melakukan
                                                pengarsipan.
                                                jika
                                                sudah
                                                pernah mengunggah Document Lainnya, anda dapat mengunduhnya
                                                kembali.
                                                Apabila
                                                ada
                                                kesalahan, silahkan mengunggah file yang benar.</p>
                                            <div class="text-center">
                                                <input type="file" name="other_documents" id="other_documents"
                                                    class="form-control other_documents"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp" />
                                                <div id="asset_gallery" class="col-md-10 mt-4"></div>
                                                <input type="hidden" name="hidden_other_documents"
                                                    id="hidden_other_documents"
                                                    value="@if (@$data) {{ @$data['other_documents'] }} @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('developerInfrastructure.index') }}" class="btn btn-light">Batal</a>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var longitude = 101.119;
        var latitude = -2.580;
        var daStore = "{{ route('developerApproval.store') }}";
        var daIndex = "{{ route('developerApproval.index') }}";
    </script>
    <script>
        $(document).ready(function() {
            $('#developer_id').select2();
        });
    </script>
    <script src="{{ asset('assets/js/pages/settlement_asset/create.js') }}"></script>
    <script src="{{ asset('assets/js/pages/developer_approvals/create.js') }}"></script>`
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
