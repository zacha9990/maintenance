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
                                Edit Data Desa
                            </div>
                            <div class="card-body">
                                <form action="{{ route('villages.update', $village->id) }}" method="post">
                                    {{ method_field('PUT') }}
                                    @csrf
                                    <div class="mb-3">
                                        <label for="kode" class="form-label">Kode Deskel</label>
                                        <input type="text" class="form-control" id="kode"
                                            value="{{ $village->code_deksel }}" name="code_deksel">
                                    </div>
                                    <div class="mb-3">
                                        <label for="desa" class="form-label">Nama Desa</label>
                                        <input type="text" class="form-control" id="desa"
                                            value="{{ $village->village_name }}" name="village_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kabupaten" class="form-label">Nama Kecamatan</label>
                                        <select class="form-select" name="district_id" aria-label="Default select example">
                                            @foreach ($district as $dist)
                                                <option {{ $village->district_id == $dist->id ? 'selected' : '' }}
                                                    value="{{ $dist->id }}">{{ $dist->district_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="my-3">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('villages.index') }}" class="btn btn-secondary">Batal</a>
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
