@extends('layouts.admin')

@section('css-before-bootstrap')
    <link href="{{ asset('assets/css/pages/settlement_asset/create.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <a href="{{ route('assetHandover.index') }}" class="btn btn-primary"> <i
                                        class="ri-arrow-left-line"></i> </a>
                            </div>
                            <div class="col-11">
                                <h3 class="mb-3">View Data</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <hr>
                                <table class="table  table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <th>Nama Developer</th>
                                            <td>{{ $assetHandover->developer->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Perumahan</th>
                                            <td>{{ $assetHandover->housing }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Pemilik</th>
                                            <td>{{ $assetHandover->owner }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kapasitas Perumahan</th>
                                            <td>{{ $assetHandover->housing_capacity }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $assetHandover->developer->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kontak</th>
                                            <td>{{ $assetHandover->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Pembangunan</th>
                                            <td>{{ $assetHandover->year_build }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $assetHandover->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tipe PSU</th>
                                            <td>{{ $assetHandover->psu }}</td>
                                        </tr>
                                        <tr>
                                            <th>Detail PSU</th>
                                            <td>{{ $assetHandover->psu_details }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ukuran PSU</th>
                                            <td>{{ $assetHandover->psu_size }}</td>
                                        </tr>
                                        <tr>
                                            <th>Siteplan</th>
                                            <td>
                                                <a href="{{ Storage::url($assetHandover->site_plan) }}"
                                                    class="btn btn-secondary" target="_blank"><i class="fa fa-download"></i>
                                                    Download
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Document Lainnya</th>
                                            <td>
                                                <a href="#" class="btn btn-secondary" target="_blank"><i
                                                        class="fa fa-download"></i>
                                                    Download
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($assetHandover->status == 0)
                                                    Diproses
                                                @elseif ($assetHandover->status == 1)
                                                    Diterima
                                                @else
                                                    Ditolak
                                                @endif
                                            </td>
                                        </tr>

                                        @if ($assetHandover->status == 99)
                                            <tr>
                                                <th>Alasan Tolak</th>
                                                <td>
                                                    {{ $assetHandover->reject_reason }}
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body">
                                <div id="map">

                                </div>
                            </div>

                            <tr>
                                <div class="col-12">
                                    @if (Auth::user()->hasRole(['Admin', 'SuperAdmin']))
                                        @if ($assetHandover->status == 0)
                                            <div class="text-center mb-5">
                                                <a href="{{ route('assetHandover.confirm', [$assetHandover->id, 'accept']) }}"
                                                    class="btn btn-primary"
                                                    onclick="return confirm('Anda Yakin?')">Terima</a>
                                                <a href="" data-bs-toggle="modal" data-bs-target="#modal-tolak"
                                                    class="btn btn-danger">Tolak</a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </tr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bs-example-modal-center" id="modal-tolak" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alasan Tolak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('assetHandover.reject', $assetHandover->id) }}" method="POST" id="reject-form">
                        @csrf
                        <div class="mb-3">
                            <label for="reject_reason" class="form-label">Alasan Tolak</label>
                            <textarea class="form-control" name="reject_reason" id="reject_reason" cols="30" rows="10"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="sa_save">Simpan</button>
                    <a href="{{ route('assetHandover.show', $assetHandover->id) }}" class="btn btn-secondary">Keluar</a>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var longitude = {{ $assetHandover->longitude }};
        var latitude = {{ $assetHandover->latitude }};
    </script>
    <script src="{{ asset('assets/js/pages/shared/googlemap.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
