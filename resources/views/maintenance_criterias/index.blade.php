@extends('layouts.admin')

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
            <div class="card-body">
                <h1>Daftar Kriteria pemeliharaan - {{ $toolCategory->name }}</h1>

                <div class="mb-3">
                    <a href="{{ route('maintenance-criterias.create', $toolCategory->id) }}" class="btn btn-primary">Tambah Kriteria</a>
                    <a href="{{ route('tool_categories.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($maintenanceCriterias as $index => $maintenanceCriteria)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $maintenanceCriteria->name }}</td>
                                <td>{{ $maintenanceCriteria->description }}</td>
                                <td>
                                    <form action="{{ route('maintenance-criterias.destroy', $maintenanceCriteria->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Tidak ada Kriteria Pemeliharaan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
