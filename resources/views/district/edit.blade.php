@extends('layouts.admin')

@section('css-before-bootstrap')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                Edit Data Kecamatan
                            </div>
                            <div class="card-body">
                                <form action="/district/{{ $district->id }}" method="post">
                                    {{ method_field('PUT') }}
                                    @csrf
                                    <div class="mb-3">
                                        <label for="kecamatan" class="form-label">Nama Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatan"
                                            value="{{ $district['district_name'] }}" name="district_name">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('district.index') }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection
