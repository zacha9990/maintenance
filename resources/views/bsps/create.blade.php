@extends('layouts.admin')

@section('css-before-bootstrap')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        Lengkapi Document (BSPS)
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bsps.edit', $rlth->id) }}" method="post" id="bsps-save">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Pemohon</label>
                                        <input type="text" class="form-control" id="nama"
                                            value="{{ $rlth->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="kontak" class="form-label">Kontak / (WhatApp)</label>
                                        <input type="text" class="form-control" id="kontak"
                                            value="{{ $rlth->phone }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat"
                                            value="{{ $rlth->address }}" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="district_id" class="form-label">Kecamatan</label>
                                        <select id="district_id" name="district_id" class="form-select"
                                            aria-label="Default select example" readonly>
                                            <option selected value="" hidden>Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="village_id" class="form-label">Desa</label>
                                        <select class="form-select" aria-label="Default select example" id="village_id"
                                            name="village_id" readonly>
                                            <option selected value="" hidden>Pilih Desa</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-title mt-4">
                                Upload Document
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    @if ($rlth->proposal)
                                        <div class="card">
                                            <h4>Proposal Yang Sudah di Upload</h4>

                                            <a href="{{ Storage::url($rlth->proposal) }}" class="btn btn-secondary"
                                                target="_blank"><i class="fa fa-download"></i>
                                                Download
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    @if ($rlth->surat_pengantar_desa)
                                        <div class="card">
                                            <h4>Surat Pengantar Desa Yang Sudah di Upload</h4>

                                            <a href="{{ Storage::url($rlth->surat_pengantar_desa) }}"
                                                class="btn btn-secondary" target="_blank"><i class="fa fa-download"></i>
                                                Download
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Proposal</h5>
                                            <p class="card-text">Lengkapi Proposal untuk melakukan pengarsipan. jika
                                                sudah
                                                pernah mengunggah Proposal, anda dapat mengunduhnya kembali. Apabila
                                                ada
                                                kesalahan, silahkan mengunggah file yang benar.</p>
                                            <div class="text-center">
                                                <input type="file" name="proposal" id="proposal"
                                                    class="form-control proposal"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Surat Pengantar Desa</h5>
                                            <p class="card-text">Lengkapi Surat Pengantar Desa untuk melakukan
                                                pengarsipan. jika
                                                sudah
                                                pernah mengunggah Surat Pengantar Desa, anda dapat mengunduhnya kembali.
                                                Apabila
                                                ada
                                                kesalahan, silahkan mengunggah file yang benar.</p>
                                            <div class="text-center">
                                                <input type="file" name="surat_pengantar_desa" id="surat_pengantar_desa"
                                                    class="form-control surat_pengantar_desa"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        @if ($rlth->surat_pengantar_kecamatan)
                                            <div class="card">
                                                <h4>Surat Pengantar Kecamatan Yang Sudah di-Upload</h4>

                                                <a href="{{ Storage::url($rlth->surat_pengantar_kecamatan) }}"
                                                    class="btn btn-secondary" target="_blank"><i class="fa fa-download"></i>
                                                    Download
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if ($rlth->dokumen_lain)
                                            <div class="card">
                                                <h4>Dokumen lain Yang Sudah di Upload</h4>

                                                <a href="{{ Storage::url($rlth->dokumen_lain) }}"
                                                    class="btn btn-secondary" target="_blank"><i
                                                        class="fa fa-download"></i>
                                                    Download
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Surat Pengantar Kecamatan</h5>
                                            <p class="card-text">Lengkapi Surat Pengantar Kecamatan untuk melakukan
                                                pengarsipan. jika
                                                sudah
                                                pernah mengunggah Surat Pengantar Kecamatan, anda dapat mengunduhnya
                                                kembali.
                                                Apabila
                                                ada
                                                kesalahan, silahkan mengunggah file yang benar.</p>
                                            <div class="text-center">
                                                <input type="file" name="surat_pengantar_kecamatan"
                                                    id="surat_pengantar_kecamatan"
                                                    class="form-control surat_pengantar_kecamatan"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Lampiran Lainnya</h5>
                                            <p class="card-text">Lengkapi Lampiran Lainnya untuk melakukan
                                                pengarsipan. jika
                                                sudah
                                                pernah mengunggah Lampiran Lainnya, anda dapat mengunduhnya kembali.
                                                Apabila
                                                ada
                                                kesalahan, silahkan mengunggah file yang benar.</p>
                                            <div class="text-center">
                                                <input type="file" name="dokumen_lain" id="dokumen_lain"
                                                    class="form-control dokumen_lain"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="sa-basic">Simpan</button>
                                <a href="{{ route('bsps.index') }}" class="btn btn-light">Batal</a>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        var devStore = "{{ route('bsps.update', $rlth->id) }}";
        var devIndex = "{{ route('rlth.index') }}";
        // var longitude = {{ $rlth->longitude }};
        // var latitude = {{ $rlth->latitude }};
        var selectRoute = '{{ route('district.select') }}';
        var page = 'edit';
        var districtId = {{ $rlth->district_id }};
        var villageId = {{ $rlth->village_id }};
    </script>
    <script src="{{ asset('assets/js/pages/rtlh/script.js') }}"></script>
    <script src="{{ asset('assets/js/pages/bsps/script.js') }}"></script>
@endsection
