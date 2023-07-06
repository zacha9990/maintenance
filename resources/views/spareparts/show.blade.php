@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2>Data Sparepart per Pabrik</h2>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Pabrik</th>
                            <th>Sparepart</th>
                            <th>Kuantitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($factories as $factory)
                                <tr>
                                    <td>{{ $factory->name }}</td>
                                    <td>{{ $sparepart->sparepart_name }}</td>
                                    <td>{{ $factory->spareparts->find($sparepart->id)->pivot->quantity ?? 0 }}</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
                <a class="btn btn-sm btn-outline-info" href="{{ route('spareparts.index') }}">Kembali</a>
            </div>
        </div>
    </div>
@endsection
