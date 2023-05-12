@extends('layouts.admin')

@section('css-before-bootstrap')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('css-after-bootstrap')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Input Pengajuan Pembangunan
                    </div>
                    <div class="card-body">
                        <form action="{{ route('developmentProposal.update', $developmentProposal->id) }}" method="post"
                            id="dp-form-create">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Perusahaan</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $developmentProposal->name }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Kontak / (WhatApp)</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                            value="{{ $developmentProposal->phone_number }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            value="{{ $developmentProposal->address }}">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label for="kecamatan" class="form-label">Kecamatan</label>
                                        <select class="form-select" id="district_id" name="district_id"
                                            aria-label="Default select example">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="mb-3">
                                        <label for="desa" class="form-label">Desa</label>
                                        <select class="form-select" id="village_id" name="village_id"
                                            aria-label="Default select example">
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="data_year" class="form-label">Tahun</label>
                                        <input type="number" name="data_year" class="form-control" id="data_year"
                                            value="{{ $developmentProposal->data_year }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="proposal_type" class="form-label">Jenis Usulan</label>
                                        <input type="text" name="proposal_type" class="form-control" id="proposal_type"
                                            value="{{ $developmentProposal->proposal_type }}">
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
                                            <h5 class="card-title text-center">Proposal</h5>
                                            <p class="card-text">Lengkapi Proposal untuk melakukan pengarsipan. jika
                                                sudah
                                                pernah mengunggah Proposal, anda dapat mengunduhnya kembali. Apabila
                                                ada
                                                kesalahan, silahkan mengunggah file yang benar.</p>
                                            <div class="text-center">
                                                <input type="file" name="proposal_file" id="proposal_file"
                                                    class="form-control proposal_file"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf" />
                                                <div id="proposal_file_gallery" class="col-md-10 mt-4"></div>
                                                <input type="hidden" name="hidden_proposal_file" id="hidden_proposal_file"
                                                    value="@if (@$data) {{ @$data['proposal_file'] }} @endif">
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    Proposal yang sudah diupload
                                                </div>
                                                <div class="col-12">
                                                    <a href="{{ Storage::url($developmentProposal->proposal_file) }}"
                                                        class="" target="_blank"><i class="fa fa-download"></i>
                                                        Download
                                                    </a>
                                                </div>
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
                                                <input type="file" name="village_chief_letter"
                                                    id="village_chief_letter" class="form-control village_chief_letter"
                                                    accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf" />
                                                <div id="village_chief_letter_gallery" class="col-md-10 mt-4"></div>
                                                <input type="hidden" name="hidden_village_chief_letter"
                                                    id="hidden_village_chief_letter"
                                                    value="@if (@$data) {{ @$data['village_chief_letter'] }} @endif">
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    Surat Pengantar Desa Yang Sudah diupload
                                                </div>
                                                <div class="col-12">
                                                    <a href="{{ Storage::url($developmentProposal->village_chief_letter) }}"
                                                        class="" target="_blank"><i class="fa fa-download"></i>
                                                        Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="sa-basic">Simpan</button>
                                <a href="{{ route('developmentProposal.index') }}" class="btn btn-light">Batal</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var selectRoute = '{{ route('district.select') }}';
        var dpStore = '{{ route('developmentProposal.update', $developmentProposal->id) }}';
        var dpIndex = '{{ route('developmentProposal.index') }}';
        var page = 'edit';
        var districtId = '{{ $developmentProposal->district_id }}';
        var villageId = '{{ $developmentProposal->village_id }}';
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/development_proposal/scritpt.js') }}"></script>
@endsection
