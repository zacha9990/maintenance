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
                    <form action="{{ route('rlth.update', $rlth->id) }}" method="post" id="rtlh_form-edit">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="card-header">I. IDENTITAS PENGHUNI RUMAH</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <?php
                                        if ($rlth->status == 0) {
                                            $status = 'Diproses';
                                        } elseif ($rlth->status == 1) {
                                            $status = 'Diterima';
                                        } else {
                                            $status = 'Ditolak';
                                        }

                                        ?>
                                        Status : {{ $status }}
                                    </div>
                                </div>
                            </div>

                            @if ($rlth->status == 99)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            Alasan : {{ $rlth->reject_reason }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $rlth->name }}" required {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="no_ktp" class="form-label">Nomor KTP</label>
                                        <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                                            value="{{ $rlth->no_ktp }}" required {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="no_kk" class="form-label">No Kartu Keluarga</label>
                                        <input type="text" class="form-control" id="no_kk" name="no_kk"
                                            value="{{ $rlth->no_kk }}" required {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="jml_kk" class="form-label">Jumlah KK Dalam Satu Rumah</label>
                                        <input type="number" class="form-control" id="jml_kk" name="jml_kk"
                                            value="{{ $rlth->jml_kk }}" {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">No Kontak</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ $rlth->phone }}" {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="umur" class="form-label">Umur</label>
                                        <input type="number" class="form-control" id="umur" name="umur"
                                            value="{{ $rlth->umur }}" required {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="jk" class="form-label">Jenis Kelamin</label>
                                        <select class="form-control select2" id="jk" name="jk"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($jk as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->jk ? 'selected' : '' }}>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            value="{{ $rlth->address }}" required {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="kecamatan" class="form-label">Kecamatan</label>
                                        <select class="form-select" id="district_id" name="district_id"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="desa" class="form-label">Desa</label>
                                        <select class="form-select" id="village_id" name="village_id"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                                        <select class="form-select" id="pendidikan" name="pendidikan"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($pendidikan as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->pendidikan ? 'selected' : '' }}>{{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                        <select class="form-control select2" id="pekerjaan" name="pekerjaan"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($pekerjaan as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->pekerjaan ? 'selected' : '' }}>{{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="penghasilan" class="form-label">Penghasilan Per Bulan</label>
                                        <select class="form-control select2" id="penghasilan" name="penghasilan"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($penghasilan as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->penghasilan ? 'selected' : '' }}>{{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="kep_rumah" class="form-label">Status Kepemilikan Rumah</label>
                                        <select class="form-control select2" id="kep_rumah" name="kep_rumah"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($kep_rumah as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->kep_rumah ? 'selected' : '' }}>{{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="asset_rumah" class="form-label">Asset Rumah Di Tempat Lain</label>
                                        <select class="form-control select2" id="asset_rumah" name="asset_rumah"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($asset_rumah as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->asset_rumah ? 'selected' : '' }}>{{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="status_tanah" class="form-label">Status Kepemilikan Tanah</label>
                                        <select class="form-control select2" id="status_tanah" name="status_tanah"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($kep_tanah as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->status_tanah ? 'selected' : '' }}>
                                                    {{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="asset_tanah" class="form-label">Asset Tanah Di Tempat Lain</label>
                                        <select class="form-control select2" id="asset_tanah" name="asset_tanah"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($asset_tanah as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->asset_tanah ? 'selected' : '' }}>{{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="sumber_penerangan" class="form-label">Sumber Penerangan</label>
                                        <select class="form-control select2" id="sumber_penerangan"
                                            name="sumber_penerangan" aria-label="Default select example" required
                                            {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($sumber_penerangan as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->sumber_penerangan ? 'selected' : '' }}>
                                                    {{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="bantuan_perumahan" class="form-label">Bantuan Perumahan</label>
                                        <select class="form-control select2" id="bantuan_perumahan"
                                            name="bantuan_perumahan" aria-label="Default select example" required
                                            {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($bantuan_perumahan as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->bantuan_perumahan ? 'selected' : '' }}>
                                                    {{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="kawasan" class="form-label">Jenis Kawasan</label>
                                        <select class="form-control select2" id="kawasan" name="kawasan"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($kawasan as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->kawasan ? 'selected' : '' }}>{{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="fungsi" class="form-label">Fungsi (RTRW Kab/Kota)</label>
                                        <select class="form-control select2" id="fungsi" name="fungsi"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($fungsi as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->fungsi ? 'selected' : '' }}>{{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-header">
                            II.1 KONDISI FISIK RUMAH
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($ketahananKonstruksiQuestions as $q)
                                    <div class="col-sm-12 mb-3">
                                        <label for="{{ $q['slug'] }}"
                                            class="form-label">{{ $loop->iteration . '. ' . $q['name'] }}</label>
                                        <div class="d-flex justify-content-around">
                                            @foreach ($penilaians as $p)
                                                <div class="form-check">
                                                    <input type="radio" value="{{ $p }}"
                                                        class="form-check-input" name="{{ $q['slug'] }}"
                                                        id="formRadio_{{ $q['slug'] . '_' . $loop->iteration }}"
                                                        {{ $p == $rlth->{$q['slug']} ? 'checked' : '' }}
                                                        {{ !$edit ? 'readonly' : '' }}>
                                                    <label for="formRadio_{{ $q['slug'] . '_' . $loop->iteration }}"
                                                        class="form-check-label">{{ $p }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="card-header">
                            II.2 ASPEK AKSES AIR MINUM
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="sumber_air" class="form-label">12. Sumber Air Minum</label>
                                        <select class="form-control select2" id="sumber_air" name="sumber_air"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($sumber_air as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->sumber_air ? 'selected' : '' }}>{{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="jarak_tinja" class="form-label">13. Jarak Ke Pembuangan Tinja</label>
                                        <select class="form-control select2" id="jarak_tinja" name="jarak_tinja"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($jarak_tinja as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->jarak_tinja ? 'selected' : '' }}>{{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            II.3 ASPEK AKSES SANITASI
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="fasilitas_bab" class="form-label">14. Fasilitas BAB</label>
                                        <select class="form-control select2" id="fasilitas_bab" name="fasilitas_bab"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($fasilitas_bab as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->fasilitas_bab ? 'selected' : '' }}>
                                                    {{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="jenis_jamban" class="form-label">15. Jenis Jamban / Closet</label>
                                        <select class="form-control select2" id="jenis_jamban" name="jenis_jamban"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($jenis_jamban as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->jenis_jamban ? 'selected' : '' }}>
                                                    {{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="tpa_tinja" class="form-label">16. TPA Tinja</label>
                                        <select class="form-control select2" id="tpa_tinja" name="tpa_tinja"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($tpa_tinja as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->tpa_tinja ? 'selected' : '' }}>{{ $opt }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            II.4 ASPEK LUAS LANTAI PERKAPITA
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="luas_rumah" class="form-label">17. Luas Rumah</label>
                                        <input type="text" class="form-control" id="luas_rumah" name="luas_rumah"
                                            value="{{ $rlth->luas_rumah }}" required {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="luas_tanah" class="form-label">18. Luas Tanah</label>
                                        <input type="text" class="form-control" id="luas_tanah" name="luas_tanah"
                                            value="{{ $rlth->luas_tanah }}" required {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="jumlah_penghuni" class="form-label">19. Jumlah Penghunih</label>
                                        <input type="text" class="form-control" id="jumlah_penghuni"
                                            name="jumlah_penghuni" value="{{ $rlth->jumlah_penghuni }}" required
                                            {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="mb-3">
                                        <label for="rasio_luas" class="form-label">20. Rasio Luas Bangunan Rumah (M2)
                                            Terhadap Jumlah Penghuni Rumah</label>
                                        <select class="form-control select2" id="rasio_luas" name="rasio_luas"
                                            aria-label="Default select example" required {{ !$edit ? 'readonly' : '' }}>
                                            <option value="" hidden>Select</option>
                                            @foreach ($rasio_luas as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $opt == $rlth->rasio_luas ? 'selected' : '' }}>
                                                    {{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
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
                                            id="longitude" value="{{ $rlth->longitude }}"
                                            {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="latitude" class="form-label">Kordinat Latitude</label>
                                        <input type="number" step="any" name="latitude" class="form-control"
                                            id="latitude" value="{{ $rlth->latitude }}"
                                            {{ !$edit ? 'readonly' : '' }}>
                                    </div>
                                </div>
                            </div>
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
                                            <input type="file" name="proposal" id="proposal"
                                                class="form-control proposal"
                                                accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf" />
                                        </div>
                                        @if ($rlth->proposal)
                                            <h6>Proposal Yang Sudah di Upload</h6>

                                            <a href="{{ Storage::url($rlth->proposal) }}" target="_blank"><i
                                                    class="fa fa-download"></i>
                                                Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title text-center">Surat Pengantar Desa</h6>
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
                                                accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf" />
                                        </div>
                                        @if ($rlth->surat_pengantar_desa)
                                            <h6>Surat Pengantar Desa Yang Sudah di Upload</h6>

                                            <a href="{{ Storage::url($rlth->surat_pengantar_desa) }}" target="_blank"><i
                                                    class="fa fa-download"></i>
                                                Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title text-center">Surat Pengantar Kecamatan</h6>
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
                                                accept="image/png,image/jpg,image/jpeg,image/webp,application/pdf" />
                                        </div>
                                        @if ($rlth->surat_pengantar_kecamatan)
                                            <h6>Surat Pengantar Kecamatan Yang Sudah di-Upload</h6>

                                            <a href="{{ Storage::url($rlth->surat_pengantar_kecamatan) }}"
                                                target="_blank"><i class="fa fa-download"></i>
                                                Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title text-center">Lampiran Lainnya</h6>
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
                                        @if ($rlth->dokumen_lain)
                                            <h6>Dokumen lain Yang Sudah di Upload</h6>

                                            <a href="{{ Storage::url($rlth->dokumen_lain) }}" target="_blank"><i
                                                    class="fa fa-download"></i>
                                                Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>



                        <hr>
                        @if ($edit)
                            <div class="text-center mb-5">
                                <button type="submit" class="btn btn-primary" id="sa_save">Simpan</button>
                                <a href="{{ route('rlth.index') }}" class="btn btn-light">Batal</a>
                            </div>
                        @else
                            @if ($rlth->status == 0 && Auth::user()->hasRole(['Admin', 'SuperAdmin']))
                                <div class="text-center mb-5">
                                    <a href="{{ route('rlth.confirm', [$rlth->id, 'accept']) }}" class="btn btn-primary"
                                        onclick="return confirm('Anda Yakin?')">Terima</a>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modal-tolak"
                                        class="btn btn-danger">Tolak</a>
                                </div>
                            @endif
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-center" id="modal-tolak" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Alasan Tolak</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rlth.reject', $rlth->id) }}" method="POST" id="reject-form">
                        @csrf
                        <div class="mb-3">
                            <label for="reject_reason" class="form-label">Alasan Tolak</label>
                            <textarea class="form-control" name="reject_reason" id="reject_reason" cols="30" rows="10"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="sa_save">Simpan</button>
                    <a href="{{ route('rlth.show', $rlth->id) }}" class="btn btn-secondary">Keluar</a>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        var devStore = "{{ route('rlth.update', $rlth->id) }}";
        var devIndex = "{{ route('rlth.index') }}";
        var longitude = {{ $rlth->longitude }};
        var latitude = {{ $rlth->latitude }};
        var selectRoute = '{{ route('district.select') }}';
        var page = 'edit';
        var districtId = {{ $rlth->district_id }};
        var villageId = {{ $rlth->village_id }};
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/pages/settlement_asset/create.js') }}"></script>
    <script src="{{ asset('assets/js/pages/rtlh/script.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
