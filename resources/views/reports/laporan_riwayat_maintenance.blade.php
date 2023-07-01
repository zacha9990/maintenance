@extends('layouts.admin')

@section('css-after-bootstrap')

@endsection

@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Masukkan data-data berikut sebelum mulai mencetak laporan
            </div>
            <div class="card-body">
                <div class="row mb-3 text-center">
                    <h4>{{ $builder['name'] }}</h4>
                </div>
                <form action="{{ route('reports.cetakLaporanRiwayatMaintenance') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="description" class="col-sm-2 col-form-label">Pabrik</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="factory_id" name="factory_id">
                                @foreach ($builder['factories'] as $factory)
                                <option value="{{ $factory->id}}">{{ $factory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @foreach ($builder['input'] as $input)
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">{{ $input['text'] }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="{{ $input['id'] }}" name="{{ $input['id'] }}" required>
                            </div>
                        </div>
                    @endforeach

                    <div class="row mb-3">
                        <label for="year" class="col-sm-2 col-form-label">Tahun</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" id="year" name="year" min="1900" max="2099" step="1" placeholder="Tahun" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Buat</button>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
