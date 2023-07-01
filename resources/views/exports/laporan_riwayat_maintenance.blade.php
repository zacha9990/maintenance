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
        <h3>DAFTAR RIWAYAT MESIN TAHUN {{ $year }}</h3>
        <h3>{{ $factory->name }}</h3>
    </div>

    <hr>

   <table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Tahun</th>
            <th>Uraian</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($maintenances as $maintenance)
            <tr>
                <td>{{ $maintenance->tool->name }}</td>
                <td>{{ Carbon::parse($maintenance->tool->purchase_date)->format('Y') }}</td>
                <td>{{ $maintenance->description }}</td>
                <td>{{ Carbon::parse($maintenance->completed_date)->translatedFormat('j F Y') }}</td>
                <td>
                    @if ($maintenance->details && isset($maintenance->details['details']))
                        <p>{{ $maintenance->details['details'] }}</p>
                    @endif
                    @if($maintenance->action_taken_internal)
                        <p>{{ $maintenance->action_taken_internal }}</p>
                    @endif
                    @if($maintenance->action_taken_external)
                        <p>{{ $maintenance->action_taken_external}}</p>
                    @endif

                </td>
            </tr>
        @endforeach
    </tbody>
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
                <p class="text-center">SPV Prod & Maint</p>
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
                <p class="text-center">{{ $nama_spv_prod_maint}}</p>
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
