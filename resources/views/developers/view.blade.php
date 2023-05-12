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
                                <a href="{{ route('developer.index') }}" class="btn btn-primary"> <i
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
                                            <td>{{ $developer->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Surat Izin</th>
                                            <td>{{ $developer->surat_izin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $developer->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $developer->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Penanggung Jawab</th>
                                            <td>{{ $developer->penanggung_jawab }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun</th>
                                            <td>{{ $developer->date_year }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body">
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
    <script>
        var longitude = {{ $developer->longitude }};
        var latitude = {{ $developer->latitude }};
    </script>
    <script src="{{ asset('assets/js/pages/shared/googlemap.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwx2LQQM6zmHj7oqZfI_oDrAuuXXN3tBk&callback=initMap&libraries=places&language=id">
    </script>
@endsection
