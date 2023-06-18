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
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $tool->name }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Seri</th>
                                <td>{{ $tool->serial_number ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>Fungsi</th>
                                <td>{{ $tool->function }}</td>
                            </tr>
                            <tr>
                                <th>Merek</th>
                                <td>{{ $tool->brand }}</td>
                            </tr>
                            <tr>
                                <th>Tipe Seri</th>
                                <td>{{ $tool->serial_type }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pembelian</th>
                                <td>{{ Carbon\Carbon::parse($tool->purchase_date)->format('j F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Spesifikasi Teknis</th>
                                <td>{{ $tool->technical_specification }}</td>
                            </tr>
                            <tr>
                                <th>Kategori Alat</th>
                                <td>{{ $tool->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Pabrik</th>
                                <td>{{ $tool->factory->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('tools.index') }}" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> Halaman Alat</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
