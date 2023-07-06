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
                <form action="{{ route('reports.cetakBeritaAcaraKerusakan', $maintenance->id) }}" method="POST">
                    @csrf

                    <input type="hidden" name="maintenance_id" value="{{ $maintenance->id }}">

                    @foreach ($builder['input'] as $input)
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">{{ $input['text'] }}</label>
                            <div class="col-sm-10">
                                <input 
                                        class="form-control" 
                                        type="text" 
                                        id="{{ $input['id'] }}" 
                                        name="{{ $input['id'] }}" 
                                        @if ($input['id'] == "no_laporan") value="{{ $builder['no_laporan'] }}" readonly @endif
                                        required>
                            </div>
                        </div>
                    @endforeach

                    <div class="row mb-3">
                        <label for="letter_date" class="col-sm-2 col-form-label">Tanggal Surat</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" id="letter_date" name="letter_date" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <button type="submit" name="action" value="print" class="btn btn-primary">Cetak</button>
                    <button type="submit" name="action" value="preview" class="btn btn-info">Preview</button>
                    <a href="{{ route('reports.index') }}" class="btn btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
