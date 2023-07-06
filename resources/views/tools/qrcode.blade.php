@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Detail Alat</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 text-center">
                            <img src="{{ $qrCodePath }}" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <a href="<?php echo $qrCodePath; ?>" download>
                            <button class="btn btn-primary">
                              Download QR Code
                            </button>
                          </a>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('tools.index') }}" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Halaman Alat</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
