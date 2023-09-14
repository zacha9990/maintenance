@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">
                            <i class="fa fa-edit"></i>
                            Lihat Dokumen
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">

                @php
                    // Remove "public/" from the filename
                    $filename = str_replace('public/', '', $document->filename);
                @endphp

                <iframe src="{{ asset('storage/' . $filename) }}" width="100%" height="500px"></iframe>

                <a href="{{ route('documents.index') }}" class="btn btn-primary mt-3">Kembali</a>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
