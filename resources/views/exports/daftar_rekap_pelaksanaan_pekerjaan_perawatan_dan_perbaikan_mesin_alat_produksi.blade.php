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
        <h3>LAPORAN HASIL KERJA PERAWATAN/PERBAIKAN MESIN/ALAT PRODUKSI</h3>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama Alat</th>
                <th scope="col">Jenis Kerusakan</th>
                <th scope="col">Langkah Perbaikan</th>
                <th scope="col">In/Eks</th>
                <th scope="col">Keterangan</th>

            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach ($maintenances as $maintenance)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $maintenance->completed_date }}</td>
                    <td>{{ $maintenance->tool->name }}</td>
                    <td>
                        @if($maintenance->repairRequest)
                            {{ $maintenance->repairRequest->description }}
                        @else
                            Maintenance Rutin
                        @endif
                    </td>

                    <td>
                        @if ($maintenance->details && isset($maintenance->details['details']))
                            {{ $maintenance->details['details'] }}
                        @else
                            {{ $maintenance->details }}
                        @endif

                    </td>

                    <td>{{ $maintenance->type }}</td>

                    <td>Terealisasi</td>
                </tr>
                @php $i++ @endphp
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
                <p class="text-center">Mengetahui<br>Kepala {{ $factory->name }}</p>
            </td>
            <td>
                <p class="text-center">Supervisor Produksi Dan Maintenance</p>
            </td>
            <td>
                <p class="text-center">Dibuat Oleh</p>
            </td>
        </tr>
        <tr style="margin:20px 0 20px 0">
            <td colspan="3"></td>
        </tr>
        <tr>
            <td>
                <p class="text-center">---</p>
            </td>
            <td>
                <p class="text-center">---</p>
            </td>
            <td>
                <p class="text-center">---</p>
            </td>
        </tr>
    </table>



</body>

</html>
