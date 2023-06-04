<!-- Include Bootstrap CSS -->
@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="container mt-4">
                    <h2>Detail SparePart</h2>

                    <table class="table">
                        <tr>
                            <th>ID:</th>
                            <td>{{ $sparepart->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama:</th>
                            <td>{{ $sparepart->sparepart_name }}</td>
                        </tr>
                        <tr>
                            <th>Kuantitas:</th>
                            <td>{{ $sparepart->sparepart_quantity }}</td>
                        </tr>
                        <tr>
                            <th>Ketersediaan:</th>
                            <td>{{ $sparepart->sparepart_availability }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('spareparts.index') }}" class="btn btn-primary">Kembali</a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Initialize DataTables and fetch the spareparts data -->

@endsection
