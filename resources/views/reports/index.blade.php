@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Laporan</th>
                            <th>Keterangan</th
                            <th>Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $report['name']}}</td>
                                <td><p>{{ $report['description'] }}</p></td>
                                <td><a href="{{ route('reports.reportForm', $report['slug']) }}" class="btn btn-primary btn-sm"><i class="fas fa-print"></i>
                                     Mulai Cetak</a></td>
                            </tr>
                        @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

@endsection
