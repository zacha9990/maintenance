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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <a href="{{ route('housings.index', ["jenis" => $housing->type]) }}" class="btn btn-primary"> <i
                                        class="ri-arrow-left-line"></i> </a>
                            </div>
                            <div class="col-11">
                                <h2 class="mb-3">{{ $housing->house_name }}</h2>
                            </div>

                        </div>
                        <div class="row">

                            <div class="table-responsive">
                                <hr>
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Nama Perumahan</td>
                                            <td>{{ $housing->house_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Rumah</td>
                                            <td>
                                                {{ $housing->address }},
                                                {{ $housing->village->village_name }},
                                                {{ $housing->district->district_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tahun</td>
                                            <td>{{ $housing->data_year }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                @if ($housing->status == 0)
                                                    Rumah Sewa
                                                @elseif ($housing->status == 1)
                                                    Rumah Susun
                                                @elseif ($housing->status == 2)
                                                    Rumah Penginapan
                                                @else
                                                    Rumah Khusus
                                                @endif

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tipe</td>
                                            <td>
                                                @if ($housing->type == 0)
                                                    <span class="badge rounded-pill bg-danger">Tidak Tersedia</span>
                                                @else
                                                    <span class="badge rounded-pill bg-success">Tersedia</span>
                                                @endif

                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-body">
                                <div class="card-header">Foto Perumahan</div>
                                <div class="zoom-gallery mt-3">
                                    @foreach ($housing->images as $img)
                                        <a class="float-start p-1 rounded-circle" href="{{ Storage::url($img->path) }}"
                                            title="{{ $housing->item_name }}" data-holder-rendered="true">
                                            <img src="{{ Storage::url($img->path) }}" alt="" width="275">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-header">Lokasi</div>
                                <div id="map">

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
    <!-- Magnific Popup-->
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- lightbox init js-->
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        var longitude = {{ $housing->longitude }};
        var latitude = {{ $housing->latitude }};
    </script>
    <script src="{{ asset('assets/js/pages/shared/googlemap.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
