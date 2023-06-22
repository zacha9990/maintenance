@extends('layouts.pdf')

@section('css-after-bootstrap')
     <style>
    /* Custom CSS for the table title and document number */
    .table-title {
      text-align: center;
      margin: 20px 0;
    }

    .document-number {
      text-align: right;
      margin-bottom: 20px;
    }

    .table-bordered {
      border: 1px solid black;
    }

    thead th {
      font-weight: bold;
    }
  </style>
@endsection

@section('content')
<div class="container">

    <div class="document-number">
        <p>No Dokumen: 12345</p>
      </div>
    <div class="table-title">
      <h3>DAFTAR MESIN/ALAT PRODUKSI DAN SARANA LAINNYA PGT. WINDUAJI KBM IHHBK JATENG</h3>
    </div>


    <table class="table table-bordered">
        <thead class="thead-dark">
          <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama Alat</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Spesifikasi</th>
            <th scope="col">Keterangan</th>
          </tr>
          <tr class="text-center">
            <th scope="col">1</th>
            <th scope="col">2</th>
            <th scope="col">3</th>
            <th scope="col">4</th>
            <th scope="col">5</th>
          </tr>
        </thead>
        <tbody>
          {{-- table content  --}}
        </tbody>
      </table>

    <div class="row">
      <div class="col">
        <p class="text-center">Disetujui<br>Kepala PGT Winduaji</p>
      </div>
      <div class="col">
        <p class="text-center">Diperiksa<br>Supervisor Produksi & Maintenance</p>
      </div>
      <div class="col">
        <p class="text-center">Dibuat Oleh:<br>Maintenance</p>
      </div>
    </div>
  </div>

@endsection

@section('scripts')

@endsection
