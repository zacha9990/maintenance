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
                    <form action="{{ route('rlth.store') }}" method="post" id="rtlh_form">
                        @csrf
                        <div class="card-header">I. IDENTITAS PENGHUNI RUMAH</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="no_ktp" class="form-label">Nomor KTP</label>
                                        <input type="number" min="16" max="16" class="form-control"
                                            id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="no_kk" class="form-label">No Kartu Keluarga</label>
                                        <input type="number" min="16" max="16" class="form-control"
                                            id="no_kk" name="no_kk" value="{{ old('no_kk') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="jml_kk" class="form-label">Jumlah KK Dalam Satu Rumah</label>
                                        <input type="number" class="form-control" id="jml_kk" name="jml_kk"
                                            value="{{ old('jml_kk') }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">No Kontak</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone') }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="umur" class="form-label">Umur</label>
                                        <input type="number" class="form-control" id="umur" name="umur"
                                            value="{{ old('umur') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="jk" class="form-label">Jenis Kelamin</label>
                                        <select class="form-control select2" id="jk" name="jk"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($jk as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
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
                                            value="{{ old('address') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="kecamatan" class="form-label">Kecamatan</label>
                                        <select class="form-select" id="district_id" name="district_id"
                                            aria-label="Default select example" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label for="desa" class="form-label">Desa</label>
                                        <select class="form-select" id="village_id" name="village_id"
                                            aria-label="Default select example" required>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                                        <select class="form-select" id="pendidikan" name="pendidikan"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($pendidikan as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                        <select class="form-control select2" id="pekerjaan" name="pekerjaan"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($pekerjaan as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
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
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($penghasilan as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="kep_rumah" class="form-label">Status Kepemilikan Rumah</label>
                                        <select class="form-control select2" id="kep_rumah" name="kep_rumah"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($kep_rumah as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="asset_rumah" class="form-label">Asset Rumah Di Tempat Lain</label>
                                        <select class="form-control select2" id="asset_rumah" name="asset_rumah"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($asset_rumah as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="status_tanah" class="form-label">Status Kepemilikan Tanah</label>
                                        <select class="form-control select2" id="status_tanah" name="status_tanah"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($kep_tanah as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="asset_tanah" class="form-label">Asset Tanah Di Tempat Lain</label>
                                        <select class="form-control select2" id="asset_tanah" name="asset_tanah"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($asset_tanah as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="sumber_penerangan" class="form-label">Sumber Penerangan</label>
                                        <select class="form-control select2" id="sumber_penerangan"
                                            name="sumber_penerangan" aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($sumber_penerangan as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="bantuan_perumahan" class="form-label">Bantuan Perumahan</label>
                                        <select class="form-control select2" id="bantuan_perumahan"
                                            name="bantuan_perumahan" aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($bantuan_perumahan as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="kawasan" class="form-label">Jenis Kawasan</label>
                                        <select class="form-control select2" id="kawasan" name="kawasan"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($kawasan as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="fungsi" class="form-label">Fungsi (RTRW Kab/Kota)</label>
                                        <select class="form-control select2" id="fungsi" name="fungsi"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($fungsi as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <input id="pac-input" class="controls form-control" type="text"
                                        placeholder="Cari tempat...">
                                    <div id="map"></div>
                                </div>
                            </div> --}}
                            {{-- <div class="row">
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
                            </div> --}}


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
                                                        id="formRadio_{{ $q['slug'] . '_' . $loop->iteration }}">
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
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($sumber_air as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="jarak_tinja" class="form-label">13. Jarak Ke Pembuangan Tinja</label>
                                        <select class="form-control select2" id="jarak_tinja" name="jarak_tinja"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($jarak_tinja as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
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
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($fasilitas_bab as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="jenis_jamban" class="form-label">15. Jenis Jamban / Closet</label>
                                        <select class="form-control select2" id="jenis_jamban" name="jenis_jamban"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($jenis_jamban as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="tpa_tinja" class="form-label">16. TPA Tinja</label>
                                        <select class="form-control select2" id="tpa_tinja" name="tpa_tinja"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($tpa_tinja as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
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
                                            value="{{ old('luas_rumah') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="luas_tanah" class="form-label">18. Luas Tanah</label>
                                        <input type="text" class="form-control" id="luas_tanah" name="luas_tanah"
                                            value="{{ old('luas_tanah') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="jumlah_penghuni" class="form-label">19. Jumlah Penghunih</label>
                                        <input type="text" class="form-control" id="jumlah_penghuni"
                                            name="jumlah_penghuni" value="{{ old('jumlah_penghuni') }}" required>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="mb-3">
                                        <label for="rasio_luas" class="form-label">20. Rasio Luas Bangunan Rumah
                                            (M<sup>2</sup>)
                                            Terhadap Jumlah Penghuni Rumah</label>
                                        <select class="form-control select2" id="rasio_luas" name="rasio_luas"
                                            aria-label="Default select example" required>
                                            <option value="" hidden>Select</option>
                                            @foreach ($rasio_luas as $opt)
                                                <option value="{{ $opt }}">{{ $opt }}</option>
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
                        <div class="text-center mb-5">
                            <button type="submit" class="btn btn-primary" id="sa_save">Simpan</button>
                            <a href="{{ route('rlth.index') }}" class="btn btn-light">Batal</a>
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
        var devStore = "{{ route('rlth.store') }}";
        var devIndex = "{{ route('rlth.index') }}";
        var longitude = 101.119;
        var latitude = -2.580;
        var selectRoute = '{{ route('district.select') }}';
        var page = 'create';
        var districtId = "{{ Auth::user()->hasRole('Kecamatan') ? Auth::user()->district_id : 0 }}";
        var villageId = 0;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/pages/settlement_asset/create.js') }}"></script>
    <script src="{{ asset('assets/js/pages/rtlh/script.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
