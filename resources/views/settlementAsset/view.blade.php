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
                                <a href="{{ route('settlementAsset.index') }}" class="btn btn-primary"> <i
                                        class="ri-arrow-left-line"></i> </a>
                            </div>
                            <div class="col-11">
                                <h2 class="mb-3">{{ $settlementAsset->item_name }}</h2>
                            </div>

                        </div>
                        <div class="row">

                            <div class="table-responsive">
                                <hr>
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Kode Asset</td>
                                            <td>{{ $settlementAsset->code }}</td>
                                        </tr>
                                        <tr>
                                            <td>Name Item</td>
                                            <td>{{ $settlementAsset->item_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tahun</td>
                                            <td>{{ $settlementAsset->data_year }}</td>
                                        </tr>
                                        <tr>
                                            <td>Penanggung Jawab</td>
                                            <td>{{ $settlementAsset->person_responsible }}</td>
                                        </tr>
                                        @if ($settlementAsset->officialReports->first())
                                            <tr>
                                                <th>Berita Acara</th>
                                                <td>
                                                    <a href="{{ Storage::url($settlementAsset->officialReports->first()->path) }}"
                                                        class="btn btn-secondary" target="_blank"><i
                                                            class="fa fa-download"></i>
                                                        Download
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-body">
                                <div class="card-header">Gambar Items</div>
                                <div class="zoom-gallery mt-3">
                                    @foreach ($settlementAsset->settlementAssetImages as $img)
                                        <a class="float-start p-1 rounded-circle" href="{{ Storage::url($img->path) }}"
                                            title="{{ $settlementAsset->item_name }}" data-holder-rendered="true">
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
        var longitude = {{ $settlementAsset->longitude }};
        var latitude = {{ $settlementAsset->latitude }};
    </script>
    <script src="{{ asset('assets/js/pages/shared/googlemap.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
