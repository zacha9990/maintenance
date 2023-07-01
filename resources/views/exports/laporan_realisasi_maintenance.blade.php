<!DOCTYPE html>
<html>
@php use Carbon\Carbon; @endphp

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>


    <div class="document-number">
        <p>No Dokumen: {{ $no_laporan }}</p>
    </div>
    <div class="table-title text-center">
        <h3>LAPORAN REALISASI PERBAIKAN MESIN/ALAT PRODUKSI</h3>
    </div>

    <hr>

    <table class="table table-borderless">
        <colgroup>
            <col style="width: 33%;">
            <col style="width: 66%;">
        </colgroup>
        <tr>
            <td>No Urut </td>
            <td></td>
        </tr>
        <tr>
            <td>Realisasi Dari Formulir</td>
            <td>{{ $realisasi_dari_formulir }}</td>
        </tr>
        <tr>
            <td>Hari Tanggal</td>
            <td>{{ Carbon::parse($maintenance->completed_date)->translatedFormat("l, j F Y") }}</td>
        </tr>
        <tr>
            <td>Nama Barang</td>
            <td>{{ $maintenance->tool->name }}</td>
        </tr>
        <tr>
            <td>Detail (Kondisi, Sparepart, dll)</td>
            <td>
                <p>{{ $maintenance->description }}</p>
            </td>
        </tr>
        <tr>
            <td>Tindakan Eksternal</td>
            <td>{{ $maintenance->action_taken_external ? $maintenance->action_taken_external : '-' }}</td>
        </tr>
        <tr>
            <td>Tindakan Internal</td>
            <td>{{$maintenance->action_taken_internal ? $maintenance->action_taken_internal : '-' }}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>Terealisasi</td>
        </tr>
        <!-- Add more rows as needed -->
    </table>

    <table class="table table-borderless">
        <tr>
            <td></td>
            <td></td>
            <td class="text-right">
                <p>............, tgl.........................</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="text-center">SPV</p>
            </td>
            <td>
                <p class="text-center">Mengetahui Kepala Pabrik</p>
            </td>
            <td>
                <p class="text-center">Maintenance</p>
            </td>
        </tr>
        <tr style="margin:20px 0 20px 0">
            <td colspan="3"></td>
        </tr>
        <tr>
            <td>
                <p class="text-center">{{ $nama_spv}}</p>
            </td>
            <td>
                <p class="text-center">{{ $kepala_pabrik }}</p>
            </td>
            <td>
                <p class="text-center">{{ $nama_maintenance }}</p>
            </td>
        </tr>
    </table>





</body>

</html>
