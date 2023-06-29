@extends('layouts.admin')

@section('css-after-bootstrap')
@endsection

@section('content')
    @php use Carbon\Carbon; @endphp

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
                Daftar maintenance yang sudah selesai untuk laporan kerusakan.
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label for="filter_factory">Filter Pabrik:</label>
                        <select id="filter_factory" class="form-control">
                            <option value="">Semua</option>
                            @foreach ($factories as $factory)
                                <option value="{{ $factory->id }}" {{ $factoryFilter == $factory->id ? 'selected' : '' }}>{{ $factory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><a href="{{ route('reports.reportForm', ['sort' => 'name', 'param' => 'berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi']) }}">Nama Alat</a></th>
                            <th>Pabrik</th>
                            <th><a href="{{ route('reports.reportForm', ['sort' => 'completed_date', 'param' => 'berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi']) }}">Tanggal
                                    Selesai</a></th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lists as $maintenance)
                            <tr>
                                <td>{{ $maintenance->tool->name }}</td>
                                <td>{{ $maintenance->tool->factory->name }}</td>
                                <td>{{ Carbon::parse($maintenance->completed_date)->translatedFormat('j F Y') }}</td>
                                <td>{{ $maintenance->description }}</td>
                                <td>
                                    <a href="{{ route('reports.beritaAcaraKerusakan', $maintenance->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-print"></i>     Cetak Berita
                                        Acara</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $lists->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Event listener untuk perubahan nilai dropdown pabrik
    document.getElementById('filter_factory').addEventListener('change', function () {
      var selectedValue = this.value;
      var url = "{{ route('reports.reportForm', ['param' => 'berita_acara_pemeriksaan_kerusakan_mesin_alat_produksi']) }}";

      // Tambahkan parameter factory_filter jika ada pilihan pabrik yang dipilih
      if (selectedValue !== '') {
        url += "?factory_filter=" + selectedValue;
      }

      // Redirect ke URL dengan filter yang dipilih
      window.location.href = url;
    });
  </script>

@endsection
